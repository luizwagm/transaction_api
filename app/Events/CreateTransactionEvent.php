<?php

namespace App\Events;

use App\Http\Requests\Transaction\TransactionRequest;
use Illuminate\Foundation\Events\Dispatchable;

class CreateTransactionEvent
{
    use Dispatchable;

    /**
     * $id variable
     *
     * @var integer
     */
    public int $id;

    /**
     * Constructs function
     *
     * @param TransactionRequest $request
     */
    public function __construct(
        public TransactionRequest $request
    ) {}

    /**
     * set transactionId to id function
     *
     * @param integer $transactionId
     * @return void
     */
    public function setTransactionId(int $transactionId)
    {
        $this->id = $transactionId;
    }
}
