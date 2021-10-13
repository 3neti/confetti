<?php

use App\Domains\DDay\Http\Controllers\CheckinController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Domains\Campaign\Http\Controllers\{
    GoOutAndRegisterController
};

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/campaign/register', GoOutAndRegisterController::class);
Route::post('/dday/checkin', CheckinController::class);
