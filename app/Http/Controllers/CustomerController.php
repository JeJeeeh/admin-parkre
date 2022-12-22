<?php

namespace App\Http\Controllers;

use App\Models\Mall;
use App\Models\User;
use App\Models\Vehicle;
use App\Rules\ValidHour;
use App\Models\Reservation;
use Illuminate\Support\Str;
use App\Models\Announcement;
use App\Models\Segmentation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index(Request $req)
    {
        $activeUser = $req->session()->get('activeUser');
        $newAnnouncement = Announcement::where('status', '=', '2')->orderBy('created_at')->first();
        $malls = Mall::all();
        return view('customer.home', compact('newAnnouncement', 'malls', 'activeUser'));
    }

    public function searchMall(Request $req)
    {
        $newAnnouncement = Announcement::where('status', '=', '2')->orderBy('created_at')->first();
        $malls = Mall::where('name', 'like', '%' . $req->keyword . '%')->get();
        return view('customer.home', compact('malls', 'newAnnouncement'));
    }

    public function mallDetail(Request $req)
    {
        $activeUser = $req->session()->get('activeUser');
        $mall = Mall::where('slug', '=', $req->mall_slug)->first();
        $newAnnouncement = null;
        if ($mall) {
            $newAnnouncement = Announcement::where([
                ['status', '=', '1'],
                ['mall_id', '=', $mall->id]
            ])->orWhere('status', '=', '2')->orderBy('created_at')->first();
            return view('customer.mall.detail', compact('mall', 'newAnnouncement', 'activeUser'));
        }
        return redirect()->route('customer.home');
    }

    public function payment(Request $req)
    {
        $activeUser = $req->session()->get('activeUser');
        $reservation = Reservation::find($req->reservation_id);
        $res = \App\Utilities\PaymentHelper::redirectPayment([
            'product' => ["Reservation on " . $reservation->segmentation->mall->name . " - " . $reservation->segmentation->name],
            'qty' => [1],
            'price' => [$reservation->price],
            'returnUrl' => route('customer.reservations'),
            'cancelUrl' => route('customer.reservations'),
            'notifyUrl' => env('PAYMENT_BASE_NOTIFY_URL') . '/api/payment/notify',
            'referenceId' => "$reservation->id",
            'buyerName' => $activeUser->name,
            'buyerEmail' => $activeUser->email,
            'buyerPhone' => $activeUser->phone,
        ]);

        return redirect($res->Data->Url);
    }

    public function reserve(Request $req)
    {
        $mall = Mall::where('slug', '=', $req->mall_slug)->first();
        $activeUser = $req->session()->get('activeUser');
        if ($mall) {
            $segmentation = Segmentation::where([
                ['slug', '=', $req->segmentation],
                ['mall_id', '=', $mall->id]
            ])->first();
            $newAnnouncement = Announcement::where([
                ['status', '=', '1'],
                ['mall_id', '=', $mall->id]
            ])->orWhere('status', '=', '2')->orderBy('created_at')->first();
            return view('customer.mall.reserve', compact('mall', 'segmentation', 'newAnnouncement', 'activeUser'));
        }
        return redirect()->route('customer.home');
    }

    public function doReserve(Request $req)
    {
        $req->validate([
            'vehicle' => 'required',
            'date' => 'required|date',
            'starthour' => [new ValidHour($req->endhour, $req->endminute, $req->startminute, $req->startampm, $req->endampm)],
        ], [
            'vehicle.required' => 'Please select your vehicle',
            'date.required' => 'Please select your date',
        ]);

        if ($req->startampm == 'pm') {
            $req->starthour += 12;
        }
        if ($req->endampm == 'pm') {
            $req->endhour += 12;
        }

        $start_time = $req->starthour . ':' . str_pad($req->startminute, 2, '0', STR_PAD_LEFT) . ':00';
        $end_time = $req->endhour . ':' . str_pad($req->endminute, 2, '0', STR_PAD_LEFT) . ':00';

        $reservation = new Reservation();
        $reservation->user_id = $req->session()->get('activeUser')->id;
        $reservation->segmentation_id = $req->segmentation;
        $reservation->vehicle_id = $req->vehicle;
        $reservation->date = $req->date;
        $reservation->start_time = $start_time;
        $reservation->end_time = $end_time;
        $reservation->status = '0';
        $reservation->price = $req->price;
        $reservation->save();

        return redirect()->route('customer.payment', ['reservation_id' => $reservation->id]);
    }

    public function profile(Request $req)
    {
        $activeUser = User::find($req->session()->get('activeUser')->id);
        if ($activeUser) {

            return view('customer.profile', compact('activeUser'));
        }
        return back();
    }

    public function editProfile(Request $req)
    {
        $activeUser = User::find($req->session()->get('activeUser')->id);
        if ($activeUser) {
            return view('customer.profile_edit', compact('activeUser'));
        }
        return back();
    }

    public function doEditProfile(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'password' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'name.required' => 'Please enter your name',
            'address.required' => 'Please enter your address',
            'phone.required' => 'Please enter your phone number',
            'password.required' => 'Please enter your password',
            'image.image' => 'Please upload an image',
        ]);

        if (Hash::check($req->password, $req->session()->get('activeUser')->password)) {
            $activeUser = User::find($req->session()->get('activeUser')->id);
            if ($activeUser) {
                $activeUser->name = $req->name;
                $activeUser->address = $req->address;
                $activeUser->phone = $req->phone;
                if ($req->image) {
                    $imageName = $activeUser->email . '.' . $req->image->extension();
                    $req->image->storeAs("userProfiles", $imageName, 'public');
                    $activeUser->image_url = "userProfiles/" . $imageName;
                }
                $activeUser->save();
                $req->session()->put('activeUser', $activeUser);
                return back()->with('success', 'Profile updated successfully');
            }
        }

        return back()->with('error', 'Password is incorrect');
    }

    public function addVehicle(Request $req)
    {
        $activeUser = User::find($req->session()->get('activeUser')->id);
        if ($activeUser) {

            return view('customer.vehicle.add', compact('activeUser'));
        }
        return back();
    }

    public function doAddVehicle(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'plate' => 'required',
        ], [
            'name.required' => 'Please enter your vehicle name',
            'plate.required' => 'Please enter your vehicle plate number',
        ]);

        $activeUser = $req->session()->get('activeUser');

        $activeUser->vehicles()->create([
            'name' => $req->name,
            'plate' => $req->plate,
            'color' => $req->color,
        ]);

        return back()->with('success', 'Vehicle added successfully');
    }

    public function editVehicle(Request $req)
    {
        $activeUser = User::find($req->session()->get('activeUser')->id);
        if ($activeUser) {
            $vehicle = Vehicle::find($req->id);
            return view('customer.vehicle.edit', compact('activeUser', 'vehicle'));
        }
        return back();
    }

    public function doEditVehicle(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'plate' => 'required',
        ], [
            'name.required' => 'Please enter your vehicle name',
            'plate.required' => 'Please enter your vehicle plate number',
        ]);

        $vehicle = Vehicle::find($req->id);
        $vehicle->name = $req->name;
        $vehicle->plate = $req->plate;
        $vehicle->color = $req->color;
        $vehicle->save();

        return redirect()->route('customer.addVehicle')->with('success', 'Vehicle updated successfully');
    }

    public function deleteVehicle(Request $req)
    {
        $res = Vehicle::where('id', '=', $req->id)->delete();
        if ($res) {
            return redirect()->route('customer.addVehicle')->with('success', 'Vehicle deleted successfully');
        }
        return redirect()->route('customer.addVehicle')->with('error', 'Vehicle delete failed');
    }

    public function reservations(Request $req)
    {
        $activeUser = User::find($req->session()->get('activeUser')->id);
        if ($activeUser) {
            $reservations = Reservation::where('user_id', '=', $activeUser->id)->get();
            return view('customer.reservations', compact('activeUser', 'reservations'));
        }
        return back();
    }
}
