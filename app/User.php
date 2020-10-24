<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function submit($request, $code)
    {
        return Self::updateOrcreate(
            ['email' => $request['email']],
            [
                'email' => $request['email'],
                'name' => $request['name'],
                'password' => Hash::make($code)
            ]
        );
    }

    public static function updateProfile($request)
    {
        $user = Self::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->oldpassword && $request->password && $request->password_confirmation){
            if(Hash::check($request->oldpassword, $user->password)) {
                Validator::make($request->all(), [
                    'password' => 'required|string|min:8|confirmed',
                ])->validate();
                $user->password = Hash::make($request->password);
            }
            else
                return ['type'=>'error', 'message'=>['oldpassword'=>'Invalid password']];
        }
        $user->save();
        return ['type'=>'success', 'message'=>'Successfully updated'];
    }

}
