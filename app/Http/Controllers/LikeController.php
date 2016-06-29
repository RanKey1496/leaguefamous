<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;

class LikeController extends Controller
{
	public function __construct(){
        $this->middleware('auth');
    }


    public function likeComment(Request $request)
    {
        // here you can check if product exists or is valid or whatever

        $this->handleLike($request, $id);
        return redirect()->back();
    }

    public function likeSummoner(Request $request)
    {
        // here you can check if product exists or is valid or whatever
    	$this->handleLike($request);
        return redirect()->back();
    }

    public function handleLike(Request $request)
    {
    	$existing_like = DB::select("SELECT * FROM likeables WHERE likeable_type=? AND summoner_id=? AND summoner_region=? AND user_id=?", [$request->input('type'), $request->input('summonerId'), $request->input('region'), $request->user()->id]);
        //$existing_like = Like::withTrashed()->whereLikeableType($type)->whereLikeableId($id)->whereUserId(Auth::id())->first();
    	//dd($existing_like);

        if ($existing_like > 0) {
            DB::select("INSERT INTO likeables (user_id, summoner_id, summoner_region, likeable_type) VALUES(?,?,?,?)", [$request->user()->id, $request->input('summonerId'), $request->input('region'), $request->input('type')]);
        } else {
            if (is_null($existing_like->deleted_at)) {
            	DB::select("UPDATE likeables SET deleted_at=NOW() WHERE id=?", [$request->input('id')]);
            	return redirect()->back(); 
                //$existing_like->delete();
            } else {
                //$existing_like->restore();
                DB::select("UPDATE likeables SET deleted_at=NULL WHERE id=?", [$request->input('id')]);
                return redirect()->back(); 
            }
        }
    }
}
