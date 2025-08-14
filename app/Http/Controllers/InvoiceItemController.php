<?php

namespace App\Http\Controllers;

use App\Helpers\validation\validation;
use App\Models\InvoiceItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class InvoiceItemController extends Controller
{

    public function index()
    {
        return Invoiceitem::all();
    }


    function lists(Request $request)
    {
        $data = Invoiceitem::all();
        return response()->json([
            'status' => 'success',
            'data' => $data,
            'status_code' => 200
        ]);
    }


    function create(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'invoice_id' => 'required|integer',
            'product_id' => 'required|integer',
            'qty' => 'required|numeric',
            'price' => 'required|numeric',
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
        $invoiceItem = new Invoiceitem();
        $invoiceItem->invoice_id = $request->invoice_id;
        $invoiceItem->product_id = $request->product_id;
        $invoiceItem->qty = $request->qty;
        $invoiceItem->price = $request->price;
        $invoiceItem->save();
        return response()->json([
            'status' => 'success',
            'new_data' => $invoiceItem,
            'status_code' => 200
        ]);
    }


    function update(Request $request)
    {
        $invoiceItem = Invoiceitem::find($request->id);
        if ($invoiceItem != null) {
            $invoiceItem->invoice_id = $request->invoice_id;
            $invoiceItem->product_id = $request->product_id;
            $invoiceItem->qty = $request->qty;
            $invoiceItem->price = $request->price;
            $invoiceItem->save();
            return response()->json([
                'status' => 'success',
                'update_data' => $invoiceItem,
                'status_code' => 200
            ]);
        }
    }

    function delete(Request $request)
    {
        $invoiceItem = Invoiceitem::find($request->id);
        if ($invoiceItem != null) {
            $invoiceItem->delete();
            return response()->json([
                'status' => 'success',
                'delete_data' => $invoiceItem,
                'status_code' => 200
            ]);
        } else {
            return response()->json([
                'status' => 'resource not found',
                'status_code' => 404
            ]);
        }
    }
}
