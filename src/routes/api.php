<?php

use Illuminate\Support\Facades\Route;
use App\Http\Procedures\TennisProcedure;

// test rpc api
Route::rpc('/v1/endpoint', [TennisProcedure::class])->name('rpc.endpoint');
// -----

Route::post('/_auth', 'AuthController@auth');
Route::post('/login', 'AuthController@login');
