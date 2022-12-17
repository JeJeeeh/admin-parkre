<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LogMiddleware
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
        $response = $next($request);

        $user = Session::get('activeUser')->name ?? 'Guest';

        $message = 'User: ' . $user . ' | Method: ' . $request->method() . ' | Url: ' . $request->path() . ' | Code: ' . $response->status();

        Log::create([
            'message' => $message,
            'created_at' => Carbon::now(),
        ]);

        return $response;
    }
}
