<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Job;
use App\Models\Reservation;
use App\Models\Announcement;
use App\Models\Segmentation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activeUser = auth('api-staff')->user();

        $mallId = null;

        try {
            $mallId = Job::where('staff_id', $activeUser->id)->first()->mall_id;
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'You are not assigned to any mall!'
            ], 404);
        }

        $segmentations = Segmentation::select('id')->where('mall_id', $mallId)->get();
        $listReservasi = Reservation::select(['reservations.*', 'users.name as user_name', 'vehicles.plate as vehicle_plate', 'segmentations.name as segmentation_name'])->join('users', 'users.id', '=', 'reservations.user_id')->join('vehicles', 'vehicles.id', '=', 'reservations.vehicle_id')->join('segmentations', 'segmentations.id', '=', 'reservations.segmentation_id')->where([
            ['status', '>', '0']
        ])->whereIn('segmentation_id', $segmentations)->get();


        return response()->json([
            'status' => 'success',
            'reservations' => $listReservasi
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function announcement()
    {
        $listAnnouncement = Announcement::select(['announcements.*', 'malls.name as mall_name'])->join('malls', 'malls.id', '=', 'announcements.mall_id')->where('status', '>', '0')->get();
        return response()->json([
            'status' => 'success',
            'announcements' => $listAnnouncement
        ]);
    }
}
