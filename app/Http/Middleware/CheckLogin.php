<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Session;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $loginStatus = Session::get('loginStatus');
        if (!$loginStatus && $loginStatus != User::LOGIN_STATUS_UP) {
            return redirect('login');
        }
        return $next($request);
    }
}
