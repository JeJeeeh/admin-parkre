<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;

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

        // find staff
        $activeUser = Staff::where([
            ['email', '=', $req->email],
            ['password', '=', $req->password]
        ])->first();

        if (!$activeUser) {
            // find user
            $activeUser = User::where([
                ['email', '=', $req->email],
                ['password', '=', $req->password]
            ])->first();
            // if user not found
            if (!$activeUser) {
                return back()->with('error', 'User not found');
            } else {
                $req->session()->put('activeUser', $activeUser);
                return redirect()->route('user.index');
            }
        } else {
            $req->session()->put('activeUser', $activeUser);
            return redirect()->route('index');
        }
    }

    public function register()
    {
        return view('shared.register');
    }

    public function doRegister(Request $req)
    {
        return back();
    }
}
