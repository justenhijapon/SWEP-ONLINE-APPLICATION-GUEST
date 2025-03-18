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
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $key = 'login_attempts_' . $request->ip();
        $expiresAt = \Cache::get($key . '_expires');

        if (\Cache::has($key) && \Cache::get($key) >= 5) {
            $remainingTime = $expiresAt ? max(0, $expiresAt - now()->timestamp) : 60;
            return back()->withErrors(['login' => "Too many login attempts. Try again in 1 min."]);
        }

        $credentials = $request->only('username', 'password');
        $admin = \App\Models\Admin::where('username', $request->username)->first();

        if (!$admin) {
            $this->incrementLoginAttempts($request);
            return back()->withInput($request->only('username'))
                ->withErrors(['login' => 'Invalid credentials. Please try again.']);
        }

        if (!$admin->is_activated) {
            return back()->withInput($request->only('username'))
                ->withErrors(['login' => 'Your account is deactivated.']);
        }

        if (\Auth::guard('admin')->attempt($credentials)) {
            $this->clearLoginAttempts($request);
            return redirect()->intended(route('admin.home'));
        }

        $this->incrementLoginAttempts($request);
        return back()->withInput($request->only('username'))
            ->withErrors(['login' => 'Invalid credentials. Please try again.']);
    }

    private function incrementLoginAttempts(Request $request)
    {
        $key = 'login_attempts_' . $request->ip();
        $expiresKey = $key . '_expires';

        $attempts = \Cache::get($key, 0) + 1;
        \Cache::put($key, $attempts, now()->addMinutes(1));

        if ($attempts == 5) {
            \Cache::put($expiresKey, now()->addMinutes(1)->timestamp, now()->addMinutes(1));
        }
    }

    private function clearLoginAttempts(Request $request)
    {
        $key = 'login_attempts_' . $request->ip();
        \Cache::forget($key);
        \Cache::forget($key . '_expires');
    }


//    public function login(Request $request)
//    {
//        $request->validate([
//            'username' => 'required|string',
//            'password' => 'required|string',
//        ]);
//
//        // Apply rate limiting (5 attempts per minute)
//        if (\Cache::has('login_attempts_' . $request->ip())) {
//            if (\Cache::get('login_attempts_' . $request->ip()) >= 5) {
//                return back()->withErrors(['login' => 'Too many login attempts. Try again later.']);
//            }
//        }
//
//        $credentials = $request->only('username', 'password');
//
//        $admin = \App\Models\Admin::where('username', $request->username)->first();
//
//        if (!$admin) {
//            $this->incrementLoginAttempts($request);
//            return back()->withInput($request->only('username'))
//                ->withErrors(['login' => 'Invalid credentials. Please try again.']);
//        }
//
//        if (!$admin->is_activated) {
//            return back()->withInput($request->only('username'))
//                ->withErrors(['login' => 'Your account is deactivated.']);
//        }
//
//        if (\Auth::guard('admin')->attempt($credentials)) {
//            $this->clearLoginAttempts($request);
//            return redirect()->intended(route('admin.home'));
//        }
//
//        $this->incrementLoginAttempts($request);
//        return back()->withInput($request->only('username'))
//            ->withErrors(['login' => 'Invalid credentials. Please try again.']);
//    }
//
//    private function incrementLoginAttempts(Request $request)
//    {
//        $key = 'login_attempts_' . $request->ip();
//        \Cache::increment($key);
//        \Cache::put($key, \Cache::get($key, 0), now()->addMinutes(1)); // Block for 1 minute after 5 attempts
//    }
//
//    private function clearLoginAttempts(Request $request)
//    {
//        \Cache::forget('login_attempts_' . $request->ip());
//    }



//    public function login(Request $request)
//    {
//        $credentials = $request->only('username', 'password');
//
//        // Find the admin user by username
//        $admin = \App\Models\Admin::where('username', $request->username)->first();
//
//        if (!$admin) {
//            return redirect()->back()
//                ->withInput($request->only('username'))
//                ->withErrors(['login' => 'Invalid credentials. Please try again.']);
//        }
//
//        // Check if the account is deactivated
//        if (!$admin->is_activated) {
//            return redirect()->back()
//                ->withInput($request->only('username'))
//                ->withErrors(['login' => 'Your account is deactivated.']);
//        }
//
//        // Attempt login only if the account is active
//        if (\Auth::guard('admin')->attempt($credentials)) {
//            return redirect()->intended(route('admin.home'));
//        }
//
//        return redirect()->back()
//            ->withInput($request->only('username'))
//            ->withErrors(['login' => 'Invalid credentials. Please try again.']);
//    }


}
