<?php

use App\Http\Controllers\FinancialDepositController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'all']);
    Route::get('/notifications/{id}', [UserController::class, 'notifications']);
    Route::get('/{id}', [UserController::class, 'get']);
    Route::post('/', [UserController::class, 'create']);
    Route::put('/{id}', [UserController::class, 'update']);
});

Route::prefix('deposit')->group(function () {
    Route::get('/{walletId}', [FinancialDepositController::class, 'get']);
    Route::post('/', [FinancialDepositController::class, 'deposit']);
});

Route::prefix('transaction')->group(function () {
    Route::get('/{walletId}/{user}', [TransactionController::class, 'get']);
    Route::post('/', [TransactionController::class, 'transaction']);
});

Route::get('/hello', function (Request $request) {
    return response()->json([
        "code" => 200,
        "message" => 'Hello World'
    ]);
});
