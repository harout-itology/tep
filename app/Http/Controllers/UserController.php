<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function edit()
    {
        $user = User::find(Auth::user()->id);
        return view('user-form',['user'=>$user]);
    }

    public function store(UserRequest $request)
    {
        $user = User::updateProfile($request);
        if($user['type'] == 'error')
            return redirect(route('user.edit'))->withErrors($user['message']);
        else
            return redirect(route('user.edit'))->with('message',$user['message']);
    }

}
