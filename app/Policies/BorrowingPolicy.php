<?php

namespace App\Policies;

use App\Models\User;

class BorrowingPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function mark(User $user)
    {
        return $user->isLibrarian();
    }
}
