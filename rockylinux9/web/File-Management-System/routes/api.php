<?php

use App\Http\Controllers\Api\AreaController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;


    Route::apiResource('/areas',AreaController::class);

    Route::apiResource('/users',UserController::class);

    Route::apiResource('/roles', RoleController::class);

    Route::apiResource('/permissions', PermissionController::class);

?>