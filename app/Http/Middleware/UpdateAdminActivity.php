<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use App\Core\Interfaces\UserMenuInterface;
use App\Core\Interfaces\UserSubmenuInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateAdminActivity{

    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('admin')->check()) { // Ensure only admins trigger this
            Auth::guard('admin')->user()->update([
                'last_activity' => Carbon::now(),
                'last_login_ip' => $request->ip(),
                'is_online' => 1,
            ]);
        }
        return $next($request);
    }



}
