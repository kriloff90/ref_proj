<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoyaltyPointsDepositRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        $field = $this->input('account_type', null);

        return [
            'account_type' => ['required', 'string', 'in:phone,card,email'],
            'account_id' => ['required', 'string', "exists:loyalty_account,{$field}"],
            'loyalty_points_rule' => ['nullable', 'string'],
            'description' => ['required', 'string'],
            'payment_id' => ['required', 'string'],
            'payment_amount' => ['required', 'numeric'],
            'payment_time' => ['required', 'integer'],
        ];
    }
}
