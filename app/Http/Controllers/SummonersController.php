<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use App\Summoner;
use App\User;
use App\Comment;
use App\Like;
use App\SummonersController;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use Carbon\Carbon;

class SummonersController extends Controller
{
    protected $api_key = '42a8caaa-9b4f-4fa6-b26d-a59494d6b76d';

    public function show($region, $summonerName)
    {
        $data = $this->search($region, $summonerName);
        if($data[0] != 'Error'){
            $matchThese = ['playerId' => $data[1], 'region' => $data[0]];
            $summoner = Summoner::where($matchThese)->get();
            $profileIconId = $summoner[0]['profileIconId'];
            $profileIconId = 'http://ddragon.leagueoflegends.com/cdn/6.12.1/img/profileicon/'.$profileIconId.'.png';
            $comment = new Comment();
            $like = new Like();
            $comments = $comment->getComments($summoner[0]['playerId'], $summoner[0]['region']);
            
            foreach ($comments as $comment) {
                $data = User::find($comment->user_id);
                $comment->username = $data->username;
                $comment->icon = $data->profileImage;
                $comment->created_at = Carbon::parse($comment->created_at)->diffForHumans();
            }

            $cntcomment = new Comment();
            $likes = $like->likes($summoner[0]['playerId'], $summoner[0]['region']);
            $cntcomments = $cntcomment->comments($summoner[0]['playerId'], $summoner[0]['region']);
            $summoner[0]->likes = $likes[0]->cont;
            $summoner[0]->comments = $cntcomments[0]->cont;

            return View('summoner.summoner')->with('summoner', $summoner)->with('iconURL', $profileIconId)->with('comments', $comments);
        } else {
            return View('errors.main')->with('error', $data);
        }
    }

    public function search($region, $summonerName)
    {
        $client = new \GuzzleHttp\Client();
        try {
            $nameRes = $client->request('GET', 'https://'.$region.'.api.pvp.net/api/lol/'.$region.'/v1.4/summoner/by-name/'.$summonerName.'?api_key='.$this->api_key);

            $nameData = $nameRes->getBody();
            $nameData = json_decode($nameData, true);
            $summonerNameWithoutSpaces = str_replace(' ', '', $summonerName);
            $summonerNameWithoutSpaces = mb_strtolower($summonerNameWithoutSpaces);
            $summonerId = $nameData[$summonerNameWithoutSpaces]['id'];
            $summonerName = $nameData[$summonerNameWithoutSpaces]['name'];
            $summonerProfileIconId = $nameData[$summonerNameWithoutSpaces]['profileIconId'];

            $matchThese = ['playerId' => $summonerId, 'region' => $region];

            $summoner = Summoner::where($matchThese)->get();
            if (count($summoner) > 0){
                $data = $this->updateSummoner($region, $summonerId, $summonerProfileIconId);
                return $data;
            } else {
                $data = $this->store($region, $summonerId, $summonerProfileIconId);
                return $data;
            }
        } catch (RequestException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            $reason = $e->getResponse()->getReasonPhrase();

            return['Error', $statusCode, $reason];
        }
    }

    public function store($region, $summonerId, $summonerProfileIconId)
    {
        $client = new \GuzzleHttp\Client();

        try {
            $res = $client->request('GET', 'https://'.$region.'.api.pvp.net/api/lol/'.$region.'/v2.5/league/by-summoner/'.$summonerId.'/entry?api_key='.$this->api_key);
            $data = $res->getBody();
            $data = json_decode($data, true);

            $leagueName = $data[$summonerId][0]['name'];
            $leagueTier = $data[$summonerId][0]['tier'];
            $leagueQueue = $data[$summonerId][0]['queue'];
            if($leagueQueue == "RANKED_SOLO_5x5"){
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
                $summoner->maxTier = $leagueTier;
                $summoner->maxDivision = $entries[0]['division'];
                $summoner->profileIconId = $summonerProfileIconId;
                $divisionandtier = $leagueTier.' '.$division;

                if (in_array($divisionandtier, $this->ranges())){
                    $summoner->save();
                    return [$region, $summonerId];
                } else {
                    return ['Error', '', 'The summoner is not high enough rank'];
                }
            } else {
                return ['Error', '',"The summoner didn't play any SoloQ games"];
            }
        } catch (RequestException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            $reason = $e->getResponse()->getReasonPhrase();

            return['Error', $statusCode, $reason];
        }
    }

    public function updateSummoner($region, $summonerId, $summonerProfileIconId){
        $client = new \GuzzleHttp\Client();

        try {
            $res = $client->request('GET', 'https://'.$region.'.api.pvp.net/api/lol/'.$region.'/v2.5/league/by-summoner/'.$summonerId.'/entry?api_key='.$this->api_key);
            $data = $res->getBody();
            $data = json_decode($data, true);

            $leagueName = $data[$summonerId][0]['name'];
            $leagueTier = $data[$summonerId][0]['tier'];
            $leagueQueue = $data[$summonerId][0]['queue'];
            if($leagueQueue == "RANKED_SOLO_5x5"){
                $entries = $data[$summonerId][0]['entries'];
                $summoner = Summoner::where('playerId','=',$summonerId)->where('region', '=', $region)->get();
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
                $summoner->profileIconId = $summonerProfileIconId;
                $divisionandtier = $leagueTier.' '.$division;
                $maxdivisionandtier = $summoner[0]['maxTier'].' '.$summoner[0]['maxDivision'];
                $maxTier = $leagueTier;
                $maxDivision = $entries[0]['division'];

                if(array_search($divisionandtier, $this->ranges()) < array_search($maxdivisionandtier, $this->ranges())){
                    $summoner->maxTier = $leagueTier;
                    $summoner->maxDivision = $entries[0]['division'];
                }

                Summoner::where('playerId','=', $summonerId)->where('region', '=', $region)->update(['leagueName' => $leagueName, 'tier' => $leagueTier, 'playerName' => $playerOrTeamName, 'division' => $division, 'leaguePoints' => $leaguePoints, 'wins' => $wins, 'losses' => $losses, 'maxTier' => $maxTier, 'maxDivision' => $maxDivision, 'profileIconId' => $summonerProfileIconId]);
                //update(['leagueName' => $leagueName, 'tier' => $leagueTier, 'playerName' => $playerOrTeamName, 'division' => $division, 'leaguePoints' => $leaguePoints, 'wins' => $wins, 'losses' => $losses, 'maxTier' => $maxTier, 'maxDivision' => $maxDivision, 'profileIconId' => $summonerProfileIconId]);
                return [$region, $summonerId];
            } else {
                return ['Error', '',"The summoner didn't play any SoloQ games"];
            }
            return [$region, $summonerId];
        } catch (RequestException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            $reason = $e->getResponse()->getReasonPhrase();

            return['Error', $statusCode, $reason];
        }
    }

    public function ranges(){
        $ranges = array(12 => 'PLATINUM V', 11 => 'PLATINUM IV', 10 => 'PLATINUM III', 9 => 'PLATINUM II', 8 => 'PLATINUM I', 7 => 'DIAMOND V', 6 => 'DIAMOND IV', 5 => 'DIAMOND III', 4 => 'DIAMOND II', 3 => 'DIAMOND I', 2 => 'MASTER I', 1 => 'CHALLENGER I');
        return $ranges;
    }
}
