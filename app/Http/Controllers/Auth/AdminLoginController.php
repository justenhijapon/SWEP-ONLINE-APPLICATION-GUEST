<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;

class AdminLoginController extends Controller
{
	public function __construct(){
		$this->middleware('guest:admin');
	}

    public function showLoginForm(){
    	return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        // Find the admin user by username
        $admin = \App\Models\Admin::where('username', $request->username)->first();

        if (!$admin) {
            return redirect()->back()
                ->withInput($request->only('username'))
                ->withErrors(['login' => 'Invalid credentials. Please try again.']);
        }

        // Check if the account is deactivated
        if (!$admin->is_activated) {
            return redirect()->back()
                ->withInput($request->only('username'))
                ->withErrors(['login' => 'Your account is deactivated.']);
        }

        // Attempt login only if the account is active
        if (\Auth::guard('admin')->attempt($credentials)) {
            return redirect()->intended(route('admin.home'));
        }

        return redirect()->back()
            ->withInput($request->only('username'))
            ->withErrors(['login' => 'Invalid credentials. Please try again.']);
    }


//    public function login(Request $request)
//    {
//        $credentials = $request->only('username', 'password');
//
//        if (\Auth::guard('admin')->attempt($credentials)) {
//            return redirect()->intended(route('admin.home'));
//        }
//
//        return redirect()->back()
//            ->withInput($request->only('username'))
//            ->withErrors(['login' => 'Invalid credentials. Please try again.']);
//    }
}
