<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Like extends Model
{
    protected $table = 'likeables';

    public function getComments($summonerId, $region, $user_id) { 
        return DB::select("SELECT * FROM likeables WHERE summoner_id = ? AND summoner_region = ? AND user_id", [$summonerId, $region, $user_id]);
    }
}
