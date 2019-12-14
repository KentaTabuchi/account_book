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
            ,'balance_code' => 'not_in: 0'
            ,'large_code' => 'not_in: 0'
            ,'middle_code' => 'not_in: 0'
            ,'small_code' => 'not_in: 0'
        ];
    }
}
