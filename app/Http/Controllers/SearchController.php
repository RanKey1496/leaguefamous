<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Summoner;
use Illuminate\Support\Facades\Input;
use Response;
use View;

class SearchController extends Controller
{
    public function index($name)
	{

		// Retrieve the user's input and escape it
		$query = $name;//e(Input::get('q',''));

		// If the input is empty, return an error response
		//if(!$query && $query == '') return Response::json(array(), 400);

		$summoners = Summoner::where('playerName','like','%'.$query.'%')->orderBy('playerName','asc')->take(5)->get(array('playerName','region','profileIconId'))->toArray();
		//$summoners = Summoner::All()->toArray();

		$summoners = $this->appendURL($summoners, $summoners);

		// Add type of data to each item of each set of results

		return Response::json(array('data'=>$summoners));
	}

	public function appendURL($data, $prefix)
	{
		$i = 0;
		// operate on the item passed by reference, adding the url based on slug
		foreach ($data as $key => & $item) {
			$item['url'] = url($prefix[$i]['region'].'/'.$prefix[$i]['playerName'].'/');
			$i++;
		}
		return $data;		
	}

	public function all(){
		$summoners = Summoner::orderBy('playerName','asc')->get(array('playerName', 'region', 'profileIconId'))->toArray();

		return Response::json(array('data'=>$summoners));
	}

	public function search(Request $keyword)
    {

        //$searchUsers = Summoner::where("name", "iLIKE", "%{$keyword->get('keywords')}%");
        $summoners = Summoner::where('playerName','like','%'.$keyword->input('keywords').'%')->orderBy('playerName','asc')->take(5)->get(array('playerName','region','profileIconId'));
        return View::make('template.searchSummoner')->with('summoners', $summoners);

    }
}
