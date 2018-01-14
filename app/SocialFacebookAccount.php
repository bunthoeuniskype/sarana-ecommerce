<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialFacebookAccount extends Model
{
  protected $table = 'social_facebook_accounts';
  protected $fillable = ['user_id', 'provider_user_id', 'provider'];

  public function user()
  {
      return $this->belongsTo('App\CustomerAuth','user_id','id');
  }

}
