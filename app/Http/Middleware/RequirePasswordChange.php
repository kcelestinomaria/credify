<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequirePasswordChange
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Skip if user is not authenticated
        if (!auth()->check()) {
            return $next($request);
        }

        $user = auth()->user();

        // Skip if user doesn't need to change password
        if (!$user->must_change_password) {
            return $next($request);
        }

        // Skip if already on password change routes
        if ($request->routeIs('password.change*') || $request->routeIs('logout')) {
            return $next($request);
        }

        // Redirect to password change form
        return redirect()->route('password.change.form')
            ->with('warning', 'You must change your password before continuing.');
    }
}
