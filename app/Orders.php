<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
	protected $table="orders";
    protected $fillable = array('customer_id', 'cart', 'total_qty', 'total_amount', 'payment_id');

}
