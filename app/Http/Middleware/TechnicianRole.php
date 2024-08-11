<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TechnicianRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (! $request->user()->isAn('technician')) {
            $message = "Permission Access Denied!";
            // Check if the user is authenticated
            if (Auth::check()) {
                // Redirect to the dashboard with a message
                return redirect()->to('/dashboard');
            } else {
                // Redirect to the login page
                return redirect()->to('/login')->with('message', $message);
            }
        }
        
    
        return $next($request);
    }
}
