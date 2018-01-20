<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model {

   protected $table = "feed_back";
   protected $fillable = ['name','phone','email','message'];

}
