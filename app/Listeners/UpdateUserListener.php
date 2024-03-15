<?php

namespace App\Listeners;

use App\Events\UpdateUserEvent;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateUserListener
{
    /**
     * Create the event listener.
     */
    public function __construct(
        protected UserRepositoryInterface $repository
    ) {}

    /**
     * Handle the event.
     */
    public function handle(UpdateUserEvent $event): void
    {
        $this->repository->update($event->id, $event->user);
    }
}
