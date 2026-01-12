<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function update(User $user, User $record): bool
{
// Admins can edit anyone, others only themselves
return $user->hasRole('Admin') || $user->is($record);
}
}
