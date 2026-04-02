## Online Library Management System - Midterm Manual Check Guide

This guide is written to help you verify the full 15-mark exam checklist quickly and safely.

## 1. Quick Setup

Run these commands in order:

```bash
composer install
npm install
npm run build
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

Open: http://127.0.0.1:8000

## 2. Default Accounts

After seeding, use these accounts:

- Admin: admin@example.com / password
- Member: test@example.com / password
- Librarian: librarian@example.com / password

## 3. 15-Mark Requirement Checklist (Manual)

### 1) Registration and login pages exist
- Go to `/register` and `/login`.
- Confirm both pages load and forms submit.

### 2) New registered users become Member automatically
- Register a new account from `/register`.
- Login and check dashboard/profile role behavior is Member-only.
- Optional DB check: new user role is `Member`.

### 3) Admin creates Librarian account from system interface
- Login as Admin.
- Open `Create Librarian` page.
- Submit form.
- Confirm account is created and behaves as Librarian.

### 4) Admin can view roles and permissions page
- Login as Admin.
- Open `Roles & Permissions`.
- Confirm role matrix is visible.

### 5) Admin and Librarian can view members list
- Login as Admin then Librarian.
- Open `Members`.
- Confirm members table is accessible.

### 6) Admin and Librarian can add/edit/delete books
- Login as Admin or Librarian.
- Add book, edit same book, then delete.
- Confirm all actions succeed.

### 7) Book fields are Title, Author, ISBN, Copies
- On add/edit form, verify fields exist.
- Validate DB records include all four values.

### 8) Members can view available books in catalog
- Login as Member.
- Open `Library Catalogue`.
- Confirm only available books are listed.

### 9) Members must be logged in to borrow
- Logout.
- Try hitting borrow route from browser or form.
- Confirm request is blocked/redirected to login.

### 10) Member profile shows borrowing status/limit
- Login as Member.
- Open `Profile`.
- Confirm borrowing status and limit are shown.

### 11) Borrow succeeds only if copies > 0
- Use a book with copies > 0.
- Borrow it.
- Confirm success and borrowing record created.

### 12) If unavailable, show exact message
- Use a book with copies = 0.
- Try to borrow.
- Confirm message: `Book Currently Unavailable`.

### 13) Copies decrease after successful borrow
- Note book copies before borrow.
- Borrow once.
- Confirm copies decreased by 1.

### 14) Member can view their borrowed books
- Login as Member.
- Open `My Borrowings`.
- Confirm borrowed entries appear with status.

### 15) Authentication/Authorization vulnerabilities fixed
- Mass assignment: role cannot be injected during register.
- XSS: output rendered with escaped Blade syntax.
- IDOR: member borrowings scoped to authenticated user.
- Race condition: borrowing uses DB transaction and lock.
- CSRF/Auth: forms use CSRF and routes are middleware protected.

## 4. Fast Security Spot Checks

- Try posting `role=Admin` in register request: user must still become Member.
- As Member, attempt to open `/members` or admin pages: must return forbidden/blocked.
- Try borrowing same out-of-stock book repeatedly: must fail with unavailable message.

## 5. Suggested Exam Demo Order (5-8 minutes)

1. Show login/register pages.
2. Register new member and login.
3. Show member catalog + profile status + my borrowings.
4. Show unavailable borrow case message.
5. Login as admin, create librarian.
6. Show members page + books CRUD.
7. Show roles & permissions page.

## 6. Notes for Submission

- Commit to branch: `Midterm25`.
- Push to remote.
- Compress and submit required folders/files as requested by exam instructions.
