<?php

namespace App\Services;

use App\Models\LoyaltyAccount;

use Illuminate\Support\Facades\Log;

class LoyaltyAccountService
{
    public static function getActiveAccountOrFail(string $type, string $id) : LoyaltyAccount
    {
        /** @var LoyaltyAccount $account */
        return LoyaltyAccount::query()
            ->where($type, $id)
            ->active()
            ->firstOr(function () {
                Log::info('Account is not active');

                abort(404, 'Account is not active');
            });
    }

    public static function checkBalance(LoyaltyAccount $account, float $checkValue)
    {
        if ($account->getBalance() < $checkValue) {
            Log::info("Insufficient funds: {$checkValue}");

            abort(400, 'Insufficient funds');
        }
    }
}
