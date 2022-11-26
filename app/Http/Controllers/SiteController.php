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

        $user = User::where('email', $req->email)->first();
        dump($user->password);
        dump(Hash::check($req->password, $user->password));

        // // find staff
        // $activeUser = Staff::where([
        //     ['username', '=', $req->email],
        //     ['password', '=', Hash::make($req->password)]
        // ])->first();

        // if (!$activeUser) {
        //     // find user
        //     $activeUser = User::where([
        //         ['email', '=', $req->email],
        //         ['password', '=', Hash::make($req->password)]
        //     ])->first();
        //     // if user not found
        //     if (!$activeUser) {
        //         return back()->with('error', 'User not found');
        //     } else {
        //         $req->session()->put('activeUser', $activeUser);
        //         return redirect()->route('index');
        //     }
        // } else {
        //     $req->session()->put('activeUser', $activeUser);
        //     return redirect()->route('index');
        // }
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
