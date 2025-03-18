<?php

use App\Http\Controllers\User\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/profile/{username}', [PageController::class, 'index'])->name('user.index');
Route::get('/l/{id}', [PageController::class, 'click'])->name('link.click');
