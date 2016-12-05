<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consumer extends Model
{
	protected $table    = 'tblconsumermaster';
    protected $guarded  = ['_token'];
}
