<?php

use Illuminate\Support\Facades\Route;
use App\Http\Procedures\TennisProcedure;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// test rpc api
Route::rpc('/v1/endpoint', [TennisProcedure::class])->name('rpc.endpoint');
// -----

Route::post('/auth/login', 'AuthController@login');

Route::middleware(['auth.jwt'])->group(static function () {
    Route::post('/auth/logout', 'AuthController@logout');
    Route::post('/user', 'ApiController@getUserData');
    Route::post('/user/professor', 'ApiController@getProfessorData');
    Route::post('/user/student', 'ApiController@getStudentData');
});

Route::prefix('service')->middleware(['auth.service'])->group(static function () {
    Route::post('verify-token', 'ServiceApiController@verifyUserToken');
    Route::post('users', 'ServiceApiController@getUserList');
    Route::post('professors', 'ServiceApiController@getProfessors');
    Route::post('students', 'ServiceApiController@getStudents');
    Route::post('faculties', 'ServiceApiController@getFaculties');
    Route::post('departments', 'ServiceApiController@getDepartments');
    Route::post('groups', 'ServiceApiController@getGroups');
});
