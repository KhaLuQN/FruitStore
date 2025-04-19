<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function delete(User $currentUser, User $userToDelete)
    {
        return $currentUser->id === $userToDelete->id || $currentUser->isAdmin();
    }

    public function add(User $user)
    {
        return $user->role === 'admin'; // Chỉ cho phép admin thêm người dùng
    }
}
