<?php

namespace App\Http\Requests;

use App\Rules\CheckPassword;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required|max:190',
            'email' => 'required|email:rfc|unique:users,email,'.request()->id,
            'password' => 'nullable|min:6|max:50|confirmed',
            'operations' => 'nullable|integer|max:1000',
            'day_start' => 'nullable|integer|max:31',
            'receive_notify' => ['nullable', Rule::in(['0', '1'])],
            'login' => 'required|min:3|max:50',
        ];
    }
}
