@extends('template.main')

@section('content')
	<!--Header-->
	<div class="container">
	  <div class="jumbotron">
	    <h1>Welcome</h1> 
	    <p>.Wombats are short-legged, muscular quadrupedal marsupials that are native to Australia. They are about 1 m (40 in) in length with small, stubby tails. There are three extant species and they are all members of the family Vombatidae. They are adaptable and habitat tolerant, and are found in forested, mountainous, and heathland areas of south-eastern Australia, including Tasmania, as well as an isolated patch of about 300 ha (740 acres) in Epping Forest National Park[2] in central Queensland.</p> 
	  </div>

	<!--Search-->
	<div class="dropdown pull-right">
	  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
	    North America
	    <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
	    <li><a href="#">North America</a></li>
	    <li><a href="#">Latin America North</a></li>
	    <li><a href="#">Latin America South</a></li>
	    <li><a href="#">Brazil</a></li>
	    <li role="separator" class="divider"></li>
	    <li><a href="#">Europe West</a></li>
	    <li><a href="#">Europe Nordic &amp; East</a></li>
	    <li><a href="#">Russia</a></li>
	    <li><a href="#">Turkey</a></li>
	    <li role="separator" class="divider"></li>
	    <li><a href="#">South Korea</a></li>
	    <li><a href="#">Oceania</a></li>
	    <li role="separator" class="divider"></li>
	    <li><a href="#">All</a></li>
	  </ul>
	</div>
	<div class="row">
	  <div class="col-md-4">
	    <div class="input-group">
	      <input type="text" class="form-control" placeholder="Search summoners...">
	    </div><!-- /input-group -->
	  </div><!-- /.col-lg-6 -->
	</div><!-- /.row -->
	<!--End Search-->

	</div>
	<hr/>
	<!--End Header-->

	<!--Lists-->
	<div class="table-responsive">
	  <table class="table table-hover">
	    <thead>
			<th>Imagen</th>
			<th>Summoner</th>
			<th>Rank</th>
			<th>Wins</th>
			<th>Losses</th>
			<th>Likes</th>
		</thead>
		<tbody>
			@foreach($summoners as $summoner)
				<tr class="table-row" data-href="{{ url('/') }}/{{ $summoner->region }}/{{ $summoner->playerName }}">
					<td class="text-center"> 
						<img class="img-rounded" src="http://ddragon.leagueoflegends.com/cdn/6.12.1/img/profileicon/{{ $summoner->profileIconId }}.png" class="media-photo">
					</td>
					<td>
						<h2 class="media-meta">{{ $summoner->playerName }}</h2>
					</td>
					<td>
						<h2 class="media-meta">{{ $summoner->tier }} {{ $summoner->division }}</h2>
					</td>
					<td>
						<h2 style="color: #00ff00;" class="summary">{{ $summoner->wins }}</h2>
					</td>
					<td>
						<h2 style="color: #ff0000;" class="summary">{{ $summoner->losses }}</h2>
					</td>
					<td>
						<a href="" class="star">
							<h2 class="glyphicon glyphicon-star" aria-hidden="true"></h2>
						</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	  </table>
	</div>

	<script type="text/javascript">
		$(document).ready(function($) {
			$(".table-row").click(function() {
				window.document.location = $(this).data("href");
			});
		});
	</script>

	<style type="text/css">
		.table-row{
			cursor:pointer;
		}
	</style>
	<!--End Lists-->

	{!! $summoners->render() !!}
@endsection