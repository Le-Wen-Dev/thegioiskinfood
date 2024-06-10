<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;

class ApiUserController extends Controller
{
    public function index(Request $request)
    {
        $user = Users::all();
        if ($user) {
            return response()->json([
                'status' => 200,
                'message' => 'success',
                'data' => $user
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'load failed',
                'data' => []
            ]);
        }
    }
    public function store(Request $request)
    {
        $user['password'] = Hash::make($request->password);
        $user = Users::create($request->all());


        if ($user) {
            return response()->json([
                'status' => 200,
                'message' => 'created success user!',
                'data' => $user
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'create falled',
                'data' => []
            ]);
        }
    }
    public function showone($id)
    {
        $user = Users::find($id);
        if ($user) {
            return response()->json([
                'status' => '200',
                'message' => $user
            ], 200);
        } else {
            return response()->json([
                'status' => '404',
                'message' => "No such Students Found"
            ], 404);
        }
    }
    public function edituser(Request $request, $id)
    {
        $userData = $request->all();
        $user = Users::find($id);
        if ($user) {
            $user->update($userData);
            return response()->json([
                'status' => 200,
                'message' => 'updated user success!',
                'data' => $user
            ], 200);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'update user failed!',
                'data' => []
            ], 404);
        }
    }
    public function deleteuser(Request $request, $id)
    {
        $user = Users::find($id);
        if ($user) {
            $user->delete();
            return response()->json([
                'status' => 200,
                'message' => 'deleted success user!',
                'data' => []
            ], 200);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'not found recored user need delete!'
            ], 404);
        }
    }
}
