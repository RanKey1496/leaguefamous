<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Summoner;
use App\Like;
use Auth;

class HomeController extends Controller
{
    public function home()
    {
		$summoners = Summoner::orderBy('tier', 'ASC')->paginate(20);
		if(!Auth::guest()){
			$likes = new Like();
			foreach ($summoners as $summoner) {
				$liked = $likes->getLike($summoner->playerId, $summoner->region, Auth::user()->id);
				
				if($liked != NULL){
					$summoner->liked = True;
				} else {
					$summoner->liked = False;
				}
			}
		}
        return view('home.index')->with('summoners', $summoners);
    }

    public function index(){
	}
}
