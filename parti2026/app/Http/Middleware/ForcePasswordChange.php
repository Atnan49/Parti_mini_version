<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForcePasswordChange
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && $request->user()->must_change_password) {
            // Allow access to change password routes and logout, redirect all other routes
            if (!$request->routeIs('admin.change-password') && 
                !$request->routeIs('admin.change-password.update') && 
                !$request->routeIs('logout')) {
                return redirect()->route('admin.change-password');
            }
        }

        return $next($request);
    }
}
