<?php

namespace App\Listeners;

use App\Models\LoyaltyAccount;
use Illuminate\Bus\Queueable;

use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Jobs\SendCreateTransactionMail;
use App\Jobs\SendCreateTransactionSms;

class LoyaltyPointsTransactionCreatedSendNotification implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public function handle($event)
    {
        $account = LoyaltyAccount::query()->find($event->transaction->account_id);

        SendCreateTransactionMail::dispatch($account, $event->transaction);
        SendCreateTransactionSms::dispatch($account, $event->transaction);
    }
}
