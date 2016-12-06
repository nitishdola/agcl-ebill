<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consumer extends Model
{
	protected $table    = 'tblconsumermaster';
    protected $guarded  = ['_token'];

    public function consumer_type() 
	{
		return $this->belongsTo('App\ConsumerType', 'CONSTYPEID', 'CONSTYPEID');
	}
}
