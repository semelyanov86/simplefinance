<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CategoryCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::user() && Auth::user()->hasPermissionTo('manage categories')) {
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
            'category_name' => 'required|unique:categories|max:190',
            'sys_category_id' => 'required|integer',
            'parent_id' => 'nullable|integer',
            'category_type' => ['required', Rule::in(['-1', '1'])],
            'isHidden' => ['nullable', Rule::in(['0', '1'])],
        ];
    }
}
