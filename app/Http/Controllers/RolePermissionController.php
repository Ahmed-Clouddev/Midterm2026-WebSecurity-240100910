<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class RolePermissionController extends Controller
{
    public function index(): View
    {
        $rolePermissions = [
            'Admin' => [
                'Create Librarian Accounts',
                'View Roles and Permissions',
                'View Members',
                'Manage Books (Create, Edit, Delete)',
            ],
            'Librarian' => [
                'View Members',
                'Manage Books (Create, Edit, Delete)',
            ],
            'Member' => [
                'View Available Book Catalog',
                'Borrow Books If In Stock',
                'View Own Borrowed Books',
                'View Own Borrowing Status',
            ],
        ];

        return view('admin.roles.index', compact('rolePermissions'));
    }
}
