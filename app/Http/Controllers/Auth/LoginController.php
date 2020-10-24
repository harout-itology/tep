<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Services\GoogleService;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

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
    private $redirectTo = '/';
    private $googleService;

    /**
     * Create a new controller instance.
     *
     * @param GoogleService $googleService
     */
    public function __construct(GoogleService $googleService)
    {
        $this->middleware('guest')->except('logout');
        $this->googleService = $googleService;
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        $google = $this->googleService->getConfig()->createAuthUrl();
        $socialite = route('socialite.url');
        return view('auth.login',['google'=>$google, 'socialite'=>$socialite]);
    }

    public function google(Request $request)
    {
        return $this->googleService->login($request) ? redirect('/') : abort(404);
    }

    public function socialiteurl($slug)
    {
        return  Socialite::driver($slug)->stateless()->redirect();
    }

    public function socialite($slug)
    {
        try {
            $guser = Socialite::driver($slug)->stateless()->user();
            $user = User::submit($guser, $guser->id);
            Auth::login($user);
            return redirect('/');
        } catch (Exception $e) {
            return abort(404);
        }
    }

}
