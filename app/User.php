<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Image;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
 
    protected $fillable = [
        'name', 'email', 'password','status','role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

   
    public function Purchase()
{
   return $this->hasMany('App\Purchase');
}

    public function sale()
{
   return $this->hasMany('App\Sale');
}

    public function product()
{
   return $this->hasMany('App\Product');
}

    public function employee()
{
   return $this->belongsTo('App\Employee','employee_id','id');
}

    public function expenseincome()
{
   return $this->hasMany('App\ExpenseIncome');
}

  public function authrole()
    {
        return $this->belongsTo('App\AuthRole','is_permission','id');
    }

}
