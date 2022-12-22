<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Staff;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;

class SiteController extends Controller
{
    public function index()
    {
        return view('shared.index');
    }

    public function login()
    {
        return view('shared.login');
    }

    public function doLogin(Request $req)
    {
        $req->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        // // find user
        // $activeUser = User::where('email', '=', $req->email)->first();
        // if ($activeUser) {
        //     // login as user
        //     if (Hash::check($req->password, $activeUser->password)) {
        //         $req->session()->put('activeUser', $activeUser);
        //         return redirect()->route('customer.home');
        //     } else {
        //         return back()->with('error', 'User not found');
        //     }
        // }

        // // find staff
        // $activeUser = Staff::where('username', '=', $req->email)->first();
        // if ($activeUser) {
        //     if (Hash::check($req->password, $activeUser->password)) {
        //         // login as admin
        //         if ($activeUser->role_id == 1) {
        //             $req->session()->put('activeUser', $activeUser);
        //             return redirect()->route('admin.home');
        //         }
        //         // login as staff
        //         else if ($activeUser->role_id == 2) {
        //             $req->session()->put('activeUser', $activeUser);
        //             return redirect()->route('staff.home');
        //         }
        //     }
        // }

        if (Auth::guard('web')->attempt(['email' => $req->email, 'password' => $req->password])) {

            $req->session()->put('activeUser', Auth::user());

            return redirect()->route('customer.home');
        }

        if (Auth::guard('admin')->attempt(['username' => $req->email, 'password' => $req->password, 'role_id' => 1])) {

            $req->session()->put('activeUser', Auth::guard('admin')->user());

            return redirect()->route('admin.report');
        }

        if (Auth::guard('staff')->attempt(['username' => $req->email, 'password' => $req->password, 'role_id' => 2])) {

            $req->session()->put('activeUser', Auth::guard('staff')->user());

            return redirect()->route('staff.home');
        }

        return back()->with('error', 'User not found');
    }

    public function register()
    {
        return view('shared.register');
    }

    public function doRegister(Request $req)
    {
        $req->validate([
            'email' => 'required | email | unique:users,email',
            'password' => 'required | confirmed',
            'password_confirmation' => 'required',
            'name' => 'required | alpha',
            'phone' => 'required | numeric | digits_between:12,16',
        ]);

        $user = new User;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->name = $req->name;
        $user->phone = $req->phone;
        $user->address = $req->address;
        $user->save();
        return redirect()->route('login')->with('success', 'Register success');
    }

    public function logout(Request $req)
    {
        if (Auth::guard('web')->check()) {

            Auth::guard('web')->logout();
            $req->session()->forget('activeUser');

            return redirect()->route('index');
        }

        if (Auth::guard('admin')->check()) {

            Auth::guard('admin')->logout();
            $req->session()->forget('activeUser');

            return redirect()->route('index');
        }

        if (Auth::guard('staff')->check()) {

            Auth::guard('staff')->logout();
            $req->session()->forget('activeUser');

            return redirect()->route('index');
        }
    }

    public function forgotPassword(Request $req)
    {
        return view('shared.forgot');
    }

    public function doForgotPassword(Request $req)
    {
        $req->validate(
            [
                'email' => 'required | email | exists:users,email'
            ],
            [
                'email.exists' => 'Email not found'
            ]
        );

        $user = User::where('email', '=', $req->email)->first();

        while (true) {
            $otp = rand(100000, 999999);
            try {
                $user->otp = $otp;
                $user->save();
                Mail::to($user->email)->send(new ForgotPasswordMail($otp));
                $req->session()->put('verifySession', Crypt::encryptString($req->email));
                break;
            } catch (\Throwable $th) {
                //
            }
        }

        return redirect()->route('verifyToken');
    }

    public function verifyToken(Request $req)
    {
        return view('shared.verify_token');
    }

    public function doVerifyToken(Request $req)
    {
        $req->validate(
            [
                'token' => 'required | numeric | digits:6'
            ],
            [
                'token.numeric' => 'Token must be numeric',
                'token.digits' => 'Token must be 6 digits'
            ]
        );

        $user = User::where('otp', '=', $req->token)->first();
        if ($user) {
            $req->session()->forget('verifySession');
            $req->session()->put('activeUser', $user);
            return redirect()->route('changePassword');
        }

        return redirect()->route('changePassword')->with('error', 'Token invalid');
    }

    public function changePassword(Request $req)
    {
        return view('shared.change_password');
    }

    public function doChangePassword(Request $req)
    {
        $req->validate(
            [
                'password' => 'required | confirmed',
                'password_confirmation' => 'required'
            ]
        );

        $user = $req->session()->get('activeUser');
        $user->password = Hash::make($req->password);
        $user->otp = null;
        $user->save();
        $req->session()->forget('activeUser');

        return redirect()->route('login')->with('success', 'Password changed');
    }
}
