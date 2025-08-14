<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/about', function () {
    $data= [
        'id'=> 1,
        'name'=> 'Dara',
        'gender'=> 'Male',

    ];
    return response()->json($data);
});
