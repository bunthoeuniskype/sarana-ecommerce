<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table="category";


    public function subcategory()
    {
        return $this->hasMany('App\SubCategory','category_group_id','group_id');
    }

    public function language()
    {
    	return $this->belongsTo('App\Language','language_code','code');
    }
}
