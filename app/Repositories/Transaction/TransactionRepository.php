<?php

namespace App\Repositories\Transaction;

use App\Http\Requests\Transaction\TransactionRequest;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Collection;

class TransactionRepository implements TransactionRepositoryInterface
{
    /**
     * Construct function
     *
     * @param Transaction $transaction
     */
    public function __construct(
        protected Transaction $model
    ) {}

    /**
     * Get function
     *
     * @param integer $walletId
     * @param string $user
     * @return Collection
     */
    public function get(int $walletId, string $user = Transaction::PAYER): Collection
    {
        $get = $this->model;

        return $get->where(
            ($user == Transaction::PAYER ? 'wallet_id' : 'destination_wallet_id'),
            $walletId
        )->get();
    }

    /**
     * Create function
     *
     * @param TransactionRequest $request
     * @return Transaction
     */
    public function create(TransactionRequest $request): Transaction
    {
        return $this->model->create(
                [
                    'wallet_id' => $request?->wallet_id,
                    'destination_wallet_id' => $request?->destination_wallet_id,
                    'description' => $request?->description,
                    'value' => $request?->value,
                    'status' => Transaction::STATUS_STARTED
                ]
            );
    }

    /**
     * Update to completed status function
     *
     * @param integer $id
     * @return Transaction
     */
    public function updateCompleted(int $id): Transaction
    {
        $get = $this->model->find($id);

        $get->status = Transaction::STATUS_COMPLETED;
        $get->save();

        return $get;
    }

    /**
     * Update to reversed status function
     *
     * @param integer $id
     * @return Transaction
     */
    public function updateReversed(int $id): Transaction
    {
        $get = $this->model->find($id);

        $get->status = Transaction::STATUS_REVERSED;
        $get->save();

        return $get;
    }

    /**
     * Update to waiting status function
     *
     * @param integer $id
     * @return Transaction
     */
    public function updateWaiting(int $id): Transaction
    {
        $get = $this->model->find($id);

        $get->status = Transaction::STATUS_WAITING;
        $get->save();

        return $get;
    }
}
