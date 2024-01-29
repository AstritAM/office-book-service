<?php

use App\Http\Controllers\OfficeController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoomController;
use Illuminate\Http\Request;
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


Route::controller(OfficeController::class)->group(function () {
    Route::get('/offices', 'getAll');
    Route::post('/offices', 'create');
    Route::delete('/offices/{officeId}', 'delete');
    Route::put('/offices/{officeId}', 'update');
    Route::get('/offices/{officeId}', 'getById');
    Route::get('/office/{officeId}/schedule', 'getSchedule');
    Route::get('/offices/{officeId}/search', 'search');
});

Route::controller(RoomController::class)->group(function () {
    Route::get('/offices/{officeId}/rooms', 'getAll');
    Route::post('/offices/{officeId}/rooms', 'create');
    Route::delete('/offices/{officeId}/rooms/{roomId}', 'delete');
    Route::put('/offices/{officeId}/rooms/{roomId}', 'update');
    Route::get('/offices/{officeId}/rooms/{roomId}', 'getById');
});

Route::controller(PlaceController::class)->group(function () {
    Route::get('/offices/{officeId}/rooms/{roomId}/place', 'getAll');
    Route::post('/offices/{officeId}/rooms/{roomId}/place', 'create');
    Route::delete('/offices/{officeId}/rooms/{roomId}/place/{placeId}', 'delete');
    Route::put('/offices/{officeId}/rooms/{roomId}/place/{placeId}', 'update');
    Route::get('/offices/{officeId}/rooms/{roomId}/place/{placeId}', 'getById');
});

Route::post('/reservation', [ReservationController::class, 'reservation']);
