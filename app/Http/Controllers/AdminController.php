<?php

namespace App\Http\Controllers;

use App\Models\Mall;
use App\Models\Segmentation;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $sidebar = 'home';
        $listUser = User::all();
        // dd($listUser);
        return view('admin.home', compact('sidebar', 'listUser'));
    }

    public function searchUser(Request $req)
    {
        // dd($req->all());
        $sidebar = 'home';
        $listUser = User::where('name', 'like', '%' . $req->search . '%')->get();
        return view('admin.home', compact('sidebar', 'listUser'));
    }

    public function mallList()
    {
        $sidebar = 'mall';
        $listMall = Mall::all();
        // dd($listMall);
        return view('admin.mallList', compact('sidebar', 'listMall'));
    }

    public function searchMall(Request $req)
    {
        // dd($req->all());
        $sidebar = 'mall';
        $listMall = Mall::where('name', 'like', '%' . $req->search . '%')->get();
        return view('admin.mallList', compact('sidebar', 'listMall'));
    }

    public function mallDetail($id)
    {
        $sidebar = 'mall';
        $mall = Mall::find($id);
        $listSegment = Segmentation::WHERE('mall_id', $id)->get();
        return view('admin.mallDetail', compact('sidebar', 'mall', 'listSegment'));
    }

    public function addMall()
    {
        $sidebar = 'mall';
        return view('admin.addMall', compact('sidebar'));
    }
}
