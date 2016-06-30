<?php

namespace App;

use DB;

class Comment
{
	public function find($id) { 
        return DB::select('SELECT * FROM comments WHERE id  = ?', [$id]);
    }

    public function getComments($summonerId, $region) { 
        return DB::select("SELECT * FROM comments WHERE summoner_id = ? AND summoner_region = ? AND deleted_at IS NULL ORDER BY created_at DESC", [$summonerId, $region]);
    }

    public function getComment($user_id, $id) { 
        return DB::select("SELECT * FROM comments WHERE user_id=? AND id=? AND deleted_at IS NULL", [$user_id, $id]);
    }

    public function delete($user_id, $id) {
        return DB::update("UPDATE comments SET deleted_at = NOW() WHERE user_id=? AND id=?", [$user_id, $id]);
    }
}