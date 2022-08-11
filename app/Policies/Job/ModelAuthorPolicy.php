<?php

namespace App\Policies\Job;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ModelAuthorPolicy
{
    use HandlesAuthorization;

    public function create(User $user, User $urlUser)
    {
        return $user->id === $urlUser->id || $user->is_admin;
    }

    public function view(User $user, User $urlUser)
    {
        return $user->id === $urlUser->id || $user->is_admin;
    }

    public function update(User $user, User $urlUser)
    {
        return $user->id === $urlUser->id || $user->is_admin;
    }

    public function delete(User $user, User $urlUser)
    {
        return $user->id === $urlUser->id || $user->is_admin;
    }

    public function list(User $user, User $urlUser)
    {
        return $user->id === $urlUser->id || $user->is_admin;
    }
}
