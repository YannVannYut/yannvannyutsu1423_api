<?php

namespace App\Http\Controllers;

use App\Helpers\validation\validation;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    public function index()
    {
        return Category::all();
    }

    function lists(Request $request)
    {
        $data = Category::all();
        return response()->json([
            'status' => 'success',
            'data' => $data,
            'status_code' => 200
        ]);
    }

    function create(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:500',
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
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
        return response()->json([
            'status' => 'success',
            'new_data' => $category,
            'status_code' => 200
        ]);
    }

    function update(Request $request)
    {
        $category = Category::find($request->id);
        if ($category != null) {
            $category->name = $request->name;
            $category->description = $request->description;
            $category->save();
            return response()->json([
                'status' => 'success',
                'update_data' => $category,
                'status_code' => 200
            ]);
        }
    }
    
    function delete(Request $request)
    {
        $category = Category::find($request->id);
        if ($category != null) {
            $category->delete();
            return response()->json([
                'status' => 'success',
                'delete_data' => $category,
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
