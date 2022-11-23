<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Reservation;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $sidebar = 'home';
        $listReservasi = Reservation::where('status', '!=', '0')->get();
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
}
