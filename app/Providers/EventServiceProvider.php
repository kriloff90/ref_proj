<?php

namespace App\Providers;

use App\Events\LoyaltyPointsTransactionCreated;

use App\Listeners\LoyaltyPointsTransactionCreatedLog;
use App\Listeners\LoyaltyPointsTransactionCreatedSendNotification;

use App\Models\LoyaltyPointsTransaction;

use App\Observers\LoyaltyPointsTransactionObserver;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        LoyaltyPointsTransactionCreated::class => [
            LoyaltyPointsTransactionCreatedLog::class,
            LoyaltyPointsTransactionCreatedSendNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        LoyaltyPointsTransaction::observe(LoyaltyPointsTransactionObserver::class);
    }
}
