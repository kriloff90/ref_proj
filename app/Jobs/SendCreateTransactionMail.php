<?php

namespace App\Jobs;

use App\Mail\LoyaltyPointsReceived;
use App\Models\LoyaltyAccount;
use App\Models\LoyaltyPointsTransaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendCreateTransactionMail implements ShouldQueue
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
        if ($this->account->email && $this->account->email_notification) {
            Mail::to($this->account)->send(
                new LoyaltyPointsReceived(
                    $this->transaction->points_amount,
                    $this->account->getBalance()
                )
            );
        }
    }
}
