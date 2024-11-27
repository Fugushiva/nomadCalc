<?php

use App\Http\Controllers\TripController;
use Illuminate\Support\Facades\Route;

Route::get('/trip', [TripController::class,'index'])
    ->name('trip.index');
Route::get('trip/create', [TripController::class,'create'])
    ->name('trip.create');
Route::post('/trip', [TripController::class,'store'])
    ->name('trip.store');
Route::get('/invite/{invite_token}', [TripController::class,'handleInvite'])
    ->name('trip.invite');