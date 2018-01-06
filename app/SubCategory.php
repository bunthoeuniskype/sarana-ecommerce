<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{

protected $table = "sub_category";   

public function category()
{
	return $this->belongsTo('App\Category','category_group_id', 'group_id');
}

public function language()
{
	return $this->belongsTo('App\Language','language_code','code');
}


public function product()
{
	return $this->hasMany('App\Product');
}


}
