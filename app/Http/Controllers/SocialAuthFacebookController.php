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
       // \Artisan::call('cache:clear');
       // exit;
        $user = $service->createOrGetUser(Socialite::driver('facebook')->stateless()->user());
       
        $userdata = Auth::guard('customer')->loginUsingId($user['id']);
       
        return redirect()->to('/customerprofile');
    }

}
