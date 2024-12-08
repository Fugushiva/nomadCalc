<?php

use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;


Route::get('/tag', [TagController::class, "index"])
    ->name('tag.index');
