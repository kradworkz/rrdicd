<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationRequest extends FormRequest
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
            'name' => 'required|string|max:200|unique:organizations,name,'.$this->id,
            'acronym' => 'required|string|max:20',
            'email' => 'required|string|max:150|unique:users,email,'.$this->id,
            'contact' => 'required',
            'avatar' => 'nullable|image64:jpeg,jpg,png',
        ];
    }

    public function messages()
    {
        $message =  [
            'name.required' => '* required',
            'acronym.required' => '* required',
            'email.required' => '* required',
            'contact.required' => '* required',
        ];

        return $message;
    }
}
