<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model {

	protected $table ="inventories";
	protected $fillable =['product_id', 'user_id', 'in_out_qty', 'remarks',];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

      public function product()
    {
        return $this->belongsTo('App\Product');
    }


public function get_column()
    {
       return array(
            array('data'=>trans('common.name'), 'align' => 'left'), 
            array('data'=>trans('common.qty'), 'align' => 'left'),
            array('data'=>trans('common.in_out_qty'), 'align' => 'left')  
           );
    }

public function get_summary()
{
   return array();//DB::table($this->table)->select(DB::raw('COUNT(*) as total'))->where('status',1)->first();
}

}
