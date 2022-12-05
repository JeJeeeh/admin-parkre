<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
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
        // dd($mall);
        $listSegment = Segmentation::WHERE('mall_id', $id)->get();
        return view('admin.mallDetail', compact('sidebar', 'mall', 'listSegment'));
    }

    public function addMall()
    {
        $sidebar = 'mall';
        return view('admin.addMall', compact('sidebar'));
    }

    public function doAddMall(Request $req)
    {
        // dd($req->all());
        $rule = [
            'name' => 'required',
            'address' => 'required',
            'park_space' => 'required',
            'reserve_space' => 'required'
        ];

        //message
        $message = [
            'name.required' => 'Mall name is required',
            'address.required' => 'Mall address is required',
            'park_space.required' => 'Parking space is required',
            'reserve_space.required' => 'Reserve space is required'
        ];

        $req->validate($rule, $message);

        $mall = new Mall();
        $mall->name = $req->name;
        $mall->slug = str_replace(' ', '-', strtolower($req->name));
        $mall->address = $req->address;
        $mall->park_space = $req->park_space;
        $mall->reserve_space = $req->reserve_space;
        $mall->save();

        return redirect()->route('admin.addMall')->with('success', 'Mall has been added');
    }

    public function editMall($id)
    {
        // dd($id);
        $sidebar = 'mall';
        $mall = Mall::find($id);
        return view('admin.editMall', compact('sidebar', 'mall'));
    }

    public function doEditMall(Request $req)
    {
        // dd($req->all());
        $rule = [
            'name' => 'required',
            'address' => 'required',
            'park_space' => 'required',
            'reserve_space' => 'required'
        ];

        //message
        $message = [
            'name.required' => 'Mall name is required',
            'address.required' => 'Mall address is required',
            'park_space.required' => 'Parking space is required',
            'reserve_space.required' => 'Reserve space is required'
        ];

        $req->validate($rule, $message);

        $mall = Mall::whereId($req->id)->update([
            'name' => $req->name,
            'slug' => str_replace(' ', '-', strtolower($req->name)),
            'address' => $req->address,
            'park_space' => $req->park_space,
            'reserve_space' => $req->reserve_space
        ]);

        return redirect()->route('admin.mallDetail', $req->id)->with('success', 'Mall has been updated');
    }

    public function addSegmentation()
    {
        $sidebar = 'mall';
        $listMall = Mall::all();
        return view('admin.addSegmentation', compact('sidebar', 'listMall'));
    }

    public function doAddSegmentation(Request $req)
    {
        // dd($req->all());
        //rule
        $rule = [
            'name' => 'required',
            'mall' => 'required',
            'park_space' => 'required',
            'reserve_space' => 'required',
            'price' => 'required',
            'initial_price' => 'required'
        ];

        //message
        $message = [
            'name.required' => 'Name is required',
            'mall_id.required' => 'Mall is required',
            'park_space.required' => 'Park space is required',
            'reserve_space.required' => 'Reserve space is required',
            'price.required' => 'Price is required',
            'initial_price.required' => 'Initial price is required'
        ];

        $req->validate($rule, $message);

        $segment = new Segmentation();
        $segment->name = $req->name;
        $segment->mall_id = $req->mall;
        $segment->park_space = $req->park_space;
        $segment->reserve_space = $req->reserve_space;
        $segment->initial_price = $req->initial_price;
        $segment->price = $req->price;
        $segment->save();

        return redirect()->route('admin.addSegmentation')->with('success', 'Segmentation has been added');
    }

    public function announcement()
    {
        $sidebar = 'announcement';
        $listAnnouncement = Announcement::all();
        return view('admin.announcementList', compact('sidebar', 'listAnnouncement'));
    }
}
