<?php

namespace App\Policies\Admin;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StationPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function viewList(User $user)
    {
        return false;
    }

    public function create(User $user)
    {
        return false;
    }

    public function update(User $user, User $member)
    {
        return false;
    }

    public function delete(User $user, User $member)
    {
        return false;
    }

    public function deleteMulty(User $user)
    {
        return false;
    }

    public function updateMulty(User $user)
    {
        return false;
    }

    public function before($user, $station)
    {
        if (in_array($user->role, [
            config('setting.user.role.super_admin'),
            config('setting.user.role.admin'),
        ])) {
            return true;
        }
    }
}
