<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'all']);
    Route::get('/{id}', [UserController::class, 'get']);
    Route::post('/create', [UserController::class, 'create']);
    Route::post('/update/{id}', [UserController::class, 'update']);
});
