<?php

namespace App;

use DB;

class Like
{
    //Like Summoners

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

    public function likes($summonerId, $region){
        return DB::select("SELECT COUNT(*) AS cont FROM likes WHERE summoner_id=? AND summoner_region=? AND deleted_at IS NULL", [$summonerId, $region]);
    }

    // Like Comments
    public function cLike($commentId, $user_id){
        return DB::select("SELECT * FROM like_comments WHERE comment_id = ? AND user_id = ? AND deleted_at IS NULL", [$commentId, $user_id]);
    }

    public function cLiked($commentId, $user_id) { 
        return DB::update("UPDATE like_comments SET deleted_at=NOW() WHERE comment_id = ? AND user_id=?", [$commentId, $user_id]);
    }

    public function cLikes($commentId){
        return DB::select("SELECT COUNT(*) AS cont FROM like_comments WHERE comment_id=? AND deleted_at IS NULL", [$commentId]);
    }

    public function getcLiked($commentId, $user_id) { 
        return DB::select("SELECT * FROM like_comments WHERE comment_id = ? AND user_id=? AND deleted_at IS NOT NULL", [$commentId, $user_id]);
    }

    public function updatecSave($commentId, $user_id) {
        return DB::insert("UPDATE like_comments SET deleted_at = NULL WHERE comment_id = ? AND user_id=?", [$commentId, $user_id]);
    }

    public function csave($commentId, $user_id) {
        return DB::insert("INSERT INTO like_comments (comment_id, user_id) VALUES (?,?)", [$commentId, $user_id]);
    }
}
