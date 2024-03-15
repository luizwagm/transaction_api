<?php

namespace App\Repositories\FinancialDeposit;

use App\Http\Requests\FinancialDeposit\FinancialDepositRequest;
use App\Models\FinancialDeposit;
use Illuminate\Database\Eloquent\Collection;

class FinancialDepositRepository implements FinancialDepositRepositoryInterface
{
    /**
     * $model variable
     *
     * @var FinancialDeposit
     */
    protected FinancialDeposit $model;

    /**
     * Construct function
     *
     * @param FinancialDeposit $financialDeposit
     */
    public function __construct(FinancialDeposit $financialDeposit)
    {
        $this->model = $financialDeposit;
    }

    /**
     * Get deposits function
     *
     * @param integer $walletId
     * @return Collection
     */
    public function get(int $walletId): Collection
    {
        return $this->model->where('wallet_id', $walletId)->get();
    }

    /**
     * Deposit to wallet function
     *
     * @param FinancialDepositRequest $request
     * @return FinancialDeposit
     */
    public function deposit(FinancialDepositRequest $request): FinancialDeposit
    {
        return $this->model->create(
                [
                    'wallet_id' => $request?->wallet_id,
                    'value' => $request?->value,
                    'status' => FinancialDeposit::STATUS_WAITING,
                ]
            );
    }

    /**
     * Update to completed status function
     *
     * @param integer $id
     * @return boolean
     */
    public function updateCompleted(int $id): bool
    {
        $get = $this->model->find($id);

        $get->status = FinancialDeposit::STATUS_COMPLETED;
        $get->save();

        return $get;
    }

    /**
     * Update to failed status function
     *
     * @param integer $id
     * @return boolean
     */
    public function updateFailed(int $id): bool
    {
        $get = $this->model->find($id);

        $get->status = FinancialDeposit::STATUS_FAILED;
        $get->save();

        return $get;
    }
}
