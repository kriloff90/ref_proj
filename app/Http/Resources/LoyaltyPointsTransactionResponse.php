<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoyaltyPointsTransactionResponse extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'account_id' => $this->account_id,
            'points_rule' => $this->points_rule,
            'points_amount' => $this->points_amount,
            'description' => $this->description,
            'payment_id' => $this->payment_id,
            'payment_amount' => $this->payment_amount,
            'payment_time' => $this->payment_time,
        ];
    }
}
