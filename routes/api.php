<?php

use App\Http\Controllers\FinancialDepositController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'all'])->name('user.all');
    Route::get('/notifications/{id}', [UserController::class, 'notifications'])->name('user.notifications');
    Route::get('/{id}', [UserController::class, 'get'])->name('user.get');
    Route::post('/', [UserController::class, 'create'])->name('user.create');
    Route::put('/{id}', [UserController::class, 'update'])->name('user.update');
});

Route::prefix('deposit')->group(function () {
    Route::get('/{walletId}', [FinancialDepositController::class, 'get'])->name('deposit.get');
    Route::post('/', [FinancialDepositController::class, 'deposit'])->name('deposit.create');
});

Route::prefix('transaction')->group(function () {
    Route::get('/{walletId}/{user}', [TransactionController::class, 'get'])->name('transaction.get');
    Route::post('/', [TransactionController::class, 'transaction'])->name('transaction.create');
});
