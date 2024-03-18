<?php

namespace App\Services\FinancialDeposit;

use App\Repositories\FinancialDeposit\FinancialDepositRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class FinancialDepositService implements FinancialDepositServiceInterface
{
    /**
     * Construct function
     *
     * @param FinancialDepositRepositoryInterface $repository
     */
    public function __construct(
        protected FinancialDepositRepositoryInterface $repository
    ) {}

    /**
     * Get financial deposits function
     *
     * @param integer $walletId
     * @return Collection
     */
    public function get(int $walletId): Collection
    {
        return $this->repository->get($walletId);
    }
}
