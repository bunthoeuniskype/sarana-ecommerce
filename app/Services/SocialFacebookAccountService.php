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
         
        $account = SocialFacebookAccount::whereProvider('facebook')
            ->whereProviderUserId($providerUser->getId())
            ->first();
            
        if ($account) {
            $userLogin['password'] = $providerUser->getId();
            $userLogin['email'] = $providerUser->getEmail();
            return $userLogin;
            //return $account->user;
        } else {
            $account = new SocialFacebookAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'facebook'
            ]);
            $user = CustomerAuth::whereEmail($providerUser->getEmail())->first();
            if (!$user) {
                $user = CustomerAuth::create([
                    'email' => $providerUser->getEmail(),
                    'username' => $providerUser->getName(),
                    'password' => bcrypt($providerUser->getId())
                ]);
            }
            $account->user()->associate($user);
            $account->save();
            
            $userLogin['password'] = $providerUser->getId();
            $userLogin['email'] = $providerUser->getEmail();
            
            return $userLogin;
        }
    }
}