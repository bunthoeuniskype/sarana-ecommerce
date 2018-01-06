<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model {

   protected $table = "advertisement";
   protected $fillable = ['title','description','location','ads_type','ads_script','image','video_id','order','status','created_by','updated_by'];
 
}
