<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\AreaController;
use App\Http\Controllers\Web\FileController;
use App\Http\Controllers\Web\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
    Route::get('areas/fetch', [AreaController::class, 'fetchArea'])->name('areas.fetch');
    Route::resource('areas', AreaController::class);

    Route::get('users/fetch', [UserController::class, 'fetchUser'])->name('users.fetch');
    Route::resource('users', UserController::class);

    Route::resource('files', FileController::class);
});

require __DIR__.'/auth.php';
