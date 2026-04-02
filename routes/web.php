<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolePermissionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/books', [BookController::class, 'index'])->name('books.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('role:Member')->group(function () {
        Route::get('/catalog', [BookController::class, 'catalog'])->name('catalog.index');
        Route::post('/books/{book}/borrow', [BorrowingController::class, 'store'])->name('borrowings.store');
        Route::get('/my-borrowings', [BorrowingController::class, 'index'])->name('borrowings.index');
    });

    Route::middleware('role:Admin,Librarian')->group(function () {
        Route::resource('manage/books', BookController::class)
            ->except(['show', 'index'])
            ->names([
                'create' => 'manage.books.create',
                'store' => 'manage.books.store',
                'edit' => 'manage.books.edit',
                'update' => 'manage.books.update',
                'destroy' => 'manage.books.destroy',
            ]);

        Route::get('/members', [MemberController::class, 'index'])->name('members.index');
    });

    Route::middleware('role:Admin')->group(function () {
        Route::get('/admin/librarians/create', [AdminUserController::class, 'createLibrarian'])->name('admin.librarians.create');
        Route::post('/admin/librarians', [AdminUserController::class, 'storeLibrarian'])->name('admin.librarians.store');
        Route::get('/admin/roles', [RolePermissionController::class, 'index'])->name('admin.roles.index');
    });
});

require __DIR__.'/auth.php';
