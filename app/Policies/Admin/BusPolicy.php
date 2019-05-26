<?php

namespace App\Policies\Admin;

use App\Models\User;
use App\Models\Bus;
use Illuminate\Auth\Access\HandlesAuthorization;

class BusPolicy
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

    public function view(User $user, Bus $bus)
    {
        return in_array($user->id, $bus->company->userCompanies->pluck('user_id')->all());
    }

    public function update(User $user, Bus $route)
    {
        return in_array($user->id, $bus->company->userCompanies->pluck('user_id')->all());
    }

    public function delete(User $user, Bus $route)
    {
        return in_array($user->id, $bus->company->userCompanies->pluck('user_id')->all());
    }

    public function before($user, $bus)
    {
        if (in_array($user->role, [
            config('setting.user.role.super_admin'),
            config('setting.user.role.admin'),
        ])) {
            return true;
        }
    }
}
