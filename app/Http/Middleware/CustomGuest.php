<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomGuest
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
        if (auth('web')->check()) {
            return redirect()->route('customer.home');
        }
        if (auth('staff')->check()) {
            return redirect()->route('staff.home');
        }
        if (auth('admin')->check()) {
            return redirect()->route('admin.home');
        }
        return $next($request);
    }
}
