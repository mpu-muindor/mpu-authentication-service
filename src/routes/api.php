<?php

use App\Http\Procedures\TennisProcedure;
use App\Http\Procedures\UserProcedure;
use Illuminate\Support\Facades\Route;

// test rpc api
Route::rpc(
    '/v1/endpoint',
    [
        UserProcedure::class,
        TennisProcedure::class,
    ]
);
// -----

Route::post('/_auth', 'AuthController@auth');
Route::post('/login', 'AuthController@login');
Route::post(
    '/',
    function () {
        return response()->json(['status' => 'OK']);
    }
);
