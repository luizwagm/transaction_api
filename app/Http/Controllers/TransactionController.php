<?php

namespace App\Http\Controllers;

use App\Events\CreateTransactionEvent;
use App\Http\Requests\Transaction\TransactionRequest;
use App\Http\Resources\Transaction\GetTransactionResource;
use App\Http\Resources\Transaction\TransactionResource;
use App\Models\Transaction;
use App\Services\Transaction\TransactionServiceInterface;

class TransactionController extends Controller
{
    /**
     * Construct function
     *
     * @param TransactionServiceInterface $service
     */
    public function __construct(
        protected TransactionServiceInterface $service
    ) {}

    /**
     * Transaction event function
     *
     * @param TransactionRequest $request
     * @return void
     */
    public function transaction(TransactionRequest $request)
    {
        CreateTransactionEvent::dispatch($request);

        return new TransactionResource([]);
    }

    /**
     * Get all transactions function
     *
     * @param integer $walletId
     * @param [type] $user
     * @return void
     */
    public function get(int $walletId, string $user = Transaction::PAYER)
    {
        return new GetTransactionResource($this->service->get($walletId, $user));
    }
}
