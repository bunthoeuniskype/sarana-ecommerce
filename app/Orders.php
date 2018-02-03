<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
	protected $table="orders";
    protected $fillable = array('customer_id', 'cart', 'total_qty', 'total_amount', 'payment_id','employee_id');

    public function customer()
    {
    	return $this->belongsTo('App\Customer','customer_id','id');
    }

    public function user()
    {
    	return $this->belongsTo('App\User','employee_id','id');
    }
}
