<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB, Validator, Redirect, Auth, Crypt;

use App\User;

class UsersController extends Controller
{
    public function doRegistration(Request $request) {
    	$data = $request->all();
    	$otp = generateOTP();
    	$data['otp'] = $otp;
    	$data['consumer_number'] = $request->consumer_1.'-'.$request->consumer_2.'-'.$request->consumer_3;

    	$data['otp_time'] = date('Y-m-d H:i:s');

    	$validator = Validator::make($data, User::$rules);
        if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();
  
    	$message = '';
    	$data['password'] = bcrypt( $request->password );
    	if($user = User::create($data)) {
    		//send OTP via SMS / Mail
            
            $enc_user_id = Crypt::encrypt($user->id);
            $pass = Crypt::encrypt($request->password);
            return view('users.add_otp', compact('enc_user_id', 'pass'));
        }else{
            $message .= 'Unable to register !';
        }
    	return Redirect::route('user.login')->with('message', $message);
    }

  //   private function generateOTP( $digits = 5 ) {
		// return rand(pow(10, $digits-1), pow(10, $digits)-1);
  //   }

    public function otpVerify(Request $request) { 
    	$user_id = Crypt::decrypt($request->enc_user_id);
    	$user = User::findOrFail($user_id);
    	$message = '';

    	if($user->otp === $request->otp) {
    		$user->otp_verified = 1;
    		$user->status = 1;
    		if($user->save()) {
    			$message .= 'Succssfully Registered !'; 

    			//login user
    			$credentials = array(
				    'email' => $user->email,
				    'password' => Crypt::decrypt($request->pkey)
				);
				if (Auth::attempt($credentials)) {
				    return Redirect::route('user.home')->with('message', $message);
				}
    		}
    		
    	}else{
    		$message = 'Unable to verify OTP ! Please try again';
    		return Redirect::route('user.otp')->with('message', $message);
    	}
    }

    public function postLogin( Request $request) {
        $username = $request->username;
        $credentials = [];
        $credentials['password'] = $request->password;
        if (!filter_var($username, FILTER_VALIDATE_EMAIL) === false) {
          $credentials['email'] = $username;
        }else{
            $credentials['consumer_number'] = $username;
        }
        if (Auth::attempt($credentials)) {
            return Redirect::route('user.home');
        }
    }
}
