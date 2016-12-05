<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB, Validator, Redirect, Auth, Crypt;

use App\User;

class RestController extends Controller
{
    public function resendOTP() {
    	if(isset($_GET['enc_user_id']) && $_GET['enc_user_id'] != '') {
    		$enc_user_id = $_GET['enc_user_id'];
    		$user_id = Crypt::decrypt( $enc_user_id );
    		$user = User::findOrFail( $user_id );
    	}
    }
}
