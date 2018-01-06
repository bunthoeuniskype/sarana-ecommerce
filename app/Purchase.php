<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Purchase extends Model
{
	protected $table="purchase";
   
   protected $fillable = ['user_id', 'supplier_id', 'shipper_id', 'Sub_Total', 'discount_amount', 'Total', 'Amount_Paid', 'Amount_Due', 'Description','date',];

public function user()
{
   return $this->belongsTo('App\User','user_id','id');
}
public function supplier()
{
   return $this->belongsTo('App\Supplier','supplier_id','id');
}
public function shipper()
{
   return $this->belongsTo('App\Shipper','shipper_id','id');
}

public function purchasedetail()
{
	 return $this->hasMany('App\PurchaseDetail','purchase_id');
}


public function get_column()
{
 

   return array(
   					'summary' => array(
   									array('data'=>'+', 'align' => 'left'),
									array('data'=>'#', 'align' => 'left'),
							        array('data'=>trans('common.recieve_by'), 'align' => 'left'), 
							        array('data'=>trans('common.supplier'), 'align' => 'left'),
							        array('data'=>trans('common.shipper'), 'align' => 'left'),
							        array('data'=>trans('common.qty'), 'align' => 'left'),
							        array('data'=>trans('common.sub_total'), 'align' => 'left'),
							        array('data'=>trans('common.discount_amount'), 'align' => 'left'),
							        array('data'=>trans('common.total'), 'align' => 'left'),
							        array('data'=>trans('common.amount_paid'), 'align' => 'left'), 
							        array('data'=>trans('common.amount_due'), 'align' => 'left'),
							        array('data'=>trans('common.date'), 'align' => 'left'),     
							        array('data'=>trans('common.mode'), 'align' => 'left')  
								),
					 'detail' => array(
								array('data'=>trans('common.barcode'), 'align' => 'left'),
								array('data'=>trans('common.name'), 'align' => 'left'),  								
								array('data'=>trans('common.qty'), 'align' => 'left'), 
								array('data'=>trans('common.cost'), 'align' => 'left'), 
								array('data'=>trans('common.discount'), 'align' => 'left'),							 
								array('data'=>trans('common.amount'), 'align' => 'left')
								)
					);

}

public function get_summary()
{
   return DB::table($this->table)->select(DB::raw('sum(total) as total,sum(amount_paid) as paid, sum(amount_due) as amount_due'))->first();
}


}

