<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CheckLoyaltyAccountBalance
{
    public function handle(Request $request, Closure $next)
    {
        $pointsAmount = (float) $request->input('points_amount');
        if ($request->input('loyaltyAccount')->getBalance() < $pointsAmount) {
            Log::info("Insufficient funds: {$pointsAmount}");

            abort(400, 'Insufficient funds');
        }

        return $next($request);
    }
}
