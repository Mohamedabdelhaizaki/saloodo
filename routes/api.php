<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ParcelController;
use App\Http\Controllers\Api\V1\BikerParcelController;
use Illuminate\Support\Facades\Route;
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

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    ######## public routes for both clients and biker ########
    Route::post('/logout', [AuthController::class, 'logout']);

    ######## routes for clients ########
    Route::group(['middleware' => ['client'], 'prefix' => '/client',], function () {

        Route::get('/parcels', [ParcelController::class, 'index']);
        Route::get('/parcel/{parcel}', [ParcelController::class, 'show']);
        Route::post('/parcel', [ParcelController::class, 'store']);
        Route::post('/parcels/{parcel}', [ParcelController::class, 'update']);
    });

    ######## routes for bikers ########
    Route::group(['middleware' => ['biker'], 'prefix' => '/biker',], function () {
        Route::get('/parcels', [BikerParcelController::class, 'index']);
        Route::get('/parcel/{parcel}', [BikerParcelController::class, 'show']);
        Route::post('/parcel/updatePick/{parcel}', [BikerParcelController::class, 'updatePick']);
        Route::post('/parcels/updateDeliver/{parcel}', [BikerParcelController::class, 'updateDeliver']);
    });
});
