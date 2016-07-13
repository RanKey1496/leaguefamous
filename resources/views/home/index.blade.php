@extends('template.main')

@section('content')
	<!--Header-->
	<!--
	<div class="container">
		<div class="jumbotron jumbotron-dark">
		  <h1>Welcome</h1>
		  <p>Wombats are short-legged, muscular quadrupedal marsupials that are native to Australia.</p>
		</div>
	</div> -->
	<!--Search-->
	<div class="section section-dark">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<h1 class="main-header">Welcome to Wood Tier!</h1>
					<h4>See what people have to say about your favorite summoners!</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
					<div class="search-wrapper" action="http://www.google.com">
						<form method="get" action="/#">
							<input type="text" class="form-control summoner-search" aria-label="..." placeholder="Find platinum or above summoners...">
							<div class="dropdown region-menu">
								<button class="btn btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
								NA
								<span class="caret"></span>
								</button>
								<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
									<li><a href="#">NA</a></li>
									<li><a href="#">LAN</a></li>
									<li><a href="#">LAS</a></li>
									<li><a href="#">BR</a></li>
									<li role="separator" class="divider"></li>
									<li><a href="#">EUW</a></li>
									<li><a href="#">EUNE</a></li>
									<li><a href="#">RU</a></li>
									<li><a href="#">TR</a></li>
									<li role="separator" class="divider"></li>
									<li><a href="#">KR</a></li>
									<li><a href="#">OCE</a></li>
								</ul>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">

		</div>
	</div>
	<!--End Search-->
	</div>
	<!--End Header-->

	<!--Lists-->
	<div class="section section-with-space">
		<div class="container">
			<div class="row"">
				<div class="col-md-12">
					<h3>Popular Summoners</h3>
					<div class="dropdown">
					<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					All Regions
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
					<li><a href="#">All Regions</a></li>
					</ul>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="list-plate-wrapper">
					@foreach($summoners as $summoner)
						<div class="col-sm-6 col-md-6 col-lg-4 list-plate-outer">
							<div class="col-md-12 list-plate-inner">
								<div class="list-plate-region">{{ $summoner->region }}</div>
								<a href="{{ url('/') }}/{{ $summoner->region }}/{{ $summoner->playerName }}">
									<img class="img-rounded avatar" src="http://ddragon.leagueoflegends.com/cdn/6.12.1/img/profileicon/{{ $summoner->profileIconId }}.png" class="media-photo">
								</a>
								<div class="list-plate-name"><a href="{{ url('/') }}/{{ $summoner->region }}/{{ $summoner->playerName }}">{{ $summoner->playerName }}</a></div>
								<div class="list-plate-division">	{{ $summoner->tier }} {{ $summoner->division }}</div>
								<div class="list-plate-button-outer">
									<span class="list-plate-button">
										@if(!Auth::guest())
											@if(!$summoner->liked)
												<a href="#" id="{{ $summoner->playerId }}_{{ $summoner->region }}" class=" glyphicon glyphicon-heart heart-liked ajax-like">
												</a>
											@else
												<a href="#" id="{{ $summoner->playerId }}_{{ $summoner->region }}" class=" glyphicon glyphicon-heart heart-unliked ajax-like">
												</a>
											@endif
										@else
											<a href="{{ route('users.login') }}" class=" glyphicon glyphicon-heart heart-unliked">
											</a>
										@endif
										{{ $summoner->likes }}
									</span>
									<span class="list-plate-button">
										<span class="glyphicon glyphicon-comment"></span>
										{{ $summoner->comments }}
									</span>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
		<div class="text-center">
			{!! $summoners->render() !!}
		</div>
	</div>
	<div class="section section-light-brown section-with-space">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h3>Newest Comments</h3>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					Jerry > Populum <span class="timestamp">&bull; 1d</span>
					<p>This is a comment.</p>
					<a class="btn btn-danger btn-simple" href="#">Go to Populum's Page</a>
				</div>
				<div class="col-md-6">2
					Jerry > Populum <span class="timestamp">&bull; 1d</span>
					<p>This is a comment.</p>
					<a class="btn btn-danger btn-simple" href="#">Go to Populum's Page</a>
				</div>
			</div>
		</div>
	</div>
<!--
	<div class="container">
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
							<img class="img-rounded avatar" src="http://ddragon.leagueoflegends.com/cdn/6.12.1/img/profileicon/{{ $summoner->profileIconId }}.png" class="media-photo">
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
							@if(!Auth::guest())
								@if(!$summoner->liked)
									<a href="#" id="{{ $summoner->playerId }}_{{ $summoner->region }}" class=" glyphicon glyphicon-heart text-danger ajax-like" style="font-size: 50px; text-decoration: none;">
									</a>
								@else
									<a href="#" id="{{ $summoner->playerId }}_{{ $summoner->region }}" class=" glyphicon glyphicon-heart text-primary ajax-like" style="font-size: 50px; text-decoration: none;">
									</a>
								@endif
							@else
								<a href="{{ route('users.login') }}" class=" glyphicon glyphicon-heart text-danger" style="font-size: 50px; text-decoration: none;">
								</a>
							@endif
						</td>
					</tr>
				@endforeach
			</tbody>
		  </table>
		</div>
	</div>
-->

	<script type="text/javascript">
		$(document).ready(function($) {
			$(".table-row").click(function() {
				window.document.location = $(this).data("href");
			});
		});

		$(function() {
                $('.ajax-like').click(function(e) {
                    e.preventDefault();
                    var id=$(this).attr("id");
                    $.post('{{ route('summoners.like') }}', {
                        "summonerId_region" : $(this).attr("id")
                    }, function(response) {
                        if(response.result != null && response.result == '1'){
                            if(response.isunlike=='1'){
                                $("#"+id).removeClass('text-danger');
                                $("#"+id).addClass('text-primary');
                            }else{
                                $("#"+id).removeClass('text-primary');
                                $("#"+id).addClass('text-danger');
                            }
                        }else{
                            alert("Server Error");
                        }
                    }, "json").always(function() {
                        //l.stop();
                    });
                    return false;
                });
            });
	 $(function(){

$(".dropdown-menu li a").click(function(){
  $(this).parents(".dropdown").find('.btn').html($(this).text() + ' <span class="caret"></span>');
  $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
});

});

	</script>

	<!--End Lists-->
@endsection
