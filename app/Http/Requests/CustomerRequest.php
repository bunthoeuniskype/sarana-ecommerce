<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CustomerRequest extends Request
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
            'name' => 'required|max:30|min:3', 
            'username' => 'required|max:30|min:7', 
            'gender' => 'required',
            'email' => 'required|email|unique:customer,email',
            'password' => 'required|max:30|min:8', 
            'phone' => 'required|numeric|min:8',
            'address' => 'required',
        ];
    }
}
