<?php

use App\Http\Controllers\ExpenseController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    Route::get('/expense', [ExpenseController::class, 'index'])
        ->name('expense.index');

    route::get('/expense/dlcsv', [ExpenseController::class,"download"])
        ->name("expense.download");
        
    route::get('/expense/search', [ExpenseController::class,'search'])
        ->name('expense.search');

   

    Route::get('/expense/create', [ExpenseController::class,'create'])
        ->name('expense.create');

    Route::post('/expense', [ExpenseController::class,'store'])
        ->name('expense.store');

    Route::delete('/expense/{expense}', [ExpenseController::class,'destroy'])
        ->where('id', '[0-9]+')
        ->name('expense.delete');

    Route::get('/expense/{expense}/edit', [ExpenseController::class,'edit'])
        ->where('id','[0-9]+')
        ->name('expense.edit');

    Route::put('/expense/{expense}', [ExpenseController::class,'update'])
        ->where('id', '[0-9]+')
        ->name('expense.update');

    Route::get('/expense/{expense}', [ExpenseController::class,'show'])
        ->where('id', '[0-9]+')
        ->name('expense.show');

    Route::get('/', [ExpenseController::class,'dashboard'])
        ->name('dashboard');

  

    });
