<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SupplierRequest extends Request
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
            'company_name' => 'required|max:30|min:3', 
            'name' => 'required|max:30|min:3', 
            'gender' => 'required',
            'email' => 'required|email|unique:supplier,email',
            'phone' => 'required|numeric|min:8',
            'address' => 'required',
            

        ];
    }
}
