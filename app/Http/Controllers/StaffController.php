<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Job;
use App\Models\Mall;
use App\Models\Reservation;
use App\Models\Segmentation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class StaffController extends Controller
{
    public function index()
    {
        $activeUser = Session::get('activeUser');
        // dump($activeUser->id);
        $date = Carbon::now();
        $sidebar = 'home';
        $listReservasi = DB::select('SELECT r.id, r.start_time, r.end_time, s.name
            FROM reservations r, jobs j, staffs st, malls m, segmentations s
            WHERE j.staff_id = st.id
            AND r.segmentation_id = s.id
            AND s.mall_id = m.id
            AND j.staff_id = 1
            AND r.status != 0
            AND r.created_at = CURDATE()');

        // dd($listReservasi);

        return view('staff.home', compact('activeUser', 'sidebar', 'listReservasi'));
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

        $rJan = Reservation::whereMonth('created_at', 1)->count();
        $rFeb = Reservation::whereMonth('created_at', 2)->count();
        $rMar = Reservation::whereMonth('created_at', 3)->count();
        $rApr = Reservation::whereMonth('created_at', 4)->count();
        $rMay = Reservation::whereMonth('created_at', 5)->count();
        $rJun = Reservation::whereMonth('created_at', 6)->count();
        $rJul = Reservation::whereMonth('created_at', 7)->count();
        $rAug = Reservation::whereMonth('created_at', 8)->count();
        $rSep = Reservation::whereMonth('created_at', 9)->count();
        $rOct = Reservation::whereMonth('created_at', 10)->count();
        $rNov = Reservation::whereMonth('created_at', 11)->count();
        $rDes = Reservation::whereMonth('created_at', 12)->count();

        $labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        $data = [$rJan, $rFeb, $rMar, $rApr, $rMay, $rJun, $rJul, $rAug, $rSep, $rOct, $rNov, $rDes];

        return view('staff.report', compact('sidebar', 'labels', 'data'));
    }

    public function doAddAnnouncement(Request $req)
    {
        // dd($req->all());
        $req->validate([
            'title' => 'required',
            'segment' => 'required',
        ]);

        $announcement = new Announcement();
        $announcement->title = $req->title;
        $announcement->content = $req->content;
        $announcement->segment_id = $req->segment;
        $announcement->status = 0; //fixed
        $announcement->save();

        return redirect()->route('staff.announcement')->with('success', 'Announcement has been added');
    }
}
