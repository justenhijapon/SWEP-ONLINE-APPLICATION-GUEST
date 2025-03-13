<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use App\Core\Interfaces\UserMenuInterface;
use App\Core\Interfaces\UserSubmenuInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckUserRouteExist{



    protected $user_menu_repo;
    protected $user_submenu_repo;



    public function __construct(UserMenuInterface $user_menu_repo, UserSubmenuInterface $user_submenu_repo){

         $this->user_menu_repo = $user_menu_repo;
         $this->user_submenu_repo = $user_submenu_repo;
        
    }
  




//    public function handle($request, Closure $next){
//
//        if($this->user_menu_repo->isExist() || $this->user_submenu_repo->isExist()){
//
//            return $next($request);
//
//        }
//        return $next($request);
//        return abort(404);
//
//    }

    public function handle(Request $request, Closure $next)
    {
        // Check if the user has access to the route
        if (!($this->user_menu_repo->isExist() || $this->user_submenu_repo->isExist())) {
            return abort(404);
        }

        // Check if the user is active
        if (Auth::check() && Auth::user()->is_active == false) {
            // Fetch the user instance

            User::where('slug', Auth::user()->slug)->update(['is_online' => 0]);


            // Logout the user
            Auth::logout();
            Session::flush();

            return redirect('/login')->withErrors(['email' => 'Your account has been deactivated. Please contact IT for assistance.']);
        }

        return $next($request);
    }



}
