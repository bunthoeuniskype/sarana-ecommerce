<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Exchange extends Model
{
	protected $table="exchange_rate";
	protected $fillable = ['dollar', 'riel', 'status', 'date'];

	public function get_column()
{
   return array(
        array('data'=>trans('common.dollar'), 'align' => 'left'), 
        array('data'=>trans('common.riel'), 'align' => 'left'),
        array('data'=>trans('common.date'), 'align' => 'left')  
       );
}

public function get_summary()
{
   return DB::table($this->table)->select(DB::raw('COUNT(*) as total'))->where('status',1)->first();
}

static function getRiel($query)
{
	return Exchange::whereStatus(1)->get();	
}

}
