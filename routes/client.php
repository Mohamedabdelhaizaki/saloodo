<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Client\ParcelController;
use Illuminate\Support\Facades\Route;


######## routes for clients ########
Route::group([
    'middleware' => 'client',
    'prefix' => '/client',
    'as' => 'client.'
], function () {
    Route::get('/', [AuthController::class, 'home'])->name('home');
    Route::get('/home', [AuthController::class, 'home'])->name('home');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/parcels', [ParcelController::class, 'index'])->name('parcels.index');
    Route::get('/parcels/create', [ParcelController::class, 'create'])->name('parcels.create');
    Route::post('/parcels/store', [ParcelController::class, 'store'])->name('parcels.store');
    Route::get('/parcels/show/{parcel}', [ParcelController::class, 'show'])->name('parcels.show');
    Route::get('/parcels/edit/{parcel}', [ParcelController::class, 'edit'])->name('parcels.edit');
    Route::post('/parcels/update/{parcel}', [ParcelController::class, 'update'])->name('parcels.update');
});
