<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Services\SocialFacebookAccountService;
use Auth;

class SocialAuthFacebookController extends Controller
{
   

    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }
    /**
     * Return a callback method from facebook api.
     *
     * @return callback URL from facebook
     */
    public function callback(SocialFacebookAccountService $service)
    {
        $user = $service->createOrGetUser(Socialite::driver('facebook')->user());
        Auth::guard('customer')->attempt(['email'=>$user['email'],'password_socail'=> $user['password']]);
        return redirect()->to('/customerprofile');
    }

}
