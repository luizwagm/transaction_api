<?php

namespace App\Services\FinancialDeposit;

use Illuminate\Database\Eloquent\Collection;

interface FinancialDepositServiceInterface
{
    /**
     * Get financial deposits function
     *
     * @param integer $walletId
     * @return Collection
     */
    public function get(int $walletId): Collection;  
}
