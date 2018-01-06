<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Sale extends Model
{
	protected $table="sale";	      
   
   protected $fillable = [ 'user_id', 'customer_id', 'Sub_Total', 'tax', 'Total','date',];

public function customer()
{
   return $this->belongsTo('App\Customer','customer_id','id');
}
public function user()
{
   return $this->belongsTo('App\User','user_id','id');
}
public function saledetail()
{
   return $this->hasMany('App\SaleDetail','sale_id');
}



public function get_column()
{
 

   return array(
   							'summary' => array(
   									array('data'=>'+', 'align' => 'left'),
									array('data'=>'#', 'align' => 'left'),
							        array('data'=>trans('common.sale_by'), 'align' => 'left'), 
							        array('data'=>trans('common.buy_by'), 'align' => 'left'),
							        array('data'=>trans('common.qty'), 'align' => 'left'),
							        array('data'=>trans('common.total'), 'align' => 'left'),
							        array('data'=>trans('common.amount_paid'), 'align' => 'left'),
							        array('data'=>trans('common.amount_due'), 'align' => 'left'),
							        array('data'=>trans('common.exchange_due'), 'align' => 'left'),        
							        array('data'=>trans('common.date'), 'align' => 'left'),     
							        array('data'=>trans('common.mode'), 'align' => 'left')  
								),
							'detail' => array(
								array('data'=>trans('common.barcode'), 'align' => 'left'),
								array('data'=>trans('common.name'), 'align' => 'left'),  								
								array('data'=>trans('common.qty'), 'align' => 'left'), 
								array('data'=>trans('common.price'), 'align' => 'left'), 
								array('data'=>trans('common.discount'), 'align' => 'left'),
								array('data'=>trans('common.tax'), 'align' => 'left'),  
								array('data'=>trans('common.amount'), 'align' => 'left')
								)
					);

}

public function get_summary()
{
   return DB::table($this->table)->select(DB::raw('sum(total) as total,sum(amount_paid) as paid, sum(amount_due) as amount_due, sum(change_due) as change_due'))->first();
}

}

