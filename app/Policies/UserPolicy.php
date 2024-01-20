<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return $user->hasPermission('view', User::class);
    }

    public function create(User $user)
    {
        return $user->hasPermission('create', User::class);
    }
    public function update(User $user)
    {
        return $user->hasPermission('update', User::class);
    }

    public function stats(User $user)
    {
        return $user->hasPermission('stats', User::class);
    }

    public function delete(User $user)
    {
        return $user->hasPermission('delete', User::class);
    }
}
