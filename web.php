<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//test filament
Route::get('/admin-test', function(){
    return "Filament fonctionne";
});

require __DIR__.'/auth.php';
require __DIR__.'/expense.php';
require __DIR__.'/api.php';
require __DIR__.'/trip.php';