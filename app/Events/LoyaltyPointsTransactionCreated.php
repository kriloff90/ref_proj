<?php

namespace App\Events;

use App\Models\LoyaltyPointsTransaction;

use Illuminate\Broadcasting\InteractsWithSockets;

use Illuminate\Foundation\Events\Dispatchable;

use Illuminate\Queue\SerializesModels;

class LoyaltyPointsTransactionCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public LoyaltyPointsTransaction $transaction;

    public function __construct(LoyaltyPointsTransaction $transaction)
    {
        $this->transaction = $transaction;
    }
}
