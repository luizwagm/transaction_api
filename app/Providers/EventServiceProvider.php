<?php

namespace App\Providers;

use App\Events\CreateTransactionEvent;
use App\Events\CreateUserEvent;
use App\Events\DepositEvent;
use App\Events\UpdateUserEvent;
use App\Listeners\AlterStatusDepositListener;
use App\Listeners\AlterStatusTransactionListener;
use App\Listeners\CheckSendNotificationListener;
use App\Listeners\CheckTransactionAvailabilityListener;
use App\Listeners\CreateNotificationsListener;
use App\Listeners\CreateTransactionListener;
use App\Listeners\CreateUserListener;
use App\Listeners\CreateWalletListener;
use App\Listeners\DepositListener;
use App\Listeners\SendNotificationListener;
use App\Listeners\UpdateUserListener;
use App\Listeners\ValueEntryToWalletAfterTransactionListener;
use App\Listeners\ValueEntryToWalletListener;
use App\Listeners\ValueOutputToWalletListener;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        CreateUserEvent::class => [
            CreateUserListener::class,
            CreateWalletListener::class,
        ],
        UpdateUserEvent::class => [
            UpdateUserListener::class,
        ],
        DepositEvent::class => [
            DepositListener::class,
            ValueEntryToWalletListener::class,
            AlterStatusDepositListener::class,
        ],
        CreateTransactionEvent::class => [
            CreateTransactionListener::class,
            ValueOutputToWalletListener::class,
            CheckTransactionAvailabilityListener::class,
            ValueEntryToWalletAfterTransactionListener::class,
            AlterStatusTransactionListener::class,
            CreateNotificationsListener::class,
            CheckSendNotificationListener::class,
            SendNotificationListener::class,
        ],
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }    
}
