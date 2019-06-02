<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use Carbon\Carbon;
use App\Policies\Admin\CompanyPolicy;
use App\Policies\Admin\RoutePolicy;
use App\Policies\Admin\BusPolicy;
use App\Policies\Admin\UserPolicy;
use App\Policies\Admin\ProvincialPolicy;
use App\Policies\Admin\StationPolicy;
use App\Models\Company;
use App\Models\Route;
use App\Models\Bus;
use App\Models\User;
use App\Models\Provincial;
use App\Models\Station;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Company::class => CompanyPolicy::class,
        Route::class => RoutePolicy::class,
        Bus::class => BusPolicy::class,
        User::class => UserPolicy::class,
        Station::class => StationPolicy::class,
        Provincial::class => ProvincialPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();
        Passport::tokensExpireIn(Carbon::now()->addDays(15));
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));

        //gate
        Gate::define('view-all-routes', function ($user) {
            return in_array($user->role, [
                config('setting.user.role.super_admin'),
                config('setting.user.role.admin'),
            ]);
        });
        Gate::define('view-all-buses', function ($user) {
            return in_array($user->role, [
                config('setting.user.role.super_admin'),
                config('setting.user.role.admin'),
            ]);
        });
    }
}
