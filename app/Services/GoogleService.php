<?php


namespace App\Services;

use App\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;

class GoogleService
{
    public function getConfig()
    {
        $googleClient = new \Google_Client();
        $googleClient->setApplicationName(Config::get('google.setApplicationName'));
        $googleClient->setClientId(Config::get('google.setClientId'));
        $googleClient->setClientSecret(Config::get('google.setClientSecret'));
        $googleClient->setRedirectUri(url(Config::get('google.google_redirect_url')));
        $googleClient->setDeveloperKey(Config::get('google.setDeveloperKey'));
        $googleClient->setScopes(Config::get('google.googleSetScopes'));
        return $googleClient;
    }

    public function login($request)
    {
        $gClient = $this->getConfig();
        $google_oauthV2 = new \Google_Service_Oauth2($gClient);
        if ($request->get('code')) {
            $gClient->authenticate($request->get('code'));
            $request->session()->put('token', $gClient->getAccessToken());
        }
        if ($request->session()->get('token')) {
            $gClient->setAccessToken($request->session()->get('token'));
        }
        if ($gClient->getAccessToken()) {
            //For logged in user, get details from google using access token
            $guser = $google_oauthV2->userinfo->get();
            $user = User::submit($guser, $request->get('code'));
            Auth::login($user);
            return true;
        }
        return false;
    }

}
