<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $table="product";
   
   protected $fillable = array(
             'user_id', 'subcategory_id', 'category_id', 'slug', 'barcode', 'name', 'description', 'cost', 'price', 'qty', 'qty_alert', 'image', 'status', 'rate', 'count_view', 'discount', 'created_at', 'updated_at', 'color', 'unit', 'file', 'tax', 'detail'
   			);

public function user()
{
   return $this->belongsTo('App\User','user_id','id');
}

public function subcategory()
{
   return $this->belongsTo('App\SubCategory','subcategory_id','group_id');
}

public function category()
{
   return $this->belongsTo('App\Category','category_id','group_id');
}

public function purchasedetail()
{
   return $this->hasMany('App\PurchaseDetail');
}
public function saledetail()
{
   return $this->hasMany('App\SaleDetail');
}

public function changeprice()
{
   return $this->hasMany('App\ChangePrice');
}

public function inventory()
{
   return $this->hasMany('App\Inventory');
}


public function create_table_temp()
{
   return DB::insert(DB::raw("CREATE TEMPORARY TABLE product_temp  AS (select * from ".$this->table.")"));
}

public function get_table_temp()
{
  return DB::table("product_temp")->select('*')->where('status',1)->get();
}

public function get_column()
{
   return array(
        array('data'=>'Barcode', 'align' => 'left'), 
        array('data'=>'Name', 'align' => 'left'),
        array('data'=>'Cost', 'align' => 'left'),
        array('data'=>'Price', 'align' => 'left'),
        array('data'=>'Quantity In Stock', 'align' => 'left'),
        array('data'=>'Discount', 'align' => 'left'),
        array('data'=>'Unit', 'align' => 'left'),
        array('data'=>'Color', 'align' => 'left'),
        array('data'=>'Quantity Purchased', 'align' => 'left')
       );
}

public function get_summary()
{
   return DB::table($this->table)->select(DB::raw('COUNT(*) as total'))->where('status',1)->first();
}

public function gallery()
{
   return $this->hasMany('App\Gallery');
}

}

