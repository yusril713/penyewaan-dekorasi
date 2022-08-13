<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $userRoles = explode('|', $role);
        // dd($userRoles);

        foreach($userRoles as $r) {
            if(auth()->user()->role == $r){
                return $next($request);
            }
        }

        return abort(403, "You do not have permission to access for this page.");
    }
}
