<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InventoryRequest extends FormRequest
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
        if(!empty($this->lists) && $this->editable == false){
            $rules = [
                'type' => 'required|string',
            ];
            foreach($this->lists as $key => $staff) {
                // just check if the email it's not unique
                    $rules = array_merge($rules, ['lists.'.$key.'.name' => 'required|string|unique:inventories,name']);
                    $rules = array_merge($rules, ['lists.'.$key.'.quantity' => 'required|integer']);
            
            }
        }else{
            $rules = [
                'name' => 'required|string|unique:inventories,name,'.$this->id,
                'type' => 'required|string',
            ];
        }

        return $rules;
    }

    public function messages()
    {
        $message =  [
            'name.required' => '* required',
            'quantity.required' => '* required',
        ];

        return $message;
    }
}
