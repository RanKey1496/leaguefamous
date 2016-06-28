@extends('template.main')

@section('content')

	<!--Summoner Data-->
	<div class="container">
		<img class="img-rounded" src="{{ $iconURL }}">
		<p>{{ $summoner[0]->playerId }}</p>
		<h1>{{ $summoner[0]->playerName }}</h1>
		<p>{{ $summoner[0]->region }}</p>
		<p>{{ $summoner[0]->leagueName }}</p>
		<p>{{ $summoner[0]->tier }}</p>
		<p>{{ $summoner[0]->division }}</p>
		<p>{{ $summoner[0]->queue }}</p>
		<p>{{ $summoner[0]->leaguePoints }}</p>
		<p>{{ $summoner[0]->wins }}</p>
		<p>{{ $summoner[0]->losses }}</p>
		<p>{{ $summoner[0]->likes }}</p>
		<p>Max Tier Obtenido - {{ $summoner[0]->maxTier }}</p>
		<p>Max Division Obtenido - {{ $summoner[0]->maxDivision }}</p>
	</div>
	<!--End Summoner Data-->

@endsection