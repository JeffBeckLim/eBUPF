<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    protected $maxAttempts = 5; // Max Attemps
    protected $decayMinutes = 5;  // Decay Minutes

    protected function redirectTo()
    {
        // Check user_type and redirect based on the user type
        $user = auth()->user();
        if ($user->user_type === 'admin') {
            return '/admin/dashboard';
        } elseif ($user->user_type === 'member') {
            return '/member';
        } else {
            return '/home'; // Default redirection for other user types
        }
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

}
