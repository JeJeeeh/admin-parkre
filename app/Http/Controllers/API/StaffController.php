<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Job;
use App\Models\Staff;
use App\Models\Reservation;
use App\Models\Announcement;
use App\Models\Segmentation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

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
        $listReservasi = Reservation::select(['reservations.*', 'users.name as user_name', 'vehicles.plate as vehicle_plate', 'segmentations.name as segmentation_name', 'malls.name as mall_name'])->join('users', 'users.id', '=', 'reservations.user_id')->join('vehicles', 'vehicles.id', '=', 'reservations.vehicle_id')->join('segmentations', 'segmentations.id', '=', 'reservations.segmentation_id')->join('malls', 'malls.id', '=', 'segmentations.mall_id')->where([
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
        $staff = Staff::find($id);

        if (!$staff) {
            return response()->json([
                'status' => 'error',
                'message' => 'Staff not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $staff
        ], 200);
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
        $listAnnouncement = Announcement::select(['announcements.*', 'malls.name as mall_name'])->join('malls', 'malls.id', '=', 'announcements.mall_id')->where('status', '>', '0')->orderBy('updated_at', 'desc')->orderBy('created_at', 'desc')->get();
        return response()->json([
            'status' => 'success',
            'announcements' => $listAnnouncement
        ]);
    }

    public function announcementStore(Request $request)
    {
        $activeUser = auth('api-staff')->user();

        if (!$activeUser) {
            return response()->json([
                'status' => 'error',
                'message' => 'You are not logged in!'
            ], 401);
        }

        $mallId = null;

        try {
            $mallId = Job::where('staff_id', $activeUser->id)->first()->mall_id;
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'You are not assigned to any mall!'
            ], 404);
        }

        $staff_id = $activeUser->id;

        $isValid = Validator::make($request->all(), [
            'header' => 'required',
            'mall' => 'required',
        ]);

        if ($isValid->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $isValid->errors()
            ], 422);
        }

        $announcement = new Announcement();
        $announcement->header = $request->header;
        $announcement->content = $request->content;
        $announcement->mall_id = $mallId;
        $announcement->staff_id = $staff_id;
        $announcement->status = 0; //fixed
        $announcement->save();

        if (!$announcement) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create announcement!'
            ], 500);
        }

        return response([
            'status' => 'success',
            'message' => 'Announcement created successfully!',
            'data' => $announcement
        ], 201);
    }
}
