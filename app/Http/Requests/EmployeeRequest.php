<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EmployeeRequest extends Request
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
            'firstname' => 'required|max:30|min:3', 
            'lastname' => 'required|max:30|min:3', 
            'gender' => 'required',
            'email' => 'required|email|unique:employee,email',
            'phone' => 'required|max:30|min:8', 
            'address' => 'required|max:255|min:8',
        ];
    }
}
