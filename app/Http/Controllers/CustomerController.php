<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Mall;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $newAnnouncement = Announcement::where('status', '=', '2')->orderBy('created_at')->first();
        $malls = Mall::all();
        return view('customer.home', compact('newAnnouncement', 'malls'));
    }

    public function mallDetail($mall_slug)
    {
        $mall = Mall::where('slug', '=', $mall_slug)->first();
        $newAnnouncement = null;
        if ($mall) {
            $newAnnouncement = Announcement::where([
                ['status', '=', '1'],
                ['mall_id', '=', $mall->id]
            ])->orderBy('created_at')->first();
            return view('customer.mall.detail', compact('mall', 'newAnnouncement'));
        }
        return redirect()->route('customer.home');
    }
}
