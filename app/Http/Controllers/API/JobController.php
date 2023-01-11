<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Job::all();

        return response()->json([
            'status' => 'success',
            'data' => $jobs
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $check = Validator::make($request->all(), [
            'title' => 'required',
            'staff_id' => 'required',
            'mall_id' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        if ($check->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $check->errors()
            ], 422);
        }

        $status = Job::create([
            'title' => $request->title,
            'staff_id' => $request->staff_id,
            'mall_id' => $request->mall_id,
            'start_date' => Carbon::parse($request->start_date),
            'end_date' => Carbon::parse($request->end_date),
        ]);

        if (!$status) {
            return response()->json([
                'status' => 'error',
                'message' => 'Add job failed'
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Job created!',
            'data' => $status
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job = Job::find($id);
        if (!$job) {
            return response()->json([
                'status' => 'error',
                'message' => 'Job not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $job
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
        $job = Job::find($id);
        if (!$job) {
            return response()->json([
                'status' => 'error',
                'message' => 'Job not found'
            ], 404);
        }

        $check = Validator::make($request->all(), [
            'title' => 'required',
            'staff_id' => 'required',
            'mall_id' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        if ($check->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $check->errors()
            ], 422);
        }

        $status = $job->update([
            'title' => $request->title,
            'staff_id' => $request->staff_id,
            'mall_id' => $request->mall_id,
            'start_date' => Carbon::parse($request->start_date),
            'end_date' => Carbon::parse($request->end_date),
        ]);

        if (!$status) {
            return response()->json([
                'status' => 'error',
                'message' => 'Update job failed'
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Job updated!',
            'data' => $status
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $job = Job::find($id);
        if (!$job) {
            return response()->json([
                'status' => 'error',
                'message' => 'Job not found'
            ], 404);
        }

        $status = $job->delete();

        if (!$status) {
            return response()->json([
                'status' => 'error',
                'message' => 'Delete job failed'
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Job deleted!',
        ], 200);
    }
}
