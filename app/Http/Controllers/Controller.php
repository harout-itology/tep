<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Config;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function googleconfig(){

        $gClient = new \Google_Client();
        $gClient->setApplicationName(Config::get('google.setApplicationName'));
        $gClient->setClientId(Config::get('google.setClientId'));
        $gClient->setClientSecret(Config::get('google.setClientSecret'));
        $gClient->setRedirectUri(url(Config::get('google.google_redirect_url')));
        $gClient->setDeveloperKey(Config::get('google.setDeveloperKey'));
        $gClient->setScopes(Config::get('google.googleSetScopes'));

        return $gClient;
    }
  

}
