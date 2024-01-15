<?php

namespace App\Policies;

use App\Models\User;

class BookPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
    }

    public function add(User $user)
    {
        return $user->isLibrarian();
    }

    public function edit(User $user)
    {
        return $user->isLibrarian();
    }

    public function delete(User $user)
    {
        return $user->isLibrarian();
    }
}
