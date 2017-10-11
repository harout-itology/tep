<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Validator;
use Hash;

class UserController extends Controller
{
    public function update(){
        
        $user = User::find(Auth::user()->id);
        
        return view('user-form',['user'=>$user]);
        
    }


    public function store(Request $request){

        Validator::make($request->all(), [
            'name'  => 'required|string|max:255',
            'email'  => 'required|string|email|max:255|unique:users,email,'.Auth::user()->id.',id',
        ])->validate();

        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;

        if($request->oldpassword){
            if(Hash::check($request->oldpassword, $user->password)) {
                Validator::make($request->all(), [
                    'password' => 'required|string|min:6|confirmed',
                ])->validate();
            $user->password = $request->password;
            }
            else
                return redirect('user-update')->withErrors(['oldpassword'=>'Invalid password']);
        }

        $user->save();

        return redirect('user-update')->with('message','Successfully updated');

    }


}
