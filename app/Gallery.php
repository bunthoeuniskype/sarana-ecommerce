<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery_product';
    protected $fillable = ['product_id', 'image','status', 'user_id'];

    public function product()
    {
    	return $this->belongsTo('App\Product','product_id','id');
    }
}
