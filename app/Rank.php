<?php

namespace App;

use DB;

class Rank
{
	public function ranks(){
		return DB::select("SELECT * FROM rank");
	}

	public function getRank($summonerId, $region){
        return DB::select("SELECT rank FROM rank WHERE summoner_id = ? AND summoner_region = ?", [$summonerId, $region]);
	}
}