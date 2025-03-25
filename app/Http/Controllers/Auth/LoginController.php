<?php

namespace App\Http\Controllers\Auth;

use App\Core\Interfaces\UserInterface;

use App\Models\User;
use App\Models\User\PreRegistrationModel;
use Auth;
use Session;
use Illuminate\Http\Request;
use App\Core\Helpers\__cache;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class LoginController extends Controller{
    use AuthenticatesUsers;

    protected $user_repo;

    protected $auth;
    protected $session;
    protected $__cache;
    protected $event;
    protected $redirectTo = 'dashboard/home';
    protected $maxAttempts = 4;
    protected $decayMinutes = 2;

    public function __construct(UserInterface $user_repo, __cache $__cache){

        $this->user_repo = $user_repo;

        $this->auth = auth();
        $this->session = session();
        $this->__cache = $__cache;

        $this->middleware('guest:web')->except('logout');

    }

    public function username(){
        return 'email';

    }

//    public function login(Request $request)
//    {
//        $credentials = $request->only('email', 'password');
//
//        // Check if user exists in the main users table
//        if (!User::where('email', $request->email)->exists()) {
//            // Check if user exists in the pre-registration table and is pending approval
//            $preReg = PreRegistrationModel::where('email', $request->email)->first();
//            if ($preReg) {
//                return back()->withErrors(['email' => 'Your pre-registration is for approval of the admin.']);
//            }
//        }
//
//        // Attempt login
//        if ($this->auth->guard('web')->attempt($this->credentials($request))) {
//            if ($this->auth->user()->is_active == false) {
//                $this->session->flush();
//                $this->session->flash('AUTH_UNACTIVATED', 'Your account is currently UNACTIVATED! Please contact the designated IT Personnel to activate your account.');
//                $this->auth->logout();
//            } else {
//                $this->clearLoginAttempts($request);
//                return redirect()->intended('dashboard/home'); // Ensure this route exists
//            }
//        }
//
//        $this->incrementLoginAttempts($request);
//        return $this->sendFailedLoginResponse($request);
//    }



    public function login(Request $request)
    {
        // Validate user input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ]);

        $email = strtolower($request->email);

        // Check if user exists in the main users table
        if (!User::whereRaw('LOWER(email) = ?', [$email])->exists()) {
            // Check if user exists in the pre-registration table
            if (PreRegistrationModel::whereRaw('LOWER(email) = ?', [$email])->exists()) {
                return back()->withErrors(['email' => 'Your pre-registration is awaiting approval by the Authorized Regulation Officer.']);
            }
        }

        // Attempt login
        if (auth()->guard('web')->attempt(['email' => $email, 'password' => $request->password])) {
            $user = auth()->user();

            // Check if account is active
            if (!$user->is_active) {
                auth()->logout();
                session()->invalidate();
                session()->flash('AUTH_UNACTIVATED', 'Your account is currently UNACTIVATED! Please contact the designated IT Personnel to activate your account.');
                return back();
            }

            $this->clearLoginAttempts($request);
            return redirect()->intended('dashboard/home');
        }

        // Increment login attempts for rate limiting
        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }



    public function logout(Request $request)
    {
        if ($request->isMethod('get')) {
            if (Auth::guard('web')->check()) {
                Auth::guard('web')->user()->update(['is_online' => 0]);
                Auth::guard('web')->logout();
                $request->session()->forget(Auth::guard('web')->getName()); // Remove only user session
            }

            if (Auth::guard('admin')->check()) {
                Auth::guard('admin')->user()->update(['is_online' => 0]);
                Auth::guard('admin')->logout();
                $request->session()->forget(Auth::guard('admin')->getName()); // Remove only admin session
            }

            $request->session()->regenerateToken();

            return redirect('/');
        }

        return abort(404);
    }



}
