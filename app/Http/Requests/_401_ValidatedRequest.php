<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class _401_ValidatedRequest extends FormRequest
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
             'budget_1' => 'integer'
            ,'budget_2' => 'integer'
            ,'budget_3' => 'integer'
            ,'budget_4' => 'integer'
            ,'budget_5' => 'integer'
            ,'budget_6' => 'integer'
            ,'budget_7' => 'integer'
            ,'budget_8' => 'integer'
            ,'budget_9' => 'integer'
            ,'budget_10' => 'integer'
            ,'budget_11' => 'integer'
            ,'budget_12' => 'integer'
        ];
    }
}
