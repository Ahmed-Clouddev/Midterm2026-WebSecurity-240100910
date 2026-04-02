<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class BorrowingController extends Controller
{
    public function index(Request $request): View
    {
        $this->authorize('viewAny', Borrowing::class);

        $borrowings = $request->user()
            ->borrowings()
            ->with('book')
            ->latest('borrowed_at')
            ->paginate(10);

        return view('borrowings.index', compact('borrowings'));
    }

    public function store(Request $request, Book $book): RedirectResponse
    {
        $this->authorize('create', Borrowing::class);

        try {
            DB::transaction(function () use ($request, $book): void {
                $lockedBook = Book::query()
                    ->whereKey($book->id)
                    ->lockForUpdate()
                    ->firstOrFail();

                if ($lockedBook->copies < 1) {
                    throw ValidationException::withMessages([
                        'book' => 'Book Currently Unavailable',
                    ]);
                }

                $lockedBook->decrement('copies');

                $request->user()->borrowings()->create([
                    'book_id' => $lockedBook->id,
                    'borrowed_at' => now(),
                    'due_at' => now()->addDays(14),
                ]);
            });
        } catch (ValidationException $exception) {
            return back()->withErrors($exception->errors());
        }

        return redirect()->route('borrowings.index')->with('status', 'borrow-success');
    }
}
