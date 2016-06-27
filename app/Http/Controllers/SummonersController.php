<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Summoner;
use App\SummonersController;

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
    public function search($region, $summonerName)
    {
        $api_key = '42a8caaa-9b4f-4fa6-b26d-a59494d6b76d';

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
            $this->update($region, $summonerId);
        } else {
            $this->store($region, $summonerId);
        }

        return [$region, $summonerId];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    function store($region, $summonerId)
    {
        $api_key = '42a8caaa-9b4f-4fa6-b26d-a59494d6b76d';

        $client = new \GuzzleHttp\Client();

        $res = $client->request('GET', 'https://'.$region.'.api.pvp.net/api/lol/'.$region.'/v2.5/league/by-summoner/'.$summonerId.'/entry?api_key='.$api_key);
        $data = $res->getBody();
        $data = json_decode($data, true);

        $leagueName = $data[$summonerId][0]['name'];
        $leagueTier = $data[$summonerId][0]['tier'];
        $leagueQueue = $data[$summonerId][0]['queue'];
        $entries = $data[$summonerId][0]['entries'];
        $summoner = new Summoner;
        $summoner->region = $region;
        $summoner->leagueName = $leagueName;
        $summoner->tier = $leagueTier;
        $summoner->queue = $leagueQueue;
        $summoner->playerId = $playerOrTeamId = $entries[0]['playerOrTeamId'];
        $summoner->playerName = $playerOrTeamName = $entries[0]['playerOrTeamName'];
        $summoner->division = $division = $entries[0]['division'];
        $summoner->leaguePoints = $leaguePoints = $entries[0]['leaguePoints'];
        $summoner->wins = $wins = $entries[0]['wins'];
        $summoner->losses = $losses = $entries[0]['losses'];
        $summoner->division = $division = $entries[0]['division'];
        $summoner->leaguePoints = $leaguePoints = $entries[0]['leaguePoints'];
        $summoner->user_id = -1;
        $summoner->maxTier = $leagueTier;
        $summoner->maxDivision = $entries[0]['division'];
        $summoner->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($region, $summonerName)
    {
        $data = $this->search($region, $summonerName);
        $matchThese = ['playerId' => $data[1], 'region' => $data[0]];
        $summoner = Summoner::where($matchThese)->get();
        return View('summoners.index')->with('summoner', $summoner);
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
    public function update($region, $summonerId)
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
