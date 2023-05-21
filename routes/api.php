<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\WorkerController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\APIRegisterController;
use App\Http\Controllers\Api\APILoginController;
use App\Http\Controllers\Api\AuthController ;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group([

    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
//    Route::post('me', 'AuthController@me');

});


//Route::apiResource('/workers', WorkerController::class, ['workers.index']);
Route::group(['middleware' => 'jwt.auth'], function () {
    Route::apiResource('/reports', ReportController::class, ['reports.index']);
    Route::apiResource('/workers', WorkerController::class, ['workers.index']);
});
