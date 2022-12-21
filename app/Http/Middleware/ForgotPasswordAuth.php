<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Encryption\DecryptException;

class ForgotPasswordAuth
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
        $email = null;
        try {
            $email = Crypt::decryptString(Session::get('verifySession'));
        } catch (DecryptException $e) {
            //
        }
        $user = User::where('email', $email)->first();
        if (!$user) {
            return redirect()->route('forgotPassword');
        }
        return $next($request);
    }
}
