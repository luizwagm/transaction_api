<?php

namespace App\Repositories\Wallet;

use App\Http\Requests\Wallet\WalletRequest;
use App\Models\Wallet;
use Exception;

class WalletRepository implements WalletRepositoryInterface
{
    /**
     * $model variable
     *
     * @var Wallet
     */
    protected Wallet $model;

    /**
     * Construct function
     *
     * @param Wallet $wallet
     */
    public function __construct(Wallet $wallet)
    {
        $this->model = $wallet;
    }

    /**
     * Get function
     *
     * @param integer $userId
     * @return Wallet
     */
    public function get(int $userId): Wallet
    {
        return $this->model->where('user_id', $userId)->first();
    }

    /**
     * Create function
     *
     * @param WalletRequest $request
     * @return Wallet
     */
    public function create(WalletRequest $request): Wallet|Exception
    {
        try {
            return $this->model->create(
                    [
                        'user_id' => $request?->user_id,
                        'amount' => 0.00,
                        'status' => Wallet::STATUS_OPENED,
                    ]
                );
        } catch (\Exception $e) {
            return $e;
        }
    }

    /**
     * Delete function
     *
     * @param integer $userId
     * @return boolean
     */
    public function delete(int $userId): bool
    {
        return $this->model->where('user_id', $userId)->delete();
    }

    /**
     * ValueEntry function
     *
     * @param integer $id
     * @param WalletRequest $request
     * @return Wallet
     */
    public function valueEntry(int $id, WalletRequest $request): Wallet
    {
        $get = $this->model->find($id);
        $get->amount = $get->amount + $request->value_entry;
        $get->save();

        return $get;
    }

    /**
     * ValueOutput function
     *
     * @param integer $id
     * @param WalletRequest $request
     * @return Wallet
     */
    public function valueOutput(int $id, WalletRequest $request): Wallet
    {
        $get = $this->model->find($id);
        $get->amount = $get->amount - $request->value_entry;
        $get->save();

        return $get;
    }
}