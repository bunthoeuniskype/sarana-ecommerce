<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Payowed extends Model
{
	protected $table="payowed";	      
   
   protected $fillable = ['id','customer_id','total_amount', 'payment_term','month_to_pay','created_at', 'updated_at','user_id','status','total_paid'];

public function customer()
{
   return $this->belongsTo('App\Customer','customer_id','id');
}
public function user()
{
   return $this->belongsTo('App\User','user_id','id');
}

public function payoweddetail()
{
   return $this->hasMany('App\PayowedDetail');
}


public function get_column()
{
   return array(
        array('data'=>trans('common.date'), 'align' => 'left'), 
        array('data'=>trans('common.fullname'), 'align' => 'left'),
        array('data'=>trans('common.gender'), 'align' => 'left'),
        array('data'=>trans('common.email'), 'align' => 'left'),
        array('data'=>trans('common.phone'), 'align' => 'left'),
        array('data'=>trans('common.payowed'), 'align' => 'left'),        
        array('data'=>trans('common.paid'), 'align' => 'left'),     
        array('data'=>trans('common.balance'), 'align' => 'left')    
       );
}

public function get_summary()
{
   return DB::table($this->table)->select(DB::raw('sum(total_amount) as total,sum(total_paid) as paid, sum(total_amount-total_paid) as balance'))->first();
}



}

