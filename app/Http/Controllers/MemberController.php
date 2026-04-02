<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class MemberController extends Controller
{
    public function index(): View
    {
        $members = User::query()
            ->where('role', 'Member')
            ->latest()
            ->paginate(10);

        return view('members.index', compact('members'));
    }
}
