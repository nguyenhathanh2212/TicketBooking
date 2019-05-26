<?php

namespace App\Policies\Admin;

use App\Models\User;
use App\Models\Route;
use Illuminate\Auth\Access\HandlesAuthorization;

class RoutePolicy
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

    public function view(User $user, Route $route)
    {
        return in_array($user->id, $route->company->userCompanies->pluck('user_id')->all());
    }

    public function create(User $user)
    {
        foreach($user->userCompanies->pluck('role')->all() as $role) {
            if (in_array($role, [
                config('setting.user.role_company.super_manager'),
                config('setting.user.role_company.manager'),
            ])) {
                return true;
            }
        }

        return false;
    }

    public function update(User $user, Route $route)
    {
        return in_array($user->id, $route->company->userCompanies->pluck('user_id')->all());
    }

    public function delete(User $user, Route $route)
    {
        return in_array($user->id, $route->company->userCompanies->pluck('user_id')->all());
    }

    public function before($user, $route)
    {
        if (in_array($user->role, [
            config('setting.user.role.super_admin'),
            config('setting.user.role.admin'),
        ])) {
            return true;
        }
    }
}
