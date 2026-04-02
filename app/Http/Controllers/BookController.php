<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class BookController extends Controller
{
    public function index(): View
    {
        $books = Book::query()->latest()->paginate(10);

        return view('books.index', compact('books'));
    }

    public function catalog(): View
    {
        $books = Book::query()
            ->where('copies', '>', 0)
            ->latest()
            ->paginate(10);

        return view('books.catalog', compact('books'));
    }

    public function create(): View
    {
        $this->authorize('create', Book::class);

        return view('books.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', Book::class);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'isbn' => ['required', 'string', 'max:32', 'unique:books,isbn'],
            'copies' => ['required', 'integer', 'min:0'],
        ]);

        Book::create($validated);

        return redirect()->route('books.index')->with('status', 'book-created');
    }

    public function edit(Book $book): View
    {
        $this->authorize('update', $book);

        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book): RedirectResponse
    {
        $this->authorize('update', $book);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'isbn' => ['required', 'string', 'max:32', Rule::unique('books', 'isbn')->ignore($book->id)],
            'copies' => ['required', 'integer', 'min:0'],
        ]);

        $book->update($validated);

        return redirect()->route('books.index')->with('status', 'book-updated');
    }

    public function destroy(Book $book): RedirectResponse
    {
        $this->authorize('delete', $book);

        $book->delete();

        return redirect()->route('books.index')->with('status', 'book-deleted');
    }
}
