<?php

namespace App\Policies\Admin;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
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

    // public function viewTickets(User $user)
    // {
    //     return false;
    // }

    // public function before($user, $member)
    // {
    //     if (in_array($user->role, [
    //         config('setting.user.role.super_admin'),
    //         config('setting.user.role.admin'),
    //     ])) {
    //         return true;
    //     }
    // }
}
