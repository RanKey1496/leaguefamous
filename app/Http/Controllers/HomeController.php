<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Summoner;
use App\Like;
use Auth;
use App\Comment;

class HomeController extends Controller
{
    public function home()
    {
		$summoners = Summoner::orderBy('tier', 'ASC')->paginate(20);
		$like = new Like();
		$comment = new Comment();
		if(!Auth::guest()){
			foreach ($summoners as $summoner) {
				$liked = $like->getLike($summoner->playerId, $summoner->region, Auth::user()->id);
				
				if($liked != NULL){
					$summoner->liked = True;
				} else {
					$summoner->liked = False;
				}
			}
		}
		foreach ($summoners as $summoner) {
			$likes = $like->likes($summoner->playerId, $summoner->region);
			$comments = $comment->comments($summoner->playerId, $summoner->region);
			$summoner->likes = $likes[0]->cont;
			$summoner->comments = $comments[0]->cont;
		}
        return view('home.index')->with('summoners', $summoners);
    }

    public function index(){
	}
}
