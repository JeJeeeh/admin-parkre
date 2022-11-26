<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Reservation;
use App\Models\Segmentation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StaffController extends Controller
{
    public function index()
    {
        $activeUser = Session::get('activeUser');
        // dd($activeUser);
        $date = Carbon::now();
        // dump($date->toDateString());
        $sidebar = 'home';
        $listReservasi = Reservation::where('status', '!=', '0')->whereDate('created_at', $date->toDate())->get();
        // dump($listReservasi);
        return view('staff.home', compact('sidebar', 'listReservasi'));
    }

    public function detailReservation($id)
    {
        $sidebar = 'home';
        $reservasi = Reservation::find($id);
        return view('staff.reservationDetail', compact('sidebar', 'reservasi'));
    }

    public function viewAnnouncement()
    {
        $sidebar = 'announcement';
        $listAnnouncement = Announcement::where('status', '1')->get();
        return view('staff.announcement', compact('sidebar', 'listAnnouncement'));
    }

    public function detailAnnouncement($id)
    {
        $sidebar = 'announcement';
        $announcement = Announcement::find($id);
        return view('staff.announcementDetail', compact('sidebar', 'announcement'));
    }

    public function addAnnouncement()
    {
        $sidebar = 'announcement';
        $listSegment = Segmentation::all();
        return view('staff.addAnnouncement', compact('sidebar', 'listSegment'));
    }

    public function viewReport()
    {
        $sidebar = 'report';
        return view('staff.report', compact('sidebar'));
    }
}
