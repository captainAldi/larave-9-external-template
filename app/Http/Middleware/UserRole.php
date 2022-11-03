<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $roleUser)
    {
        if(auth()->user()->role == $roleUser){
            return $next($request);
        } else {
            if (auth()->user()->role == 'admin') {
                return redirect('/admin/home')->with('status', 'Tidak Punya Permission !');
            } elseif (auth()->user()->role == 'staff') {
                return redirect('/staff/home')->with('status', 'Tidak Punya Permission !');
            } 
        }
    }

}
