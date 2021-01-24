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
    '/debug',
    function (\Illuminate\Http\Request $request) {
        $code = 401;
        if ($request->bearerToken() === 'SECRET') {
            $code = $request->get('token', false) === 'top' ? 200 : 401;
        }
        \Illuminate\Support\Facades\Log::info($request->bearerToken());
        \Illuminate\Support\Facades\Log::info($request->header('Auth-Token'));
        return response('', $code);
    }
);
