<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResearchRequest extends FormRequest
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
        ($this->title == 'undefined') ? $this->title = '' : '';
        return [
            'title' => 'required|string|max:100',
            'classification' => 'required',
            'iprstatus' => 'required',
            'period' => 'nullable|integer',
            'researcher' => 'sometimes|required',
            'amount' => 'sometimes|required',
            'date' => 'sometimes|required',
            'institution' => 'sometimes|required|integer',
            'status' => 'sometimes|required|integer',
        ];
    }

    public function messages()
    {
        $message =  [
            'title.required' => '* required',
            'classification.required' => '* required',
            'iprstatus.required' => '* required',
            'researcher.required' => '* required',
            'amount.required' => '* required',
            'date.required' => '* required',
            'institution.required' => '* required',
            'status.required' => '* required',
            'institution.integer' => '* required',
            'status.integer' => '* required',

        ];

        return $message;
    }
}