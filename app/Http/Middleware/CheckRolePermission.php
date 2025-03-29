<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRolePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$permissions
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$permissions)
    {
        // Get the authenticated user
        $user = auth()->user();

        // Check if the user has any of the required permissions
        foreach ($permissions as $permission) {
            // dd($permission, $user->can($permission));
            if ($user->can($permission)) {
                return $next($request);
            }
        }

        return redirect('/admin')->with([
            'success' => false,
            'error' => 'You do not have permission for that.'
        ]);
    }
}
