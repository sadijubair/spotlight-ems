<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (Auth::check()) {
            $user = Auth::user();
            
            // Check if login is disabled
            if (!$user->login_enabled) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                
                return redirect()->route('login')->withErrors([
                    'email' => 'Your login access has been disabled. Please contact administrator.'
                ]);
            }
            
            // Check if user status is not active
            if ($user->status !== 'active') {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                
                $statusMessage = match($user->status) {
                    'inactive' => 'Your account is currently inactive.',
                    'suspended' => 'Your account has been suspended.',
                    'terminated' => 'Your account has been terminated.',
                    default => 'Your account is not active.'
                };
                
                return redirect()->route('login')->withErrors([
                    'email' => $statusMessage . ' Please contact administrator for assistance.'
                ]);
            }
        }
        
        return $next($request);
    }
}
