<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;

class SeparateSession
{

    public function handle(Request $request, Closure $next)
    {
        // If admin is logged in, use a separate session
        if (Auth::guard('admin')->check()) {
            Config::set('session.cookie', 'admin_session');
        }
        // If a regular user is logged in, use another session
        elseif (Auth::guard('web')->check()) {
            Config::set('session.cookie', 'user_session');
        }

        return $next($request);
    }
}
