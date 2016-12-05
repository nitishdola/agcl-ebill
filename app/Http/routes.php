<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [
    'as' => 'user.login',
    'middleware' => ['web'],
    'uses' => 'Auth\AuthController@login'
]);

// Route::group(['middleware' => ['web']], function(){
// 	Route::auth();
// 	Route::get('/home', 'HomeController@index');
// });

Route::group(['middleware' => ['web']], function () {
    //Login Routes...
    Route::get('/admin/login','AdminAuth\AuthController@showLoginForm');
    Route::post('/admin/login','AdminAuth\AuthController@login');
    Route::get('/admin/logout','AdminAuth\AuthController@logout');

    // Registration Routes...
    Route::get('admin/register', 'AdminAuth\AuthController@showRegistrationForm');
    Route::post('admin/register', 'AdminAuth\AuthController@register');

    Route::post('admin/password/email','AdminAuth\PasswordController@sendResetLinkEmail');
    Route::post('admin/password/reset','AdminAuth\PasswordController@reset');
    Route::get('admin/password/reset/{token?}','AdminAuth\PasswordController@showResetForm');

    Route::get('/admin', 'AdminController@index');

});  

Route::group(['prefix'=>'user'], function() {
    Route::post('/registration', [
        'as' => 'user.registration',
        'middleware' => ['web'],
        'uses' => 'UsersController@doRegistration'
    ]);

    Route::get('/otp', [
        'as' => 'user.otp',
        'middleware' => ['web'],
        'uses' => 'UsersController@otpForm'
    ]);

    Route::post('/otp-verify', [
        'as' => 'user.otp.verify',
        'middleware' => ['web'],
        'uses' => 'UsersController@otpVerify'
    ]);

    Route::get('/home', [
        'as' => 'user.home',
        'middleware' => ['auth'],
        'uses' => 'HomeController@index'
    ]);
});

Route::group(['prefix'=>'rest'], function() {
    Route::get('/resend-otp', [
        'as' => 'rest.resend.otp',
        'middleware' => ['web'],
        'uses' => 'RestController@resendOTP'
    ]);
});