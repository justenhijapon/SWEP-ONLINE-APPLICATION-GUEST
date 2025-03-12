<?php

namespace App\Http\Middleware;

use Closure;
use App\Swep\Repositories\Admin\AdminFunctionsRepository;
use Auth;
class CheckAdminRouteExist{



    protected $admin_functions_repo;



    public function __construct(AdminFunctionsRepository $admin_functions_repo){

        $this->admin_functions_repo = $admin_functions_repo;
        
    }

    public function handle($request, Closure $next)
    {
        if (Auth::guard('admin')->check()) {
            $admin = Auth::guard('admin')->user();

            // Check if the admin is deactivated
            if (!$admin->is_activated) {
                // Update is_login to 0
                $admin->update(['is_online' => 0]);

                // Logout the admin
                Auth::guard('admin')->logout();

                return redirect()->route('admin.login')->withErrors([
                    'login' => 'Your account has been deactivated.',
                ]);
            }

            // Check if the route exists
            if ($this->admin_functions_repo->checkRouteExists() == true) {
                return $next($request);
            }

            return abort(404);
        }

        return redirect(route('admin.login'));
    }





//    public function handle($request, Closure $next){
//
//        if(Auth::guard('admin')->check()){
//            if($this->admin_functions_repo->checkRouteExists() == true){
//                return $next($request);
//            }
//
//            return abort(404);
//        }else{
//            return redirect(route('admin.login'));
//
//        }
//
//    }





}
