<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class _201_ValidatedRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'payment' => 'required|integer'
            ,'category_balance' => 'required|not_in: 0'
            ,'category_large' => 'required|not_in: 0'
            ,'category_middle' => 'required|not_in: 0'
            ,'category_small' => 'required|not_in: 0'
        ];
    }
}
