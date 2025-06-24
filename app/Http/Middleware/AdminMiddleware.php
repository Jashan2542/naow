<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    // Middleware logic to check if the authenticated user is an admin
    public function handle($request, \Closure $next)
    {
        // Check if user is logged in and is an admin
        if (auth()->check() && auth()->user()->type === 'admin') {
            return $next($request); // Allow access
        }

        // If not an admin, redirect to admin login with error
        return redirect('/admin/login')->withErrors(['email' => 'Access denied']);
    }
}
