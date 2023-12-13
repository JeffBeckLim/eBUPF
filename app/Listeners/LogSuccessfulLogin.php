<?php

namespace App\Listeners;

use App\Models\SessionLog;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Session;
use hisorange\BrowserDetect\Parser as Browser;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Authenticated $event)
    {
        $user = $event->user;
        $userId = $user->id;

        // Check if the flag exists in the session
        if (!Session::has('login_logged_' . $userId)) {
            // Log session details to the database
            $ipAddress = request()->ip();
            $userAgent = request()->header('User-Agent');

            // Store session log in the database
            SessionLog::create([
                'user_id' => $userId,
                'ip_address' => $ipAddress,
                'user_agent' => $userAgent,
                'operating_system' => Browser::platformName(),
                'browser_used' => Browser::browserFamily(),
            ]);

            // Set the flag in the session to indicate successful login has been logged
            Session::put('login_logged_' . $userId, true);
        }
    }
}
