<?php

namespace App\Http\Controllers;

use App\Helpers\validation\validation;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function index()
    {
        return Product::all();
    }


    function lists(Request $request)
    {
        $data = Product::all();
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
            'cost' => 'required|numeric',
            'price' => 'required|numeric',
            'image' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|integer|',
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
        $product = new Product();
        $product->name = $request->name;
        $product->cost = $request->cost;
        $product->price = $request->price;
        $product->image = $request->image;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->save();
        return response()->json([
            'status' => 'success',
            'new_data' => $product,
            'status_code' => 200
        ]);
    }

    function update(Request $request)
    {
        $product = Product::find($request->id);
        if ($product != null) {
            $product->name = $request->name;
            $product->cost = $request->cost;
            $product->price = $request->price;
            $product->image = $request->image;
            $product->description = $request->description;
            $product->category_id = $request->category_id;
            $product->save();
            return response()->json([
                'status' => 'success',
                'update_data' => $product,
                'status_code' => 200
            ]);
        }
    }

    function delete(Request $request)
    {
        $product = Product::find($request->id);
        if ($product != null) {
            $product->delete();
            return response()->json([
                'status' => 'success',
                'delete_data' => $product,
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
