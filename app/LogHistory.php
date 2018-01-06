<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogHistory extends Model
{
    protected $table='log_history';

    public function role(){
    	 return $this->belongsTo('App\AuthRole','title','id');
    }
}
