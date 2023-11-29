<?php

namespace App\Jobs;

use App\Models\LoyaltyAccount;
use App\Models\LoyaltyPointsTransaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendCreateTransactionSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public LoyaltyAccount $account;
    public LoyaltyPointsTransaction $transaction;

    public function __construct(LoyaltyAccount $account, LoyaltyPointsTransaction $transaction)
    {
        $this->account = $account;
        $this->transaction = $transaction;
    }

    public function handle()
    {
        if ($this->account->phone && $this->account->phone_notification) {
            // instead SMS component
            Log::info('You received' . $this->transaction->points_amount . 'Your balance' . $this->account->getBalance());
        }
    }
}
