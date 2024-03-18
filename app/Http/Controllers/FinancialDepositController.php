<?php

namespace App\Http\Controllers;

use App\Events\DepositEvent;
use App\Http\Requests\FinancialDeposit\FinancialDepositRequest;
use App\Http\Resources\FinancialDeposit\DepositResource;
use App\Http\Resources\FinancialDeposit\GetDepositsResource;
use App\Services\FinancialDeposit\FinancialDepositServiceInterface;

class FinancialDepositController extends Controller
{
    /**
     * Constructs function
     *
     * @param FinancialDepositServiceInterface $service
     */
    public function __construct(
        protected FinancialDepositServiceInterface $service
    ) {}

    /**
     * Deposit to wallet function
     *
     * @param FinancialDepositRequest $request
     * @return void
     */
    public function deposit(FinancialDepositRequest $request)
    {
        DepositEvent::dispatch($request);

        return new DepositResource([]);
    }

    /**
     * Get all deposits function
     *
     * @param integer $walletId
     * @return void
     */
    public function get(int $walletId)
    {
        return new GetDepositsResource($this->service->get($walletId));
    }
}
