<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class ApiController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('myApp')->accessToken;
                $response = [
                    'status' => 'success',
                    'token' => $token,
                    'data' => $user,
                ];
                return response($response, 200);
            }

            $response = [
                'status' => 'error',
                "message" => 'Login failed!'
            ];
            return response($response, 401);
        }

        $staff = Staff::where('username', $request->email)->first();
        if ($staff) {
            if (Hash::check($request->password, $staff->password)) {
                $token = $staff->createToken('myApp')->accessToken;
                $response = [
                    'status' => 'success',
                    'token' => $token,
                    'data' => $staff,
                ];
                return response($response, 200);
            }
        }

        $response = [
            'status' => 'error',
            "message" => 'Login failed!'
        ];
        return response($response, 401);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required | email | unique:users,email',
            'password' => 'required | confirmed',
            'password_confirmation' => 'required',
            'name' => 'required | alpha',
            'phone' => 'required | numeric | digits_between:12,16',
        ]);

        if ($validator->fails()) {
            return response([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        $user = new User;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();

        $token = $user->createToken('myApp')->accessToken;
        $response = [
            'status' => 'success',
            'token' => $token,
            'data' => $user,
        ];
        return response($response, 200);
    }

    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        $response = [
            'status' => 'success',
            'message' => 'You have been successfully logged out!',
        ];
        return response($response, 200);
    }
}
