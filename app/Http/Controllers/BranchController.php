<?php

namespace App\Http\Controllers;

use App\Helpers\Validation\validation;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class BranchController extends Controller
{
    function lists(Request $request){
        $branches = DB::table('BRANCH')->get();
        return response()->json([
            'status'=> 'successfully',
            'data'=>$branches,
            'status_code'=>200
        ]);
    }
    function create(Request $request){
        // $data = "Post Success!";
        // return response()->json($data);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'contact_number' => 'required|string|max:25',
        ]);

        validation::errorMessage($validator);

        $flatErrors = collect($validator->errors()->messages())->mapWithKeys(function ($messages, $field) {
            return [$field => $messages[0]];
        })->toArray();
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $flatErrors,
                'status_code' => 422
            ], 422);
        }


        $branch = new Branch();
        $branch->name = $request->name;
        $branch->location = $request->location;
        $branch->contact_number = $request->contact_number;
        $branch->save();
        return response()->json([
            'status'=> 'Successfully',
            'new_data'=>$branch,
            'status_code'=>200
        ]); 
    }
    function update(Request $request){
        // dd($request->all());

        $branch = Branch::find($request->id);
        if($branch != null){
            $branch->name = $request->name;
            $branch->location = $request->location;
            $branch->contact_number = $request->contact_number;
            $branch->save();
        }
        return response()->json([
            'status'=> 'Successfully',
            'updated_data'=>$branch,
            'status_code'=>200
        ]);     
    }
    function delete(Request $request){
        $branch = Branch::find($request->id);
        if($branch != null){
            $branch->delete();
            return response()->json([
            'status'=> 'Successfully',
            'deleted_data'=>$branch,
            'status_code'=>200
        ]);    
        }else{
            return response()->json([
            'status'=> 'Resource not found',
            
            'status_code'=>200
        ]);  
        }
          
    }
}
