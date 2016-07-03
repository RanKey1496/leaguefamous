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
	
	<div class="container">
		<div class="row">
		  	<div class="col-xs-6 col-sm-4">
		      	<input type="text" class="form-control" placeholder="Search summoners...">
		 	</div>
		 	<div class="col-xs-6 col-sm-offset-2">
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
		</div>
	</div>
	<!--End Search-->
	<br>
	</div>
	<!--End Header-->

	<!--Lists-->

	<div class="container">
		<div class="row">
			@foreach($summoners as $summoner)
				<div class="col-sm-6 col-md-4 col-lg-4 list-plate-outer">
					<div class="col-md-12 list-plate-inner">
						<div class="list-plate-region">{{ $summoner->region }}</div>
						<a href="{{ url('/') }}/{{ $summoner->region }}/{{ $summoner->playerName }}">
							<img class="img-rounded avatar" src="http://ddragon.leagueoflegends.com/cdn/6.12.1/img/profileicon/{{ $summoner->profileIconId }}.png" class="media-photo">
						</a>
						<span class="list-plate-name"><a href="{{ url('/') }}/{{ $summoner->region }}/{{ $summoner->playerName }}">{{ $summoner->playerName }}</a></span>
						<br>
							{{ $summoner->tier }} {{ $summoner->division }}
						<br>
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
	</script>

	<!--End Lists-->

	{!! $summoners->render() !!}
@endsection