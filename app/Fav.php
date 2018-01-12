<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fav extends Model {

   protected $table = "favorite";
   protected $fillable = ['user_id','product_id'];

   public function product()
   {
   	return $this->belongsTo('App\Product','product_id');
   }
 
}
