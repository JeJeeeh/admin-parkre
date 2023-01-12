<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles = Vehicle::all();

        return response()->json([
            'status' => 'success',
            'data' => $vehicles
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
        $activeUser = auth('api-user')->user();

        $check = Validator::make($request->all(), [
            'name' => 'required',
            'plate' => 'required',
        ]);

        if ($check->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $check->errors()
            ], 422);
        }

        $status = $activeUser->vehicles()->create([
            'name' => $request->name,
            'plate' => $request->plate,
            'color' => $request->color,
        ]);

        if (!$status) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add vehicle'
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Vehicle created!',
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
        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return response()->json([
                'status' => 'error',
                'message' => 'Vehicle not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $vehicle
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
        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return response()->json([
                'status' => 'error',
                'message' => 'Vehicle not found'
            ], 404);
        }

        $check = Validator::make($request->all(), [
            'name' => 'required',
            'plate' => 'required',
        ]);

        if ($check->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $check->errors()
            ], 422);
        }

        $status = $vehicle->update([
            'name' => $request->name,
            'plate' => $request->plate,
            'color' => $request->color,
        ]);

        if (!$status) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update vehicle'
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Vehicle updated!',
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
        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return response()->json([
                'status' => 'error',
                'message' => 'Vehicle not found'
            ], 404);
        }

        $status = $vehicle->delete();

        if (!$status) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete vehicle'
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Vehicle deleted!',
            'data' => $status
        ], 200);
    }
}
