<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AccountStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::user()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'acc_state' => 'required|integer|min:0|max:2',
            'account_type_id' => 'required|integer|min:0|max:100',
            'currency_code' => 'required|alpha|min:2|max:5',
            'description' => 'nullable|min:5|max:500',
            'name' => 'required|min:3|max:100',
            'start_balance' => 'required|integer|min:0',
            'ExtraDebitCard.atm_commission' => 'nullable|numeric|max:100',
            'ExtraDebitCard.rate_balance' => 'nullable|numeric|min:0',
            'ExtraDebitCard.other_atm_commission' => 'nullable|numeric|max:100',
            'ExtraDebitCard.card_type_id' => 'nullable|array',
            'ExtraDebitCard.year_cost' => 'nullable|numeric|min:0',
            'ExtraDebitCard.expire_date_month' => 'nullable|integer|min:1|max:12',
            'ExtraDebitCard.expire_date_year' => 'nullable|integer|min:2020|max:' . (date('Y')+50),
        ];
    }
}
