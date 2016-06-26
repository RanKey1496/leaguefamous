<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Summoner;

class SummonersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($region, $summonerName)
    {
        $api_key = '42a8caaa-9b4f-4fa6-b26d-a59494d6b76d';

        //https://lan.api.pvp.net/api/lol/lan/v1.4/summoner/by-name/sensual%20rankey?api_key=42a8caaa-9b4f-4fa6-b26d-a59494d6b76d
        //https://lan.api.pvp.net/api/lol/lan/v2.5/league/by-summoner/91615/entry?api_key=42a8caaa-9b4f-4fa6-b26d-a59494d6b76d

        $client = new \GuzzleHttp\Client();

        $nameRes = $client->request('GET', 'https://'.$region.'.api.pvp.net/api/lol/'.$region.'/v1.4/summoner/by-name/'.$summonerName.'?api_key='.$api_key);
        $nameData = $nameRes->getBody();
        $nameData = json_decode($nameData, true);
        $summonerNameWithoutSpaces = str_replace(' ', '', $summonerName);
        $summonerId = $nameData[$summonerNameWithoutSpaces]['id'];
        $summonerName = $nameData[$summonerNameWithoutSpaces]['name'];
        $summonerProfileIconId = $nameData[$summonerNameWithoutSpaces]['profileIconId'];

        $matchThese = ['playerId' => $summonerId, 'region' => $region];

        $summoner = Summoner::where($matchThese)->get();
        if (count($summoner) > 0){
            echo "Lo encuentra";
        } else {
            echo "No lo encuentra";
        }
        /*
        $res = $client->request('GET', 'https://'.$region.'.api.pvp.net/api/lol/'.$region.'/v2.5/league/'.$league.'?type=RANKED_SOLO_5x5&api_key='.$api_key);
        $data = $res->getBody();
        $data = json_decode($data, true);
        $leagueName = $data['name'];
        $leagueTier = $data['tier'];
        $leagueQueue = $data['queue'];
        $entries = $data['entries'];

        for($i = 0; $i < count($entries); $i++){
            $user = new Summoner;
            $user->region = $region;
            $user->leagueName = $leagueName;
            $user->tier = $leagueTier;
            $user->queue = $leagueQueue;
            $user->playerId = $playerOrTeamId = $entries[$i]['playerOrTeamId'];
            $user->playerName = $playerOrTeamName = $entries[$i]['playerOrTeamName'];
            $user->division = $division = $entries[$i]['division'];
            $user->leaguePoints = $leaguePoints = $entries[$i]['leaguePoints'];
            $user->wins = $wins = $entries[$i]['wins'];
            $user->losses = $losses = $entries[$i]['losses'];
            $user->division = $division = $entries[$i]['division'];
            $user->leaguePoints = $leaguePoints = $entries[$i]['leaguePoints'];
            $user->user_id = 0;
            $user->save();
            echo "\r\n".$playerOrTeamName;
        }*/

        //dd($summonerId);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
