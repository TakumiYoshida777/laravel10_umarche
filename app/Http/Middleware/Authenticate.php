<?php

namespace App\Http\Middleware;


use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class Authenticate extends Middleware
{

    protected $user_route = 'user.login'; //「user.」はProbiders/RouteServiceproviderでasを使用して設定したものです。
    protected $owner_route = 'owner.login'; // 同様
    protected $admin_route = 'admin.login'; // 同様
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // return $request->expectsJson() ? null : route($this->owner_route);

        if (!$request->expectsJson()) {
            if (Route::is('owner.*')) {
                return route($this->owner_route);
            } elseif (Route::is('admin.*')) {
                return route($this->admin_route);
            } else {
                return route($this->user_route);
            }
        }
    }
}
