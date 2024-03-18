<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wallet extends Model
{
    use HasFactory, SoftDeletes;

    const STATUS_OPENED = 'opened';
    const STATUS_CLOSED = 'closed';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'amount',
        'status',
    ];

    /**
     * Relationship HasOne wich user model
     *
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Relationship HasMany wich transaction model to walletId
     *
     * @return HasMany
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'wallet_id', 'id');
    }

    /**
     * Relationship HasMany wich transaction model to destinationWalletId
     *
     * @return HasMany
     */
    public function transactionsDestination(): HasMany
    {
        return $this->hasMany(Transaction::class, 'destination_wallet_id', 'id');
    }

    /**
     * Relationship HasMany wich financial deposits model
     *
     * @return HasMany
     */
    public function financialDeposits(): HasMany
    {
        return $this->hasMany(FinancialDeposit::class);
    }
}
