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
	<hr/>
	<div id="remote">
	  <input class="typeahead" type="text" placeholder="Search summoners...">
	</div>
	<div class="container">
	    <p class="example-description">Search summoners: </p>
		<input id="my-input" class="typeahead" type="text" placeholder="input a country name">
	</div>
	<hr/>
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

	<style type="text/css">
		.table-row{
			cursor:pointer;
		}
	</style>

	<script type="text/javascript">
		var summoners = new Bloodhound({
		  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
		  queryTokenizer: Bloodhound.tokenizers.whitespace,
		  prefetch: 'http://localhost/leaguefamous-html/public/all',
		  remote: {
		    url: 'http://localhost/leaguefamous-html/public/search/summoner/%QUERY'
		    wildcard: '%QUERY'
		  }
		});

		$('#remote .typeahead').typeahead(null, {
		  name: 'summoners',
		  display: 'value',
		  source: summoners
		});

		$(document).ready(function(){
		    $('input.typeahead').typeahead({
		        name: 'summoners',
		        prefetch: 'http://localhost/leaguefamous-html/public/all',
		        limit: 10
		    });
		}); 
	</script>
	<!--End Lists-->

	{!! $summoners->render() !!}
@endsection