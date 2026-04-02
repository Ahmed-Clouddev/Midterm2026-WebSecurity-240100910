<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->updateOrCreate([
            'email' => 'test@example.com',
        ], [
            'name' => 'Test User',
            'role' => 'Member',
            'password' => bcrypt('password'),
        ]);

        User::query()->updateOrCreate([
            'email' => 'admin@example.com',
        ], [
            'name' => 'Admin User',
            'role' => 'Admin',
            'password' => bcrypt('password'),
        ]);

        User::query()->updateOrCreate([
            'email' => 'librarian@example.com',
        ], [
            'name' => 'Librarian User',
            'role' => 'Librarian',
            'password' => bcrypt('password'),
        ]);

        $books = [
            ['title' => 'Clean Code', 'author' => 'Robert C. Martin', 'isbn' => '9780132350884', 'copies' => 6],
            ['title' => 'The Pragmatic Programmer', 'author' => 'Andrew Hunt', 'isbn' => '9780201616224', 'copies' => 5],
            ['title' => 'Design Patterns', 'author' => 'Erich Gamma', 'isbn' => '9780201633610', 'copies' => 4],
            ['title' => 'Refactoring', 'author' => 'Martin Fowler', 'isbn' => '9780201485677', 'copies' => 4],
            ['title' => 'Introduction to Algorithms', 'author' => 'Thomas H. Cormen', 'isbn' => '9780262033848', 'copies' => 3],
            ['title' => 'Operating System Concepts', 'author' => 'Abraham Silberschatz', 'isbn' => '9781119456339', 'copies' => 4],
            ['title' => 'Database System Concepts', 'author' => 'Abraham Silberschatz', 'isbn' => '9780078022159', 'copies' => 5],
            ['title' => 'Computer Networks', 'author' => 'Andrew S. Tanenbaum', 'isbn' => '9780132126953', 'copies' => 3],
            ['title' => 'Artificial Intelligence: A Modern Approach', 'author' => 'Stuart Russell', 'isbn' => '9780136042594', 'copies' => 2],
            ['title' => 'Code Complete', 'author' => 'Steve McConnell', 'isbn' => '9780735619678', 'copies' => 5],
            ['title' => 'Modern PHP', 'author' => 'Josh Lockhart', 'isbn' => '9781491905012', 'copies' => 4],
            ['title' => 'Laravel: Up and Running', 'author' => 'Matt Stauffer', 'isbn' => '9781492041214', 'copies' => 7],
            ['title' => 'Web Application Security', 'author' => 'Andrew Hoffman', 'isbn' => '9781492053118', 'copies' => 4],
            ['title' => 'Security Engineering', 'author' => 'Ross Anderson', 'isbn' => '9781119642787', 'copies' => 3],
            ['title' => 'The Web Application Hackers Handbook', 'author' => 'Dafydd Stuttard', 'isbn' => '9781118026472', 'copies' => 2],
            ['title' => 'Head First Design Patterns', 'author' => 'Eric Freeman', 'isbn' => '9780596007126', 'copies' => 5],
            ['title' => 'Domain-Driven Design', 'author' => 'Eric Evans', 'isbn' => '9780321125217', 'copies' => 3],
            ['title' => 'Patterns of Enterprise Application Architecture', 'author' => 'Martin Fowler', 'isbn' => '9780321127426', 'copies' => 3],
            ['title' => 'Cracking the Coding Interview', 'author' => 'Gayle Laakmann McDowell', 'isbn' => '9780984782857', 'copies' => 6],
            ['title' => 'You Dont Know JS Yet', 'author' => 'Kyle Simpson', 'isbn' => '9781098124045', 'copies' => 4],
            ['title' => 'Eloquent JavaScript', 'author' => 'Marijn Haverbeke', 'isbn' => '9781593279509', 'copies' => 5],
            ['title' => 'Programming PHP', 'author' => 'Kevin Tatroe', 'isbn' => '9781492054139', 'copies' => 4],
            ['title' => 'Algorithms to Live By', 'author' => 'Brian Christian', 'isbn' => '9781627790369', 'copies' => 2],
            ['title' => 'Computer Security Principles and Practice', 'author' => 'William Stallings', 'isbn' => '9780134794105', 'copies' => 3],
            ['title' => 'Compilers: Principles, Techniques, and Tools', 'author' => 'Alfred Aho', 'isbn' => '9780321486813', 'copies' => 2],
        ];

        foreach ($books as $book) {
            Book::query()->updateOrCreate(
                ['isbn' => $book['isbn']],
                $book
            );
        }
    }
}
