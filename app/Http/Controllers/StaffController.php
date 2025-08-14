<?php

namespace App\Http\Controllers;

use App\Helpers\validation\validation;
use App\Models\Staff;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{

    public function index()
    {
        return Staff::all();
    }

    function lists(Request $request)
    {
        $data = Staff::all();
        return response()->json([
            'status' => 'success',
            'data' => $data,
            'status_code' => 200
        ]);
    }

    function create(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'position_id' => 'required|integer',

            'name' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
            'date_of_birth' => 'required|date',
            'place_of_birth' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'nation_id_card' => 'required|string|max:20',
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
        $staff = new Staff();
        $staff->position_id = $request->position_id;
        $staff->name = $request->name;
        $staff->gender = $request->gender;
        $staff->date_of_birth = $request->date_of_birth;
        $staff->place_of_birth = $request->place_of_birth;
        $staff->address = $request->address;
        $staff->phone = $request->phone;
        $staff->nation_id_card = $request->nation_id_card;
        $staff->save();
        return response()->json([
            'status' => 'success',
            'new_data' => $staff,
            'status_code' => 200
        ]);
    }

    function update(Request $request)
    {
        $staff = Staff::find($request->id);
        if ($staff != null) {
            $staff->position_id = $request->position_id;
            $staff->name = $request->name;
            $staff->gender = $request->gender;
            $staff->date_of_birth = $request->date_of_birth;
            $staff->place_of_birth = $request->place_of_birth;
            $staff->address = $request->address;
            $staff->phone = $request->phone;
            $staff->nation_id_card = $request->nation_id_card;
            $staff->save();
            return response()->json([
                'status' => 'success',
                'update_data' => $staff,
                'status_code' => 200
            ]);
        }
    }

    function delete(Request $request)
    {
        $staff = Staff::find($request->id);
        if ($staff != null) {
            $staff->delete();
            return response()->json([

                'status' => 'success',
                'delete_data' => $staff,
                'status_code' => 200
            ]);
        } else {
            return response()->json([
                'status' => 'resouce not found',
                'status_code' => 200
            ]);
        }
    }
}
