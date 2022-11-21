<?php

namespace App\Http\Controllers;

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

    public function register()
    {
        return view('shared.register');
    }
}
