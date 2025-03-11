<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use App\Core\Interfaces\UserMenuInterface;
use App\Core\Interfaces\UserSubmenuInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateUserActivity{

    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            Auth::user()->update([
                'last_activity' => Carbon::now(),
                'last_login_ip' => $request->ip(), // Corrected: Use `$request->ip()` instead of `ip()`
                'is_online' => 1, // Use integer instead of string '1'
            ]);
        }
        return $next($request);
    }





}
