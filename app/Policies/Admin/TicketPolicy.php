<?php

namespace App\Policies\Admin;

use App\Models\User;
use App\Models\Ticket;
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

    public function view(User $user, Ticket $ticket)
    {
        return in_array($user->id, $ticket->busRoute->bus->company->userCompanies->pluck('user_id')->all());
    }

    public function before($user, $ticket)
    {
        if (in_array($user->role, [
            config('setting.user.role.super_admin'),
            config('setting.user.role.admin'),
        ])) {
            return true;
        }
    }
}
