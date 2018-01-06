<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
	protected $table="sale_detail";
   
   protected $fillable = [ 'sale_id', 'product_id', 'price', 'qty', 'discount', 'amount',];

public function sale()
{
   return $this->belongsTo('App\Sale','sale_id','id');
}

public function product()
{
   return $this->belongsTo('App\Product','product_id','id');
}


}

