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

        // find user
        $activeUser = User::where('email', '=', $req->email)->first();
        if ($activeUser && Hash::check($req->password, $activeUser->password)) {
            // login as user
            $req->session()->put('user', $activeUser);
            return redirect()->route('customer.home');
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
}
