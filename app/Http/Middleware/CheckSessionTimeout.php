<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSessionTimeout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $lastActivity = session('last_activity');

        if ($lastActivity && time() - $lastActivity > config('session.lifetime') * 60) {
            // Session expired
            Session::flush(); // Clear the session data

            // Redirect the user with a message or display an expired session view
            return redirect()->route('login')->with('message', 'Your session has expired. Please log in again.');
        }

        // Update last activity timestamp
        session(['last_activity' => time()]);

        return $next($request);
    }
}
