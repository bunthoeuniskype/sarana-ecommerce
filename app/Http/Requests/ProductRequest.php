<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProductRequest extends Request
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
            'subcategory_id'=>'required',
            'measure_id'=>'required',
            'currency_id'=>'required',
            'barcode'=>'required|unique:product,barcode',
            'sku'=>'required',
            'name'=>'required|unique:product,name',
            'description'=>'required',
            'cost'=>'required',
            'price'=>'required',
            'qty'=>'required',
            'qty_alert'=>'required',
           
        ];
    }
}
