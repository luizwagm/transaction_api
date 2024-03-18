<?php

namespace App\Repositories\FinancialDeposit;

use App\Http\Requests\FinancialDeposit\FinancialDepositRequest;
use App\Models\FinancialDeposit;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class FinancialDepositRepository implements FinancialDepositRepositoryInterface
{
    /**
     * Construct function
     *
     * @param FinancialDeposit $financialDeposit
     */
    public function __construct(
        protected FinancialDeposit $model
    ) {}

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
     * @return FinancialDeposit|Exception
     */
    public function deposit(FinancialDepositRequest $request): FinancialDeposit|Exception
    {
        try {
            return $this->model->create(
                    [
                        'wallet_id' => $request?->wallet_id,
                        'value' => $request?->value,
                        'status' => FinancialDeposit::STATUS_WAITING,
                    ]
                );
        } catch (\Exception $e) {
            return $e;
        }
    }

    /**
     * Update to completed status function
     *
     * @param integer $id
     * @return boolean
     */
    public function updateCompleted(int $id): FinancialDeposit
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
    public function updateFailed(int $id): FinancialDeposit
    {
        $get = $this->model->find($id);

        $get->status = FinancialDeposit::STATUS_FAILED;
        $get->save();

        return $get;
    }
}
