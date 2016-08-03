<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Laracasts\Flash\Flash;
use App\Like;
use DB;
use Auth;
use Illuminate\Support\Facades\Input;
use Response;

class LikeController extends Controller
{
	public function __construct(){
        $this->middleware('auth');
    }

    public function like(Request $request){
        if(Input::has("summonerId_region")){

            $summonerId_region = explode('_',Input::get('summonerId_region'));

            $summonerId = $summonerId_region[0];
            $region = $summonerId_region[1];

            $like = new Like();
            $likes = $like->getLike($summonerId, $region, Auth::user()->id);

            if(count($likes) > 0){
                $likes = $like->liked($summonerId, $region, Auth::user()->id);
                $likes = $like->likes($summonerId, $region);
                return Response::json(array('result'=>'1','isunlike'=>'0','cnt'=>$likes[0]->cont));
            }else{
                $likes = $like->getLiked($summonerId, $region, Auth::user()->id);
                if(count($likes) > 0){
                    $like->updateSave($summonerId, $region, Auth::user()->id);
                } else {
                    $like->save($summonerId, $region, Auth::user()->id);
                }
                $likes = $like->likes($summonerId, $region);
                return Response::json(array('result'=>'1','isunlike'=>'1','cnt'=>$likes[0]->cont));
            }
        }else{
            return Response::json(array('result' => '0'));
        }        
    }

    public function commentLike(Request $request){
        if(Input::has("commentId")){

            $like = new Like();
            $likes = $like->cLike($commentId, Auth::user()->id);

            if(count($likes) > 0){
                $likes = $like->cLiked($commentId, Auth::user()->id);
                $likes = $like->cLikes($commentId);
                return Response::json(array('result'=>'1','isunlike'=>'0','cnt'=>$likes[0]->cont));
            }else{
                $likes = $like->getcLiked($commentId, Auth::user()->id);
                if(count($likes) > 0){
                    $like->updatecSave($commentId, Auth::user()->id);
                } else {
                    $like->csave($commentId, Auth::user()->id);
                }
                $likes = $like->cLikes($commentId);
                return Response::json(array('result'=>'1','isunlike'=>'1','cnt'=>$likes[0]->cont));
            }
        }else{
            return Response::json(array('result' => '0'));
        }        
    }

    public function unlike(){
        if(Input::has("summonerId_region")){

            $summonerId_region = explode('_',Input::get('summonerId_region'));

            $summonerId = $summonerId_region[0];
            $region = $summonerId_region[1];

            $like = new Like();
            $likes = $like->getLike($summonerId, $region, Auth::user()->id);

            //$like = DB::select("SELECT * FROM likes WHERE summonerId=? AND region =? AND user_id=?");
            //Find if user already liked the post
            if(count($likes) > 0){
                $like->liked($summonerId, $region, Auth::user()->id);
                //Likes::where("post_id",$post_id[1])->where("user_id","1")->delete();
                return Response::json(array('result'=>'1','isunlike'=>'0','text'=>'Like'));
            }else{
                //$like = new Like();
                //We are using hardcoded user id for now , in production change
                //it to Sentry::getId() if using Sentry for authentication
                //$likeelse->user_id="1";
                //$likeelse->post_id=$post_id[1];
                //$likeelse->save();
                $like->save($summonerId, $region, Auth::user()->id);
  
                return Response::json(array('result'=>'1','isunlike'=>'1','text'=>'Unlike'));
            }
        }else{
            //No post id no access sorry
            return Response::json(array('result' => '0'));
        }     
    }
}
