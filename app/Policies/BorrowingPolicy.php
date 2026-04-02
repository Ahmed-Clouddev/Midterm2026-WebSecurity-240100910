<?php

namespace App\Policies;

use App\Models\Borrowing;
use App\Models\User;

class BorrowingPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isMember();
    }

    public function view(User $user, Borrowing $borrowing): bool
    {
        return $user->isMember() && $borrowing->user_id === $user->id;
    }

    public function create(User $user): bool
    {
        return $user->isMember();
    }
}
