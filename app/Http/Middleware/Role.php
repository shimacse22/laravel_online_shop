<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$role): Response
    {
         // If not logged in
        if (!Auth::check()) {
            // Redirect based on the URL prefix
            if ($request->is('admin/*')) {
                return redirect()->route('admin.login');
            } else {
                return redirect()->route('account.login');
            }
        }

        // If the logged-in user doesn't have the correct role
        if (Auth::user()->role !== $role) {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
    
}
