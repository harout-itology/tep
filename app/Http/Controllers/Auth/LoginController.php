<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Auth;
use LinkedIn;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        $authUrl = parent::googleconfig();
        $google = $authUrl->createAuthUrl();

        $linkedin = LinkedIn::getLoginUrl();

        return view('auth.login',['google'=>$google,'linkedin'=>$linkedin]);
    }

    public function google(Request $request)
    {

        $gClient = parent::googleconfig();

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

            $user = User::where('email',$guser['email'])->first();

            if(!isset($user->email)){
                $user = new User();
                $user->email = $guser['email'];
                $user->name = $guser['name'];
                $password = str_random(8);
                $user->password =  $password;
                $user->save();
            }
			Auth::login($user);
            return redirect('/');
        }
    }

    public function linkedin(){

        if (LinkedIn::isAuthenticated()) {
            //we know that the user is authenticated now. Start query the API
            $guser=LinkedIn::get('v1/people/~:(firstName,lastName,emailAddress)');
            
            $user = User::where('email',$guser['emailAddress'])->first();
            if(!isset($user->email)){
                $user = new User();
                $user->email = $guser['emailAddress'];
                $user->name = $guser['name'].' '.$guser['name'];
                $password = str_random(8);
                $user->password =  $password;
                $user->save();
            }
            Auth::login($user);
            return redirect('/');
        }elseif (LinkedIn::hasError()) {
            return redirect('/login');
        }

    }


}
