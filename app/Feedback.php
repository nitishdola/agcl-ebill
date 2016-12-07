<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = array('name', 'email', 'mobile_number', 'consumer_number', 'bill_number', 'remarks');
	protected $table    = 'feedbacks';
    protected $guarded  = ['_token'];

    public static $rules = [
    	'name' 				=>  'required|max:127',
    	'email'				=> 	'email',
    	'mobile_number'  	=>  'required|numeric:max:10',
    	'remarks' 			=>  'required|min:10'
    ];

}
