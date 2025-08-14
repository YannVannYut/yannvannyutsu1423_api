<?php

namespace App\Http\Controllers;

use App\Helpers\validation\validation;
use App\Models\Position;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PositionController extends Controller
{
    public function index()
    {
        return Position::all();
    }


    function lists(Request $request)
    {
        $data = Position::all();
        return response()->json([
            'status' => 'success',
            'data' => $data,
            'status_code' => 200
        ]);
    }

    function create(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'branch_id' => 'required|numeric|',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
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
        $position = new Position();
        $position->branch_id = $request->branch_id;
        $position->name = $request->name;
        $position->description = $request->description;
        $position->save();
        return response()->json([
            'status' => 'success',
            'new_data' => $position,
            'status_code' => 200
        ]);
    }


    function update(Request $request)
    {
        $position = Position::find($request->id);
        if ($position != null) {
            $position->branch_id = $request->branch_id;
            $position->name = $request->name;
            $position->description = $request->description;
            $position->save();
            return response()->json([
                'status' => 'success',
                'update_data' => $position,
                'status_code' => 200
            ]);
        }
    }

    function delete(Request $request)
    {
        $position = Position::find($request->id);
        if ($position != null) {
            $position->delete();
            return response()->json([
                'status' => 'success',
                'delete_data' => $position,
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
