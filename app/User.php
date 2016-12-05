<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'consumer_number', 'mobile_number', 'otp', 'otp_verified', 'otp_time', 'email', 'password', 'status'
    ];

    public static $rules = [
        'consumer_number'   =>  'required|max:12',
        'mobile_number'     =>  'required|unique:users|max:10',
        'otp'               =>  'required|max:5',
        'email'             =>  'required|unique:users|max:50',
        'password'          => 'required|min:6',
        'password_confirmation' => 'required|min:6|same:password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
