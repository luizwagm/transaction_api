<?php

namespace App\Events;

use App\Http\Requests\FinancialDeposit\FinancialDepositRequest;
use Illuminate\Foundation\Events\Dispatchable;

class DepositEvent
{
    use Dispatchable;

    public int $id;

    /**
     * Constructs function
     *
     * @param FinancialDepositRequest $request
     */
    public function __construct(
        public FinancialDepositRequest $request
    ) {}

    public function setId(int $id)
    {
        $this->id = $id;
    }
}
