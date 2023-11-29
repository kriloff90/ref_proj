<?php

namespace App\Observers;

use App\Events\LoyaltyPointsTransactionCreated;

use App\Models\LoyaltyPointsTransaction;

class LoyaltyPointsTransactionObserver
{
    public function created(LoyaltyPointsTransaction $transaction): void
    {
        event(new LoyaltyPointsTransactionCreated($transaction));
    }
}
