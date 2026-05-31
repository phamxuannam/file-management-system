<?php

use App\Http\Controllers\Api\AreaController;
use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

    Route::middleware(['web', 'auth'])->group(function() {

        Route::resource('areas', AreaController::class)->except('index', 'create', 'show','edit');

        Route::put('users/profile', [UserController::class, 'editProfile'])->name('users.profile');
        Route::resource('users', UserController::class)->except('index', 'create', 'show','edit');
       
        Route::resource('files', FileController::class)->except('index', 'create', 'show','edit');
    });
   