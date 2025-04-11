<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        // Check if the user is authenticated
        if (!$request->user()) {
            return redirect()->route('login');
        }

        // Check if the user has the required permission
        if (!$request->user()->can($permission)) {
            // If the user doesn't have the permission, redirect to a 403 page or show an error message
            abort(403, 'You do not have permission to access this resource.');
        }

        return $next($request);
    }
}
