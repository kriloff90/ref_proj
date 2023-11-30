<?php

namespace App\Http\Middleware;

use App\Models\LoyaltyAccount;

use Closure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CheckAndSetLoyaltyAccount
{
    public function handle(Request $request, Closure $next)
    {
        $account = LoyaltyAccount::query()
            ->where($request->input('account_type'), $request->input('account_id'))
            ->active()
            ->firstOr(function () {
                Log::info('Account is not active');

                abort(404, 'Account is not active');
            });

        $request->merge(['loyaltyAccount' => $account]);

        return $next($request);
    }
}
