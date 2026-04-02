<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LibrarySecurityTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_forces_member_role_even_if_role_is_sent(): void
    {
        $response = $this->post('/register', [
            'name' => 'Injected User',
            'email' => 'inject@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'Admin',
        ]);

        $response->assertRedirect(route('dashboard', absolute: false));

        $user = User::query()->where('email', 'inject@example.com')->firstOrFail();
        $this->assertSame('Member', $user->role);
    }

    public function test_member_cannot_access_members_page(): void
    {
        /** @var User $member */
        $member = User::factory()->createOne(['role' => 'Member']);

        $this->actingAs($member)
            ->get('/members')
            ->assertForbidden();
    }

    public function test_admin_can_create_librarian_and_role_is_forced(): void
    {
        /** @var User $admin */
        $admin = User::factory()->createOne(['role' => 'Admin']);

        $response = $this->actingAs($admin)->post('/admin/librarians', [
            'name' => 'New Librarian',
            'email' => 'librarian@example.com',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
            'role' => 'Admin',
        ]);

        $response->assertRedirect(route('members.index', absolute: false));

        $librarian = User::query()->where('email', 'librarian@example.com')->firstOrFail();
        $this->assertSame('Librarian', $librarian->role);
    }

    public function test_member_can_borrow_book_when_copies_available(): void
    {
        /** @var User $member */
        $member = User::factory()->createOne(['role' => 'Member']);
        $book = Book::query()->create([
            'title' => 'Secure PHP',
            'author' => 'Exam Author',
            'isbn' => 'ISBN-TEST-001',
            'copies' => 2,
        ]);

        $response = $this->actingAs($member)->post(route('borrowings.store', $book));

        $response->assertRedirect(route('borrowings.index', absolute: false));

        $book->refresh();
        $this->assertSame(1, $book->copies);

        $this->assertDatabaseHas('borrowings', [
            'user_id' => $member->id,
            'book_id' => $book->id,
            'status' => 'borrowed',
        ]);
    }

    public function test_member_gets_unavailable_message_when_book_has_no_copies(): void
    {
        /** @var User $member */
        $member = User::factory()->createOne(['role' => 'Member']);
        $book = Book::query()->create([
            'title' => 'No Stock Book',
            'author' => 'Exam Author',
            'isbn' => 'ISBN-TEST-002',
            'copies' => 0,
        ]);

        $response = $this->from('/catalog')
            ->actingAs($member)
            ->post(route('borrowings.store', $book));

        $response->assertRedirect('/catalog');
        $response->assertSessionHasErrors(['book' => 'Book Currently Unavailable']);

        $book->refresh();
        $this->assertSame(0, $book->copies);
        $this->assertSame(0, Borrowing::query()->count());
    }

    public function test_catalog_shows_unavailable_books_with_warning_badge(): void
    {
        /** @var User $member */
        $member = User::factory()->createOne(['role' => 'Member']);

        $book = Book::query()->create([
            'title' => 'Unavailable Catalog Book',
            'author' => 'Exam Author',
            'isbn' => 'ISBN-TEST-003',
            'copies' => 0,
        ]);

        $response = $this->actingAs($member)->get('/catalog');

        $response->assertOk();
        $response->assertSee('Book Currently Unavailable');
        $response->assertSee('Unavailable Catalog Book');
    }
}
