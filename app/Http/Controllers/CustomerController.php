<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Mall;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $newAnnouncement = Announcement::where('status', '=', '1')->orderBy('created_at')->first();
        $malls = Mall::all();
        return view('customer.home', compact('newAnnouncement', 'malls'));
    }

    public function mallDetail($mallSlug)
    {
        $mall = Mall::where('slug', '=', $mallSlug)->first();
        return view('customer.mall.detail', compact('mall'));
    }
}
