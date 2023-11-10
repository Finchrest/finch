<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class SuperadminAuthenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */

    protected function authenticate($request, array $guards)
    {

        if ($this->auth->guard('superadmin')->check()) {
            return $this->auth->shouldUse('superadmin');
        }
        $this->unauthenticated($request, ['superadmin']);
    }

    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('superadmin.login');
        }
    }
}
