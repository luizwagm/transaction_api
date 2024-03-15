<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;
    
    const STATUS_COMPLETED = 'completed';
    const STATUS_REVERSED = 'reversed';
    const STATUS_WAITING = 'waiting';
    const STATUS_STARTED = 'started';

    const PAYER = 'payer';
    const PAYEE = 'payee';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'wallet_id',
        'destination_wallet_id',
        'description',
        'value',
        'status',
    ];

    /**
     * Relationship belongsTo with wallet model to walletId
     *
     * @return BelongsTo
     */
    public function wallets(): BelongsTo
    {
        return $this->belongsTo(Wallet::class, 'id', 'wallet_id');
    }

    /**
     * Relationship belongsTo with wallet model to destinationWalletId
     *
     * @return BelongsTo
     */
    public function walletsDestination(): BelongsTo
    {
        return $this->belongsTo(Wallet::class, 'id', 'destination_wallet_id');
    }
}
