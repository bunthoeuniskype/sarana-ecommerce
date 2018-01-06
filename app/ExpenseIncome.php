<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class ExpenseIncome extends Model
{

   protected $table="expense_income";   
   protected $fillable = ['user_id', 'total_expense', 'total_income', 'date','status'];

public function get_column()
	{
	   return array(
	        array('data'=>trans('common.total_income'), 'align' => 'left'), 
	        array('data'=>trans('common.total_expense'), 'align' => 'left'),
	        array('data'=>trans('common.profit'), 'align' => 'left'),
	        array('data'=>trans('common.date'), 'align' => 'left')  
	       );
	}

public function get_summary()
	{
	   return DB::table($this->table)->select(DB::raw('sum(total_income) as total_income,sum(total_expense) as total_expense,sum(total_income-total_expense) as profit'))->where('status',1)->first();
	}


}

