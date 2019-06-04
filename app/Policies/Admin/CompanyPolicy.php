<?php

namespace App\Policies\Admin;

use App\Models\User;
use App\Models\Company;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy
{
    use HandlesAuthorization;

    public function viewListRoute(User $user, Company $company)
    {
        return in_array($user->id, $company->userCompanies->pluck('user_id')->all());
    }

    public function view(User $user, Company $company)
    {
        return in_array($user->id, $company->userCompanies->pluck('user_id')->all());
    }

    /**
     * Determine whether the user can create companies.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the company.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Company  $company
     * @return mixed
     */
    public function update(User $user, Company $company)
    {
        //
    }

    public function viewList(User $user)
    {
        return false;
    }

    public function before($user, $company)
    {
        if (in_array($user->role, [
            config('setting.user.role.super_admin'),
            config('setting.user.role.admin'),
        ])) {
            return true;
        }
    }
}
