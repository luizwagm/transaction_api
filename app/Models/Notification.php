<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasFactory;

    const NOTIFICATION_TYPE_EMAIL = 'email';
    const NOTIFICATION_TYPE_SMS = 'sms';

    const STATUS_SENT = 'sent';
    const STATUS_NOT_SENT = 'not_sent';
    const STATUS_SENDING = 'sending';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'notification_type',
        'title',
        'message',
        'status',
    ];

    /**
     * Relationship belongsTo wich user model
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
