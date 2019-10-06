<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateNotifyRequest extends FormRequest
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
            'timezone' => 'required|timezone',
            'phone' => 'nullable|max:20',
            'emailFrequency' => 'nullable|integer',
            'emailHours' => 'nullable|integer',
            'emailMinutes' => 'nullable|integer',
            'smsFrequency' => 'nullable|integer',
            'smsHours' => 'nullable|integer',
            'smsMinutes' => 'nullable|integer'
        ];
    }
}
