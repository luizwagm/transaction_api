<?php

namespace App\Listeners;

use App\Events\CreateUserEvent;
use App\Repositories\User\UserRepositoryInterface;

class ProvisionListener
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(CreateUserEvent $event): void
    {}
}
