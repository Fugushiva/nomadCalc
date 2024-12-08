<?php

use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;


Route::get('/tag', [TagController::class, "index"])
    ->name('tag.index');

Route::get('/tag/create', [TagController::class, 'create'])
    ->name('tag.create');

Route::post('/tag', [TagController::class, 'store'])
    ->name('tag.store');

Route::delete('/tag/{tag}', [TagController::class, 'destroy'])
    ->where('id', '[0-9]+')
    ->name('tag.delete');