<?php

namespace App\Repositories\Wallet;

use App\Http\Requests\Wallet\WalletRequest;
use App\Models\Wallet;
use Exception;

interface WalletRepositoryInterface
{
    /**
     * Get function
     *
     * @param integer $userId
     * @return Wallet
     */
    public function get(int $userId): Wallet;

    /**
     * Create function
     *
     * @param WalletRequest $request
     * @return Wallet|Exception
     */
    public function create(WalletRequest $request): Wallet|Exception;

    /**
     * Delete function
     *
     * @param integer $userId
     * @return boolean
     */
    public function delete(int $userId): bool;

    /**
     * ValueEntry function
     *
     * @param integer $id
     * @param int $value
     * @return Wallet
     */
    public function valueEntry(int $id, float $value): Wallet;

    /**
     * ValueOutput function
     *
     * @param integer $id
     * @param int $value
     * @return Wallet
     */
    public function valueOutput(int $id, float $value): Wallet;

    /**
     * find function
     *
     * @param integer $id
     * @return Wallet
     */
    public function find(int $id): Wallet|Exception;
}
