<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Domains\Campaign\Http\Controllers\{
    AwarenessController,
    InterestController,
    ConsiderationController,
    EvaluationController,
    DecisionController,
    ConversionController,
};
use App\Domains\DDay\Http\Controllers\{
    VolunteerController,
    CheckInController,
    IngressController,
    VoteController,
    CountController,
    TransmissionController,
    EgressController
};

use App\Domains\Demo\Http\Controllers\DemoRegisterController;

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

Route::post('/demo/register', DemoRegisterController::class);

Route::post('/dday/volunteer', VolunteerController::class);
Route::post('/dday/checkin', CheckInController::class);
Route::post('/dday/ingress', IngressController::class);
Route::post('/dday/vote', VoteController::class);
Route::post('/dday/count', CountController::class);
Route::post('/dday/transmission', TransmissionController::class);
Route::post('/dday/egress', EgressController::class);

Route::post('/campaign/awareness', AwarenessController::class);
Route::post('/campaign/interest', InterestController::class);
Route::post('/campaign/consideration', ConsiderationController::class);
Route::post('/campaign/evaluation', EvaluationController::class);
Route::post('/campaign/decision', DecisionController::class);
Route::post('/campaign/conversion', ConversionController::class);
