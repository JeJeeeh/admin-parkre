<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Job;
use App\Models\Mall;
use App\Models\User;
use App\Models\Review;
use App\Models\Reservation;
use App\Models\Transaction;
use App\Models\Segmentation;
use App\Models\Staff;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use function PHPSTORM_META\type;

class AdminController extends Controller
{
    public function index()
    {
        $sidebar = 'home';
        $listUser = User::withTrashed()->get();
        // dd($listUser);
        return view('admin.home', compact('sidebar', 'listUser'));
    }

    public function userDetail($id)
    {
        $sidebar = 'home';
        $user = User::find($id);
        $history = Reservation::where('user_id', $id)->get();
        // dd($history);
        return view('admin.userDetail', compact('sidebar', 'user', 'history'));
    }

    public function blockUser($id)
    {
        $sidebar = 'home';
        $user = User::find($id)->delete();
        return redirect()->back();
    }

    public function unblockUser($id)
    {
        $sidebar = 'home';
        $user = User::withTrashed()->find($id)->restore();
        return redirect()->back();
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
        // $listMall = Mall::all();
        $listMall = Mall::withTrashed()->get();
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
        $listSegment = Segmentation::withTrashed()->WHERE('mall_id', $id)->get();
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

        $data = [];
        foreach ($this->list_month as $month) {
            $data[] = Review::whereMonth('created_at', $month)->avg('score') ?? 0;
        }
        $labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        return compact('labels', 'data');
    }

    public function detailsReport($q = null)
    {
        $sidebar = 'report';
        $type = $q;

        return view('admin.detailreport', compact('sidebar', 'type'));
    }

    public function detailsReportJSON($type, $month)
    {
        $data = [];
        $labels = range(1, 31);
        foreach ($labels as $label) {
            switch ($type) {
                case "transaksi-user":
                    $data[] = Transaction::whereDay('created_at', $label)->whereMonth('created_at', $month)->count();
                    break;
                case "keuntungan-customer":
                    $data[] = Transaction::whereDay('created_at', $label)->whereMonth('created_at', $month)->sum('price');
                    break;
                case "reservasi-customer":
                    $data[] = Reservation::where('status', 1)->whereDay('created_at', $label)->whereMonth('created_at', $month)->count();
                    break;
                case "reservasi-sukses":
                    $data[] = Reservation::whereDay('created_at', $label)->whereMonth('created_at', $month)->count();
                    break;
                case "review-customer":
                    $data[] = Review::whereDay('created_at', $label)->whereMonth('created_at', $month)->avg('score') ?? 0;
                    break;
            }
        }
        return compact('labels', 'data');
    }

    public function updateStat($type, $month)
    {
        switch ($type) {
            case "transaksi-user":
                $title = 'Successful Transaction of This Month';
                $value = Transaction::whereMonth('created_at', $month)->count();

                $total = Transaction::count();
                $percentage = $total > 0 ? round($value / $total * 100, 2) : 0;

                $desc = "$percentage% of this year";
                break;
            case "keuntungan-customer":
                $title = 'Profit of This Month';
                $value = Transaction::whereMonth('created_at', $month)->sum('price');

                $total = Transaction::sum('price');
                $percentage = $total > 0 ? round($value / $total * 100, 2) : 0;

                $value = number_format($value, 0, ',', '.');

                $desc = "$percentage% of this year";
                break;
            case "reservasi-customer":
                $title = 'Reservation of This Month';
                $value = Reservation::where('status', 1)->whereMonth('created_at', $month)->count();

                $total = Reservation::where('status', 1)->count();
                $percentage = $total > 0 ? round($value / $total * 100, 2) : 0;

                $desc = "$percentage% of this year";
                break;
            case "reservasi-sukses":
                $title = 'Successful Reservation of This Month';
                $value = Reservation::whereMonth('created_at', $month)->count();

                $total = Reservation::count();
                $percentage = $total > 0 ? round($value / $total * 100, 2) : 0;

                $desc = "$percentage% of this year";
                break;
            case "review-customer":
                $title = 'Review of This Month';
                $value = Review::whereMonth('created_at', $month)->avg('score') ?? 0;

                $total = Review::avg('score');
                $percentage = $total > 0 ? round($value / $total * 100, 2) : 0;

                $desc = "$percentage% of this year";
                break;
        }

        return compact('title', 'value', 'desc');
    }

    public function doAddMall(Request $req)
    {
        $activeUser = Session::get('activeUser');
        // dd($req->all());
        $rule = [
            'name' => 'required',
            'address' => 'required',
            'park_space' => 'required',
            'reserve_space' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
        $message = [
            'name.required' => 'Mall name is required',
            'address.required' => 'Mall address is required',
            'park_space.required' => 'Parking space is required',
            'reserve_space.required' => 'Reserve space is required',
            'image.image' => 'Please upload an image'
        ];

        $req->validate($rule, $message);

        $slug = str_replace(' ', '-', strtolower($req->name));

        $mall = new Mall();
        $mall->name = $req->name;
        $mall->slug = $slug;
        $mall->address = $req->address;
        $mall->park_space = $req->park_space;
        $mall->reserve_space = $req->reserve_space;
        if ($req->image) {
            $imageName = $slug . '.' . $req->image->extension();
            $req->image->storeAs("MallImages", $imageName, 'public');
            $activeUser->image_url = "mallImages/" . $imageName;
        }
        $mall->save();

        return redirect()->route('admin.addMall')->with('success', 'Mall has been added');
    }

    public function blockMall($id)
    {
        //softdeletes
        $mall = Mall::withTrashed()->find($id);
        $mall->delete();

        return redirect()->back()->with('success', 'Mall has been blocked');
    }

    public function unblockMall($id)
    {
        //softdeletes
        $mall = Mall::withTrashed()->find($id);
        $mall->restore();

        return redirect()->back()->with('success', 'Mall has been blocked');
    }

    public function editMall($id)
    {
        // dd($id);
        $sidebar = 'mall';
        $mall = Mall::find($id);
        // dd($mall);
        return view('admin.editMall', compact('sidebar', 'mall'));
    }

    public function doEditMall(Request $req)
    {
        // dd($req->all());
        $rule = [
            'name' => 'required',
            'address' => 'required',
            'park_space' => 'required',
            'reserve_space' => 'required',
            'mall_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];

        //message
        $message = [
            'name.required' => 'Mall name is required',
            'address.required' => 'Mall address is required',
            'park_space.required' => 'Parking space is required',
            'reserve_space.required' => 'Reserve space is required',
            'mall_image.image' => 'Please upload an image'
        ];

        $req->validate($rule, $message);

        $slug = str_replace(' ', '-', strtolower($req->name));
        $image = '';

        if ($req->image) {
            $imageName = $slug . '.' . $req->image->extension();
            $req->image->storeAs("MallImages", $imageName, 'public');
            $image = "mallImages/" . $imageName;
        }

        $mall = Mall::find($req->id)->first();
        if ($mall) {
            $mall->name = $req->name;
            $mall->slug = $slug;
            $mall->address = $req->address;
            $mall->park_space = $req->park_space;
            $mall->reserve_space = $req->reserve_space;
            $mall->image_url = $image;
            $mall->save();
            return back()->with('success', 'Profile updated successfully');
        }

        return back()->with('success', 'Mall has been updated');
    }

    public function segmentation($id)
    {
        $sidebar = 'mall';
        $segmentation = Segmentation::WHERE('id', $id)->get();

        // dd($segmentation);

        return view('admin.segmentation', compact('sidebar', 'segmentation'));
    }

    public function addSegmentation()
    {
        $sidebar = 'mall';
        $listMall = Mall::all();
        return view('admin.addSegmentation', compact('sidebar', 'listMall'));
    }

    public function blockSegmentation($id)
    {
        //softdeletes
        $segmentation = Segmentation::withTrashed()->find($id);
        $segmentation->delete();

        return redirect()->back();
    }

    public function unblockSegmentation($id)
    {
        //softdeletes
        $segmentation = segmentation::withTrashed()->find($id);
        $segmentation->restore();

        return redirect()->back();
    }

    public function doAddSegmentation(Request $req)
    {
        $activeUser = Session::get('activeUser');
        // dd($req->all());
        $rule = [
            'name' => 'required',
            'mall' => 'required',
            'park_space' => 'required',
            'reserve_space' => 'required',
            'price' => 'required',
            'initial_price' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
        $message = [
            'name.required' => 'Name is required',
            'mall_id.required' => 'Mall is required',
            'park_space.required' => 'Park space is required',
            'reserve_space.required' => 'Reserve space is required',
            'price.required' => 'Price is required',
            'initial_price.required' => 'Initial price is required',
            'image.image' => 'Please upload an image',
        ];

        $req->validate($rule, $message);

        $slug = str_replace(' ', '-', strtolower($req->name));

        $segment = new Segmentation();
        $segment->name = $req->name;
        $segment->mall_id = $req->mall;
        $segment->slug = $slug;
        $segment->park_space = $req->park_space;
        $segment->reserve_space = $req->reserve_space;
        $segment->initial_price = $req->initial_price;
        $segment->price = $req->price;
        if ($req->image) {
            $imageName = $slug . '.' . $req->image->extension();
            $req->image->storeAs("SegmentationImages", $imageName, 'public');
            $segment->image_url = "segmentationImages/" . $imageName;
        }
        $segment->save();

        return redirect()->route('admin.addSegmentation')->with('success', 'Segmentation has been added');
    }

    public function editSegmentation($id)
    {
        // dd($id);
        $sidebar = 'mall';
        $segmentation = Segmentation::find($id);
        return view('admin.editSegmentation', compact('sidebar', 'segmentation'));
    }

    public function doEditSegmentation(Request $req)
    {
        $rule = [
            'name' => 'required',
            'park_space' => 'required',
            'reserve_space' => 'required',
            'price' => 'required',
            'initial_price' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];

        //message
        $message = [
            'name.required' => 'Segmentation name is required',
            'park_space.required' => 'Parking space is required',
            'reserve_space.required' => 'Reserve space is required',
            'price.required' => 'Price is required',
            'initial_price.required' => 'Initial price is required',

        ];

        $req->validate($rule, $message);

        $slug = str_replace(' ', '-', strtolower($req->name));

        $image = '';
        if ($req->image) {
            $imageName = $slug . '.' . $req->image->extension();
            $req->image->storeAs("SegmentationImages", $imageName, 'public');
            $image = "segmentationImages/" . $imageName;
        }

        $Segmetation = Segmentation::whereId($req->id)->update([
            'name' => $req->name,
            'park_space' => $req->park_space,
            'reserve_space' => $req->reserve_space,
            'price' => $req->price,
            'initial_price' => $req->initial_price,
            'image_url' => $image
        ]);

        return redirect()->route('admin.segmentation', $req->id)->with('success', 'Mall has been updated');
    }

    public function announcement()
    {
        $sidebar = 'announcement';
        $listAnnouncement = Announcement::withTrashed()->get();
        return view('admin.announcement', compact('sidebar', 'listAnnouncement'));
    }

    public function addAnnouncement()
    {
        $sidebar = 'announcement';
        $listMall = Mall::all();

        return view('admin.addAnnouncement', compact('sidebar', 'listMall'));
    }

    public function doAddAnnouncement(Request $req)
    {
        // dd($req->all());

        $activeUser = Session::get('activeUser');
        $admin_id = $activeUser->id;

        $rule = [
            'header' => 'required',
            'mall' => 'required'
        ];

        $message = [
            'header.required' => 'Announcement Header is required',
            'mall.required' => 'Mall is required'
        ];

        $req->validate($rule, $message);

        $ann = new Announcement();
        $ann->header = $req->header;
        $ann->content = $req->content;
        if ($req->mall == -1) {
            //input all mall
            $ann->status = 2;
            $ann->mall_id = 1;
        } else {
            $ann->status = 0;
            $ann->mall_id = $req->mall;
        }
        $ann->staff_id = $admin_id;
        $ann->save();
        return redirect()->back();
    }

    public function announcementDetail($id)
    {
        $sidebar = 'announcement';
        $ann = Announcement::find($id);
        return view('admin.announcementDetail', compact('sidebar', 'ann'));
    }

    public function deleteAnnouncement($id)
    {
        $ann = Announcement::find($id);
        $ann->delete();

        return redirect()->back();
    }

    public function restoreAnnouncement($id)
    {
        $ann = Announcement::withTrashed()->find($id);
        $ann->restore();

        return redirect()->back();
    }

    public function editAnnouncement($id)
    {
        $sidebar = 'announcement';
        $ann = Announcement::find($id);
        $listMall = Mall::all();
        return view('admin.editAnnouncement', compact('sidebar', 'ann', 'listMall'));
    }

    public function doEditAnnouncement(Request $req)
    {
        // dd($req->all());
        //error
        $rule = [
            'header' => 'required',
            'mall' => 'required'
        ];
        //message
        $message = [
            'header.required' => 'Announcement Header is required',
            'mall.required' => 'Mall is required'
        ];

        $req->validate($rule, $message);

        $announcement = Announcement::whereId($req->id)->update([
            'header' => $req->header,
            'content' => $req->content,
            'mall_id' => $req->mall
        ]);

        return redirect()->route('admin.announcementDetail', $req->id);
    }

    public function staffList()
    {
        $sidebar = 'staff';
        $listStaff = Staff::withTrashed()->where('role_id', '2')->get();
        return view('admin.staff', compact('sidebar', 'listStaff'));
    }

    public function searchStaff(Request $req)
    {
        $sidebar = 'staff';
        $listStaff = Staff::withTrashed()->where('name', 'like', '%' . $req->search . '%')->where('role_id', '2')->get();
        return view('admin.staff', compact('sidebar', 'listStaff'));
    }

    public function staffDetail($id)
    {
        $sidebar = 'staff';
        $staff = Staff::find($id);

        $listJob = Job::where('staff_id', $id)->get();

        return view('admin.detailStaff', compact('sidebar', 'staff', 'listJob'));
    }

    public function blockStaff($id)
    {
        Staff::whereId($id)->delete();
        return redirect()->back();
    }

    public function unblockStaff($id)
    {
        Staff::withTrashed()->whereId($id)->restore();
        return redirect()->back();
    }

    public function addStaff()
    {
        $sidebar = 'staff';
        return view('admin.addStaff', compact('sidebar'));
    }

    public function doAddStaff(Request $req)
    {
        // dd($req->all());
        $rule = [
            'name' => 'required',
            'username' => 'required|unique:staffs',
            'password' => 'required|min:8',
            'confirmPassword' => 'required|same:password',
            'phone' => 'required|numeric',
        ];

        $message = [
            'name.required' => 'Name is required',
            'username.required' => 'Username is required',
            'username.unique' => 'Username is already taken',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters',
            'confirmPassword.required' => 'Confirm Password is required',
            'confirmPassword.same' => 'Confirm Password must be same with Password',
            'phone.required' => 'Phone is required',
            'phone.numeric' => 'Phone must be numeric',
        ];

        $req->validate($rule, $message);

        $staff = new Staff();
        $staff->name = $req->name;
        $staff->username = $req->username;
        $staff->password = Hash::make($req->password);
        $staff->phone = $req->phone;
        $staff->address = $req->address;
        $staff->role_id = 2;
        $staff->save();

        return redirect()->route('admin.staff');
    }

    public function addJob()
    {
        $sidebar = 'staff';
        $listStaff = Staff::all();
        $listMall = Mall::all();
        return view('admin.addJob', compact('sidebar', 'listStaff', 'listMall'));
    }

    public function doAddJob(Request $req)
    {
        // dd($req->all());
        $rule = [
            'staff' => 'required',
            'mall' => 'required',
            'title' => 'required',
            'start' => 'required|date',
            'end' => 'required|date|after:start',
        ];

        $message = [
            'staff.required' => 'Staff is required',
            'mall.required' => 'Mall is required',
            'title.required' => 'Title is required',
            'start.required' => 'Start Date is required',
            'start.date' => 'Start Date must be date',
            'end.required' => 'End Date is required',
            'end.date' => 'End Date must be date',
            'end.after' => 'End Date must be after Start Date',
        ];

        $req->validate($rule, $message);

        $newJob = new Job();
        $newJob->staff_id = $req->staff;
        $newJob->mall_id = $req->mall;
        $newJob->title = $req->title;
        $newJob->start_date = $req->start;
        $newJob->end_date = $req->end;
        $newJob->save();

        return redirect()->route('admin.staff');
    }
}
