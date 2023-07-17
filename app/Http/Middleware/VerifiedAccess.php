<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifiedAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->user_type === 'member') {
            return redirect()->route('member-dashboard');
        }
        else if (auth()->check() && auth()->user()->user_type === 'admin') {
            return redirect()->route('admin-dashboard');
        }
        else 
            return $next($request);
        // abort(403, "You need to be logged in as a member to access this page.");
    }
}
