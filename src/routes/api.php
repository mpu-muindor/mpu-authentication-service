<?php

use App\Http\Procedures\UserProcedure;
use Illuminate\Support\Facades\Route;
use App\Http\Procedures\TennisProcedure;

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
Route::post('/getById', [\App\Http\Controllers\AuthController::class, 'getById']);
