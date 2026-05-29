<?php

use App\Http\Controllers\Web\AreaController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\FileController;
use App\Http\Controllers\Web\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register',[AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AuthController::class, 'register']);
});

// ->middleware('auth');

Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('areas/fetch', [AreaController::class, 'fetchArea'])->name('areas.fetch');
    Route::resource('areas', AreaController::class);

    Route::get('users/fetch', [UserController::class, 'fetchUser'])->name('users.fetch');
    Route::put('users/profile', [UserController::class, 'editProfile'])->name('users.profile');
    Route::resource('users', UserController::class);

    Route::get('files/fetch', [FileController::class, 'fetchFile'])->name('files.fetch');
    Route::resource('files', FileController::class)->except('index');
   
});

Route::get('files', [FileController::class, 'index'])->name('files.index');
Route::get('files/download/{file}', [FileController::class, 'download'])->name('files.download');

