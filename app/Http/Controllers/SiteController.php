<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        // find user
        $activeUser = User::where('email', '=', $req->email)->first();
        if ($activeUser && Hash::check($req->password, $activeUser->password)) {
            // login as user
            $req->session()->put('activeUser', $activeUser);
            return redirect()->route('customer.home');
        }

        // find staff
        $activeUser = Staff::where('username', '=', $req->email)->first();
        //login as admin
        if ($activeUser->role_id == 1) {
            if ($activeUser && Hash::check($req->password, $activeUser->password)) {
                $req->session()->put('activeUser', $activeUser);
                return redirect()->route('admin.home');
            }
        }
        //login as staff
        if ($activeUser->role_id == 2) {
            if ($activeUser && Hash::check($req->password, $activeUser->password)) {
                $req->session()->put('activeUser', $activeUser);

                return redirect()->route('staff.home');
            }
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
        return redirect()->route('login')->with('success', 'Register success');
    }

    public function logout(Request $req)
    {
        $req->session()->forget('activeUser');
        return redirect()->route('index');
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
        return redirect()->route('verifyPassword');
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
        return redirect()->route('login')->with('success', 'Password changed');
    }
}
