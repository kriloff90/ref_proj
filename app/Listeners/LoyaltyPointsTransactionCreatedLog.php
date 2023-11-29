<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;

class LoyaltyPointsTransactionCreatedLog
{
    public function handle($event)
    {
        Log::info('Transaction withdrawal', $event->transaction->toArray());
    }
}
