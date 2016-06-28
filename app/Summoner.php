<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Summoner extends Model
{
    protected $table = "summoners";

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
