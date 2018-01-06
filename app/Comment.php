<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

   protected $table= "comment";

   public function customer()
   {
   return $this->belongsTo('App\Customer','customer_id','id');
	}
	public function post()
   {
   return $this->belongsTo('App\Product','product_id','id');
	}

}
