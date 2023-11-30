<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoyaltyPointsCancelRequest;
use App\Http\Requests\LoyaltyPointsDepositRequest;

use App\Http\Requests\LoyaltyPointsWithdrawRequest;
use App\Http\Resources\LoyaltyPointsTransactionResponse;

use App\Models\LoyaltyPointsTransaction;

use Illuminate\Support\Facades\Log;

class LoyaltyPointsController extends Controller
{
    public function deposit(LoyaltyPointsDepositRequest $request)
    {
        Log::info('Deposit transaction input: ' . print_r($request->all(), true));

        $transaction = LoyaltyPointsTransaction::performPaymentLoyaltyPoints(
            $request->input('loyaltyAccount')->id,
            $request->input('loyalty_points_rule'),
            $request->input('description'),
            $request->input('payment_id'),
            $request->input('payment_amount'),
            $request->input('payment_time')
        );

        return response(LoyaltyPointsTransactionResponse::make($transaction));
    }

    public function cancel(LoyaltyPointsCancelRequest $request, LoyaltyPointsTransaction $transaction)
    {
        $transaction->update([
            'canceled' => time(),
            'cancellation_reason' => $request->input('cancellation_reason')
        ]);

        return response()->json(['status' => 'success']);
    }

    public function withdraw(LoyaltyPointsWithdrawRequest $request)
    {
        Log::info('Withdraw loyalty points transaction input: ' . print_r($request->all(), true));

        return response(LoyaltyPointsTransactionResponse::make(LoyaltyPointsTransaction::withdrawLoyaltyPoints(
            $request->input('loyaltyAccount')->id,
            $request->input('points_amount'),
            $request->input('description')
        )));
    }
}
