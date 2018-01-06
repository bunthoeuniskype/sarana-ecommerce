<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayowedDetail extends Model
{
	protected $table="payowed_detail";
   
   protected $fillable = [ 'sale_id', 'product_id', 'price', 'qty', 'discount', 'amount',];

public function payowed()
{
   return $this->belongsTo('App\Payowed','payowed_id','id');
}

public function user()
{
   return $this->belongsTo('App\User','user_id','id');
}


}

