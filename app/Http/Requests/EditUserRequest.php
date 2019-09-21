<?php

namespace App\Http\Requests;

use App\Rules\CheckPassword;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class EditUserRequest extends FormRequest
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
            'email' => 'required|email:rfc|unique:users,email,'.request()->user()->id,
            'password' => 'nullable|min:6|max:50|confirmed',
            'operations' => 'required|integer|max:1000',
            'day_start' => 'required|integer|max:31',
            'receive_notify' => ['required', Rule::in(['0', '1'])],
            'login' => 'required|min:3|max:50|unique:users,login,' . request()->user()->id,
            'oldPassword' => ['nullable', 'min:3', 'max:50', new CheckPassword]
        ];
    }
}
