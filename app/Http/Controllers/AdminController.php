<?php

namespace App\Http\Controllers;

use App\Models\Mall;
use App\Models\User;
use App\Models\Review;
use App\Models\Reservation;
use App\Models\Transaction;
use App\Models\Segmentation;
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

    public function report()
    {
        $sidebar = 'report';

        return view('admin.report', compact('sidebar'));
    }
    private $list_month = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
    // semua yg ada di table transactions
    public function reportTransaksiUser()
    {
        //
        $data = [];
        foreach ($this->list_month as $month) {
            $data[] = Transaction::whereMonth('created_at', $month)->count();
        }
        $labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        return compact('labels', 'data');
    }

    // total price di table transactions
    public function reportKeuntunganCustomer()
    {
        //
        $data = [];
        foreach ($this->list_month as $month) {
            $data[] = Transaction::whereMonth('created_at', $month)->sum('price');
        }
        $labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        return compact('labels', 'data');
    }

    // status di reservations 1
    public function reportReservasiCustomer()
    {
        //
        $data = [];
        foreach ($this->list_month as $month) {
            $data[] = Reservation::where('status', 1)->whereMonth('created_at', $month)->count();
        }
        $labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        return compact('labels', 'data');
    }

    // status di reservations 1 dan 0
    public function reportReservasiSukses()
    {
        //
        $data = [];
        foreach ($this->list_month as $month) {
            $data[] = Reservation::whereMonth('created_at', $month)->count();
        }
        $labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        return compact('labels', 'data');
    }


    public function reportReviewCustomer()
    {
        //
        $data = [];
        foreach ($this->list_month as $month) {
            $data[] = Review::whereMonth('created_at', $month)->avg('score') ?? 0;
        }
        $labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        return compact('labels', 'data');
    }
}
