<?php

namespace App;

use DB;

class Comment
{
	public function find($id) { 
        return DB::select('SELECT * FROM comments WHERE id  = ?', [$id]);
    }

    public function getComments($summonerId, $region) { 
        return DB::select('SELECT * FROM comments WHERE summoner_id = ? AND summoner_region = "?"', [$summonerId, $region]);
    }
}
