<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Biker\TodoController;
use Illuminate\Support\Facades\Route;


######## routes for bikers ########
Route::group([
    'prefix' => '/biker',
    'as' => 'biker.',
    'middleware' => 'biker'
], function () {
    Route::get('/', [AuthController::class, 'home'])->name('home');
    Route::get('/home', [AuthController::class, 'home'])->name('home');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/to-do-list', [TodoController::class, 'index'])->name('ToDoList');

    Route::get('/to-do-list', [TodoController::class, 'index'])->name('toDoList.index');
    Route::get('/to-do-list/show/{parcel}', [TodoController::class, 'show'])->name('toDoList.show');
    Route::post('/to-do-list/updateParcelStatus/{parcel}', [TodoController::class, 'update'])->name('toDoList.updateParcelStatus');
});
