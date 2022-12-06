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
            AND j.staff_id = ' . $activeUser->id . '
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
        $listMall = Mall::all();
        return view('staff.addAnnouncement', compact('sidebar', 'listMall'));
    }

    public function viewReport()
    {
        $sidebar = 'report';

        return view('staff.report', compact('sidebar'));
    }

    public function viewReportJSON()
    {
        $activeUser = Session::get('activeUser');

        $rJan = DB::select('SELECT COUNT(r.id)
        FROM reservations r, jobs j, staffs st, malls m, segmentations s
                    WHERE j.staff_id = st.id
                    AND r.segmentation_id = s.id
                    AND s.mall_id = m.id
                    AND j.staff_id = ' . $activeUser->id . '
                    AND MONTH(r.created_at) = 1')[0]->{'COUNT(r.id)'};
        $rFeb = DB::select('SELECT COUNT(*)
        FROM reservations r, jobs j, staffs st, malls m, segmentations s
                    WHERE j.staff_id = st.id
                    AND r.segmentation_id = s.id
                    AND s.mall_id = m.id
                    AND j.staff_id = ' . $activeUser->id . '
                    AND MONTH(r.created_at) = 2')[0]->{'COUNT(*)'};
        $rMar = DB::select('SELECT COUNT(*)
        FROM reservations r, jobs j, staffs st, malls m, segmentations s
                    WHERE j.staff_id = st.id
                    AND r.segmentation_id = s.id
                    AND s.mall_id = m.id
                    AND j.staff_id = ' . $activeUser->id . '
                    AND MONTH(r.created_at) = 3')[0]->{'COUNT(*)'};
        $rApr = DB::select('SELECT COUNT(*)
        FROM reservations r, jobs j, staffs st, malls m, segmentations s
                    WHERE j.staff_id = st.id
                    AND r.segmentation_id = s.id
                    AND s.mall_id = m.id
                    AND j.staff_id = ' . $activeUser->id . '
                    AND MONTH(r.created_at) = 4')[0]->{'COUNT(*)'};
        $rMay = DB::select('SELECT COUNT(*)
        FROM reservations r, jobs j, staffs st, malls m, segmentations s
                    WHERE j.staff_id = st.id
                    AND r.segmentation_id = s.id
                    AND s.mall_id = m.id
                    AND j.staff_id = ' . $activeUser->id . '
                    AND MONTH(r.created_at) = 5')[0]->{'COUNT(*)'};
        $rJun = DB::select('SELECT COUNT(*)
        FROM reservations r, jobs j, staffs st, malls m, segmentations s
                    WHERE j.staff_id = st.id
                    AND r.segmentation_id = s.id
                    AND s.mall_id = m.id
                    AND j.staff_id = ' . $activeUser->id . '
                    AND MONTH(r.created_at) = 6')[0]->{'COUNT(*)'};
        $rJul = DB::select('SELECT COUNT(*)
        FROM reservations r, jobs j, staffs st, malls m, segmentations s
                    WHERE j.staff_id = st.id
                    AND r.segmentation_id = s.id
                    AND s.mall_id = m.id
                    AND j.staff_id = ' . $activeUser->id . '
                    AND MONTH(r.created_at) = 7')[0]->{'COUNT(*)'};
        $rAug = DB::select('SELECT COUNT(*)
        FROM reservations r, jobs j, staffs st, malls m, segmentations s
                    WHERE j.staff_id = st.id
                    AND r.segmentation_id = s.id
                    AND s.mall_id = m.id
                    AND j.staff_id = ' . $activeUser->id . '
                    AND MONTH(r.created_at) = 8')[0]->{'COUNT(*)'};
        $rSep = DB::select('SELECT COUNT(*)
        FROM reservations r, jobs j, staffs st, malls m, segmentations s
                    WHERE j.staff_id = st.id
                    AND r.segmentation_id = s.id
                    AND s.mall_id = m.id
                    AND j.staff_id = ' . $activeUser->id . '
                    AND MONTH(r.created_at) = 9')[0]->{'COUNT(*)'};
        $rOct = DB::select('SELECT COUNT(*)
        FROM reservations r, jobs j, staffs st, malls m, segmentations s
                    WHERE j.staff_id = st.id
                    AND r.segmentation_id = s.id
                    AND s.mall_id = m.id
                    AND j.staff_id = ' . $activeUser->id . '
                    AND MONTH(r.created_at) = 10')[0]->{'COUNT(*)'};
        $rNov = DB::select('SELECT COUNT(*)
        FROM reservations r, jobs j, staffs st, malls m, segmentations s
                    WHERE j.staff_id = st.id
                    AND r.segmentation_id = s.id
                    AND s.mall_id = m.id
                    AND j.staff_id = ' . $activeUser->id . '
                    AND MONTH(r.created_at) = 11')[0]->{'COUNT(*)'};
        $rDes = DB::select('SELECT COUNT(*)
        FROM reservations r, jobs j, staffs st, malls m, segmentations s
                    WHERE j.staff_id = st.id
                    AND r.segmentation_id = s.id
                    AND s.mall_id = m.id
                    AND j.staff_id = ' . $activeUser->id . '
                    AND MONTH(r.created_at) = 12')[0]->{'COUNT(*)'};

        // dd($rJan);

        $labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        $data = [$rJan, $rFeb, $rMar, $rApr, $rMay, $rJun, $rJul, $rAug, $rSep, $rOct, $rNov, $rDes];
        // return response(json_encode(['sidebar' => $sidebar, 'labels' => $labels, 'data' => $data]), 200);
        return compact('labels', 'data');
    }

    public function doAddAnnouncement(Request $req)
    {
        $activeUser = Session::get('activeUser');
        $staff_id = $activeUser->id;
        // dd($req->all());
        $req->validate([
            'header' => 'required',
            'mall' => 'required',
        ]);

        $announcement = new Announcement();
        $announcement->header = $req->header;
        $announcement->content = $req->content;
        $announcement->mall_id = $req->mall;
        $announcement->staff_id = $staff_id;
        $announcement->status = 0; //fixed
        $announcement->save();

        return redirect()->route('staff.announcement')->with('success', 'Announcement has been added');
    }
}
