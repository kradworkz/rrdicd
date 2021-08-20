<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'name' => 'required|string|max:150|unique:events,name,'.$this->id,
            'schedule' => 'required',
            'time' => 'required',
            'type' => 'required',
        ];
    }

    public function messages()
    {
        $message =  [
            'name.required' => '* required',
            'schedule.required' => '* required',
            'time.required' => '* required',
            'type.required' => '* required',
        ];

        return $message;
    }
}
