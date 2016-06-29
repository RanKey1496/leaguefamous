<?php

namespace App;

use DB;

class Like
{
	public function find($id) { 
        return DB::select('SELECT * FROM likes WHERE id  = ?', [$id]);
    }

    public function getLike($summonerId, $region, $user_id) { 
        return DB::select("SELECT * FROM likes WHERE summoner_id = ? AND summoner_region = ? AND user_id=? AND deleted_at IS NULL", [$summonerId, $region, $user_id]);
    }

    public function getLiked($summonerId, $region, $user_id) { 
        return DB::select("SELECT * FROM likes WHERE summoner_id = ? AND summoner_region = ? AND user_id=? AND deleted_at IS NOT NULL", [$summonerId, $region, $user_id]);
    }

    public function liked($summonerId, $region, $user_id) { 
        return DB::update("UPDATE likes SET deleted_at=NOW() WHERE summoner_id = ? AND summoner_region = ? AND user_id=?", [$summonerId, $region, $user_id]);
    }

    public function save($summonerId, $region, $user_id) {
    	return DB::insert("INSERT INTO likes (summoner_id, summoner_region, user_id) VALUES (?,?,?)", [$summonerId, $region, $user_id]);
    }

    public function updateSave($summonerId, $region, $user_id) {
        return DB::insert("UPDATE likes SET deleted_at = NULL WHERE summoner_id = ? AND summoner_region = ? AND user_id=?", [$summonerId, $region, $user_id]);
    }
}
