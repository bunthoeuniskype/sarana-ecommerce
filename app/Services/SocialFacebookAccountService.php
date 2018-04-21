<?php
namespace App\Services;
use App\SocialFacebookAccount;
use App\CustomerAuth;
use Laravel\Socialite\Contracts\User as ProviderUser;
class SocialFacebookAccountService
{
    public function createOrGetUser(ProviderUser $providerUser)
    {
        

         $userLogin = array();
         
        // $account = SocialFacebookAccount::whereProvider('facebook')
        //     ->whereProviderUserId($providerUser->getId())
        //     ->first();
            $idFb = $providerUser->getId();
            $user = CustomerAuth::where('facebook_id',$idFb)->first();
            if (!$user) {
                
                $user = new CustomerAuth;
                $user->email = $providerUser->getEmail();
              //  $user->image_socail = $providerUser->getAvatar();
                $user->username = $providerUser->getName();
                $user->facebook_id = $idFb;
               //$user->password_socail = bcrypt($idFb);
               $user->save();
            }
          
        // if ($account) {
        //     $userLogin['password'] = $providerUser->getId();
        //     $userLogin['email'] = $providerUser->getEmail();
        //     return $userLogin;
        //     //return $account->user;
        // } else {
        //     $account = new SocialFacebookAccount([
        //         'provider_user_id' => $providerUser->getId(),
        //         'provider' => 'facebook'
        //     ]);
        //     $user = CustomerAuth::whereEmail($providerUser->getEmail())->first();
        //     if (!$user) {
        //         $user = CustomerAuth::create([
        //             'email' => $providerUser->getEmail(),
        //             'image_socail' => $providerUser->getAvatar(),
        //             'username' => $providerUser->getName(),
        //             'password_socail' => bcrypt($providerUser->getId())
        //         ]);
        //     }
        //     $account->user()->associate($user);
        //     $account->save();
            
        //     $userLogin['password'] = $providerUser->getId();
        //     $userLogin['email'] = $providerUser->getEmail();
            $userLogin['id']=$user->id;
            return $userLogin;
        
    }
}