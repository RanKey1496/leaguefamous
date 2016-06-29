<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Summoner;
use App\Like;

class HomeController extends Controller
{
    public function home()
    {
		$summoners = Summoner::orderBy('tier', 'ASC')->paginate(20);
        return view('home.index')->with('summoners', $summoners);
    }

    public function index(){
	}
}
