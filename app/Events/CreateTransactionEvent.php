<?php

namespace App\Events;

use App\Http\Requests\Transaction\TransactionRequest;
use App\Models\Notification;
use Illuminate\Foundation\Events\Dispatchable;

class CreateTransactionEvent
{
    use Dispatchable;

    /**
     * $id variable
     *
     * @var integer
     */
    public int $id;

    /**
     * $sms variable
     *
     * @var Notification
     */
    public Notification $sms;

    /**
     * $email variable
     *
     * @var Notification
     */
    public Notification $email;

    /**
     * Constructs function
     *
     * @param TransactionRequest $request
     */
    public function __construct(
        public TransactionRequest $request
    ) {}

    /**
     * set transactionId to id function
     *
     * @param integer $transactionId
     * @return void
     */
    public function setTransactionId(int $transactionId)
    {
        $this->id = $transactionId;
    }

    /**
     * Set sms notification function
     *
     * @param Notification $notification
     * @return void
     */
    public function setSms(Notification $notification)
    {
        $this->sms = $notification;
    }

    /**
     * Set email notification function
     *
     * @param Notification $notification
     * @return void
     */
    public function setEmail(Notification $notification)
    {
        $this->email = $notification;
    }
}
