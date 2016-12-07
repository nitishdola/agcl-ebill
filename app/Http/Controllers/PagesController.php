<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB, Validator, Redirect, Auth, Crypt;
use App\Feedback;

class PagesController extends Controller
{
    public function privacy() {
    	return view('pages.privacy');
    }

    public function feedback() {
    	return view('pages.feedback');
    }

    public function postFeedback(Request $request) {
    	$validator = Validator::make($data = $request->all(), Feedback::$rules);
        if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();

    	$message = '';
    	if(Feedback::create($data)) {
            $message .= 'Feedback submit successfully !';
        }else{
            $message .= 'Unable to submit Feedback!';
        }

        return Redirect::route('feedback')->with('message', $message);
    }
}
