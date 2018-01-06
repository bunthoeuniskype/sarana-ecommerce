<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
	protected $table="purchase_detail";
   
   protected $fillable = [ 'purchase_id', 'product_id', 'price', 'qty', 'discount', 'amount',];

public function purchase()
{
   return $this->belongsTo('App\Purchase','purchase_id','id');
}
public function product()
{
   return $this->belongsTo('App\Product','product_id','id');
}


}

