<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;

class Authenticate extends Middleware
{
    private $guardApi = false;

    public function handle($request, Closure $next, ...$guards)
    {
        if ($guards && $guards[0] == 'api') $this->guardApi = true;

        $this->authenticate($request, $guards);

        return $next($request);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if ($this->guardApi && !$request->expectsJson()) {
            return route('unauthorized');
        }

        return route('login');
    }
}
