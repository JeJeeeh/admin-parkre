<?php

namespace App\Http\Controllers\API;

use App\Models\Mall;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mall = Mall::all();

        return response()->json([
            'status' => 'success',
            'data' => $mall
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
            'name' => 'required',
            'address' => 'required',
            'park_space' => 'required',
            'reserve_space' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($check->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $check->errors()
            ], 422);
        }

        $slug = str_replace(' ', '-', strtolower($request->name));

        $mall = new Mall();
        $mall->name = $request->name;
        $mall->slug = $slug;
        $mall->address = $request->address;
        $mall->park_space = $request->park_space;
        $mall->reserve_space = $request->reserve_space;
        if ($request->image) {
            $imageName = $slug . '.' . $request->image->extension();
            $request->image->storeAs("MallImages", $imageName, 'public');
            $mall->image_url = $imageName;
        }
        $isSuccess = $mall->save();

        $defaultImageUrl = secure_asset('images/default.png');

        if (!$isSuccess) {
            return response()->json([
                'status' => 'error',
                'message' => 'Mall could not be created'
            ], 500);
        }

        $data = [
            'id' => $mall->id,
            'name' => $mall->name,
            'slug' => $mall->slug,
            'address' => $mall->address,
            'park_space' => $mall->park_space,
            'reserve_space' => $mall->reserve_space,
            'image_url' => $mall->image_url ? secure_asset('storage/MallImages/' . $mall->image_url) : $defaultImageUrl,
            'created_at' => $mall->created_at,
            'updated_at' => $mall->updated_at,
        ];

        return response()->json([
            'status' => 'success',
            'message' => 'Mall created successfully',
            'data' => $data
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
        $mall = Mall::find($id);

        if (!$mall) {
            return response()->json([
                'status' => 'error',
                'message' => 'Mall not found'
            ], 404);
        }

        $defaultImageUrl = secure_asset('images/default.png');

        $data = [
            'id' => $mall->id,
            'name' => $mall->name,
            'slug' => $mall->slug,
            'address' => $mall->address,
            'park_space' => $mall->park_space,
            'reserve_space' => $mall->reserve_space,
            'image_url' => $mall->image_url ? secure_asset('storage/MallImages/' . $mall->image_url) : $defaultImageUrl,
            'created_at' => $mall->created_at,
            'updated_at' => $mall->updated_at,
        ];

        return response()->json([
            'status' => 'success',
            'data' => $data
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
        $mall = Mall::find($id);

        if (!$mall) {
            return response()->json([
                'status' => 'error',
                'message' => 'Mall not found'
            ], 404);
        }

        $check = Validator::make($request->all(), [
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($check->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $check->errors()
            ], 422);
        }

        $slug = str_replace(' ', '-', strtolower($request->name));

        $mall->name = $request->name;
        $mall->slug = $slug;
        $mall->address = $request->address;
        $mall->park_space = $request->park_space;
        $mall->reserve_space = $request->reserve_space;
        if ($request->image) {
            $imageName = $slug . '.' . $request->image->extension();
            $request->image->storeAs("MallImages", $imageName, 'public');
            $mall->image_url = $imageName;
        }
        $isSuccess = $mall->save();

        $defaultImageUrl = secure_asset('images/default.png');

        if (!$isSuccess) {
            return response()->json([
                'status' => 'error',
                'message' => 'Mall could not be updated'
            ], 500);
        }

        $data = [
            'id' => $mall->id,
            'name' => $mall->name,
            'slug' => $mall->slug,
            'address' => $mall->address,
            'park_space' => $mall->park_space,
            'reserve_space' => $mall->reserve_space,
            'image_url' => $mall->image_url ? secure_asset('storage/MallImages/' . $mall->image_url) : $defaultImageUrl,
            'created_at' => $mall->created_at,
            'updated_at' => $mall->updated_at,
        ];

        return response()->json([
            'status' => 'success',
            'message' => 'Mall updated successfully',
            'data' => $data
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
        $mall = Mall::find($id);

        if (!$mall) {
            return response()->json([
                'status' => 'error',
                'message' => 'Mall not found'
            ], 404);
        }

        $isSuccess = $mall->delete();

        if (!$isSuccess) {
            return response()->json([
                'status' => 'error',
                'message' => 'Mall could not be deleted'
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Mall deleted successfully'
        ], 200);
    }
}
