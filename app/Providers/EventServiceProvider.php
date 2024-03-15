<?php

namespace App\Providers;

use App\Events\CreateUserEvent;
use App\Events\DeleteUserEvent;
use App\Events\UpdateUserEvent;
use App\Listeners\CreateUserListener;
use App\Listeners\CreateWalletListener;
use App\Listeners\UpdateUserListener;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
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
        DeleteUserEvent::class => []
    ];
}
