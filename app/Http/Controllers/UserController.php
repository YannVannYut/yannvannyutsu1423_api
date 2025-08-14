<?php

namespace App\Http\Controllers;

use App\Helpers\validation\validation;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function index()
    {
        return User::all();
    }

    function lists(Request $request)
    {
        $data = User::all();
        return response()->json([
            'status' => 'success',
            'data' => $data,
            'status_code' => 200
        ]);
    }

    function create(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'username' => 'required|string|max:255|',
            'password' => 'required|string|min:8',
            'staff_id' => 'required|integer',
        ]);

        $flatErrors = collect($validated->errors()->messages())->mapWithKeys(function ($message, $field) {
            return [$field => $message[0]];
        })->toArray();
        if ($validated->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $flatErrors,
                'status_code' => 422
            ]);
        }
        $user = new User();
        $user->username = $request->username;
        $user->password = $request->password;
        $user->staff_id = $request->staff_id;
        $user->save();
        return response()->json([
            'status' => 'success',
            'new_data' => $user,
            'status_code' => 200
        ]);
    }

    function update(Request $request)
    {
        $user = User::find($request->id);
        if ($user != null) {
            $user->username = $request->username;
            $user->password = $request->password;
            $user->staff_id = $request->staff_id;
            $user->save();
            return response()->json([
                'status' => 'success',
                'update_data' => $user,
                'status_code' => 200
            ]);
        }
    }

    function delete(Request $request)
    {
        $user = User::find($request->id);
        if ($user != null) {
            $user->delete();
            return response()->json([
                'status' => 'success',
                'delete_data' => $user,
                'status_code' => 200
            ]);
        } else {
            return response()->json([
                'status' => 'resource not found',
                'status_code' => 200
            ]);
        }
    }
}
