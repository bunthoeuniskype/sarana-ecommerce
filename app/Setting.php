<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
	protected $table="setting";
  
  	protected $fillable = ['key' , 'value'];

  	static function getSetting($key)
  	{
  		return Setting::where('key',$key)->first()->value;  		 
  	}

}
