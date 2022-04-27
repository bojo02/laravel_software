<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class access_sales
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
        if(Auth::user()->role->slug != "sales" &&
         Auth::user()->role->slug != "account" && 
         Auth::user()->role->slug != "designer" && 
         Auth::user()->role->slug != "office" &&
         Auth::user()->role->slug != "admin"){
            return back()->with('warning', 'Нямаш достъп до тази страница!');
        }

        return $next($request);
    }
}
