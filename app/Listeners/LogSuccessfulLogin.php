<?php

namespace App\Listeners;

use App\Models\SessionLog;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Contracts\Queue\ShouldQueue;

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
        // Log session details to the database
        $user = $event->user;
        $ipAddress = request()->ip();
        $userAgent = request()->header('User-Agent');

        // Store session log in the database
        SessionLog::create([
            'user_id' => $user->id,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent, 
        ]);
    }
}
