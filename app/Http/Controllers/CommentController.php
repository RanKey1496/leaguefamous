<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Comment;
use Laracasts\Flash\Flash;
use DB;
use App\User;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Input;
use Response;

class CommentController extends Controller
{
    public function __construct(){
        $this->middleware('auth', ['except' => ['index', 'content', 'contentAfterTime']]);
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

    public function index($commentId){
        $comment = DB::select("SELECT * FROM comments WHERE id=? AND parentId IS NULL AND deleted_at IS NULL", [$commentId]);
        $commentsReply = DB::select("SELECT * FROM comments WHERE parentId=? AND deleted_at IS NULL ORDER BY created_at DESC", [$commentId]);
        foreach ($comment as $comment) {
                $data = User::find($comment->user_id);
                $comment->username = $data->username;
                $comment->icon = $data->profileImage;
                $comment->created_at = Carbon::parse($comment->created_at)->diffForHumans();
        }
        foreach ($commentsReply as $commentReply) {
                $data = User::find($commentReply->user_id);
                $commentReply->username = $data->username;
                $commentReply->icon = $data->profileImage;
                $commentReply->created_at = Carbon::parse($comment->created_at)->diffForHumans();
        }
        //dd($commentsReply);
        return View('comment.index')->with('comment', $comment)->with('commentReplys', $commentsReply);
    }

    public function content($commentId){
        $comment = new Comment();
        $content = $comment->content($commentId);
        $contentReplys = $comment->contentReplys($commentId);
        foreach ($content as $content) {
            $content->replies = $contentReplys;
            $content->created_at = strtotime($content->created_at);
            $content->updated_at = strtotime($content->updated_at);
            foreach ($content->replies as $contentReply) {
                $contentReply->created_at = strtotime($contentReply->created_at);
                $contentReply->updated_at = strtotime($contentReply->updated_at);
            }
        }
        
        return Response::json(array('comment' => $content));
    }

    public function contentAfterTime($commentId, $afterTime){
        
    }
}
