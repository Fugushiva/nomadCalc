<?php

use App\Http\Controllers\api\TagResourceController;
use App\Http\Controllers\api\CategoryResourceController;
use Illuminate\Support\Facades\Route;

//
Route::get('/api/tags', [TagResourceController::class,'index'])
    ->name('tag.api.index');


//Category
Route::get('/api/categories', [CategoryResourceController::class,'index'])
    ->name('api.category.index');
Route::get('/api/category/{category}', [CategoryResourceController::class,'show'])
    ->where('name', "[0-9]+")
    ->name('api.category.show');