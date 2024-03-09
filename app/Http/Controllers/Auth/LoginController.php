<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Member;

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

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();
        
        $name = $googleUser->name;

        $nameParts = explode(' ', $name);

        $firstName = $nameParts[0];
        $lastName = isset($nameParts[1]) ? $nameParts[1] : '';


        // Check if the user already exists in the database
        $user = User::where('email', $googleUser->email)->first();
        if ($user) {
            Auth::login($user);
        } else {
            // If the user does not exist, create a new user
            $userData = [
                'email' => $googleUser->email,
                'email_verified_at' => date('Y-m-d H:i:s'),
                'user_type' => 'non-member',
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $user = User::create($userData);

            Member::create([
                'user_id'=>$user->id,
                'firstname' => $firstName,
                'middlename' => '',
                'lastname' => $lastName,
                'agree_to_terms' => 1,
            ]);

            Auth::login($user);
           // return redirect('member-views.membership-form');
        }

        return redirect($this->redirectTo());
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
