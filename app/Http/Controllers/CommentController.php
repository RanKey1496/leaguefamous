<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Comment;
use Laracasts\Flash\Flash;
use DB;
use Auth;
use Illuminate\Support\Facades\Input;
use Response;

class CommentController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
    	DB::insert("INSERT INTO comments (user_id, summoner_id, summoner_region, body) VALUES(?,?,?,?)", [$request->user()->id, $request->input('summonerId'), $request->input('region'), $request->input('body')]);
    	return redirect()->back();     
    }

    public function storeReply(Request $request)
    {
        DB::insert("INSERT INTO comments (parentId, user_id, summoner_id, summoner_region, body) VALUES(?,?,?,?,?)", [$request->input('commentId'), $request->user()->id, $request->input('summonerId'), $request->input('region'), $request->input('body')]);
        return redirect()->back();     
    }

    public function destroy(Request $request){
        if(Input::has("comment")){
            $comment = new Comment();
            $commented = $comment->getComment(Auth::user()->id, Input::get('comment'));

            if(count($commented) > 0){
                $comment->delete(Auth::user()->id, Input::get('comment'));
                Flash::success("Your comment was deleted");
                return Response::json(array('result'=>'1','isdeleted'=>'1','text'=>'Deleted'));
            }
        }else{
            return Response::json(array('result' => '0'));
        }
    }
}
