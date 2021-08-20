<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResearcherRequest extends FormRequest
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
            'firstname' => 'required|string|max:100',
            'lastname' => 'required|string|max:100',
            'middlename' => 'required|string|max:10',
            'email' => 'required|string|max:150|unique:users,email,'.$this->id,
            'birthdate' => 'required',
            'gender' => 'required',
            'mobile' => 'required',
            // 'type' => 'required|string',
            'institution' => 'required|array|min:1',
            'designation' => 'required|array|min:1',
            'specialty' => 'required|array|min:1',
            'avatar' => 'nullable|image64:jpeg,jpg,png',
        ];
    }

    public function messages()
    {
        $message =  [
            'firstname.required' => '* required',
            'lastname.required' => '* required',
            'middlename.required' => '* required',
            'email.required' => '* required',
            'birthdate.required' => '* required',
            'gender.required' => '* required',
            'mobile.required' => '* required',
            // 'type.required' => '* required',
            'institution.required' => '* required',
            'designation.required' => '* required',
            'specialty.required' => '* required',

        ];

        return $message;
    }
}
