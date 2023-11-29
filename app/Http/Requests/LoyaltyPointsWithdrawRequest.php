<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoyaltyPointsWithdrawRequest extends FormRequest
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
            'points_amount' => ['required', 'numeric', 'min:0'],
            'description' => ['required', 'string'],
        ];
    }
}
