@extends('template.main')

@section('content')

<div class="section">
	<div class="container-fluid">
		<h2>TOP 50</h2>
	</div>
	<div class="grid">
		@foreach($summoners as $summoner)
			<div class="grid-item">
				<div class="grid-panel">
					<div class="grid-header">
						<span class="grid-popularity">{{ $summoner->rank }}</span>
						<span class="grid-region">{{ $summoner->region }}</span>
					</div>
					<a href="{{ url('/') }}/{{ $summoner->region }}/{{ $summoner->playerName }}" class="grid-body">
						<div class="grid-name">{{ $summoner->playerName }}</div>
						<img src="http://ddragon.leagueoflegends.com/cdn/6.12.1/img/profileicon/{{ $summoner->profileIconId }}.png" class="grid-avatar">
						<div class="grid-division">{{ $summoner->tier }} {{ $summoner->division }}</div>
					</a>
					<div class="grid-footer">
						<div class="grid-comments">
							<span class="glyphicon glyphicon-comment"></span>
							{{ $summoner->comments }}
						</div>
						<div class="grid-likes">
							@if(!Auth::guest())
								@if(!$summoner->liked)
									<span id="{{ $summoner->playerId }}_{{ $summoner->region }}" class="glyphicon glyphicon-heart text-primary ajax-like"></span>
								@else
									<span id="{{ $summoner->playerId }}_{{ $summoner->region }}" class="glyphicon glyphicon-heart text-danger ajax-like"></span>
								@endif
							@else
								<a href="{{ route('users.login') }}" class="glyphicon glyphicon-heart heart-unliked"></a>
							@endif
							<span>{{ $summoner->likes }}</span>
						</div>
					</div>
				</div>
			</div>
		@endforeach
	</div>
</div>

<!-- Header -->


<!--End Header-->
	<!--Lists-->
	<!--

	<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1 class="main-header">Welcome!</h1>
					<h4>Have a look around.</h4>
				</div>
			</div>
		</div>
	</div>

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
						<div class=" col-md-8">
							<div class="list-plate-inner">
								<a href="{{ url('/') }}/{{ $summoner->region }}/{{ $summoner->playerName }}">
									<img class="avatar" src="http://ddragon.leagueoflegends.com/cdn/6.12.1/img/profileicon/{{ $summoner->profileIconId }}.png" class="media-photo">
								</a>
								<a href="{{ url('/') }}/{{ $summoner->region }}/{{ $summoner->playerName }}" class="list-plate-main">
									<div>
										<span class="list-plate-name">{{ $summoner->playerName }}</span>
										<span class="list-plate-popularity">#1</span>
									</div>
									<div class="list-plate-division">{{ $summoner->region }} &bull;	{{ $summoner->tier }} {{ $summoner->division }}</div>
								</a>
								<div class="list-plate-button-outer">
									<span class="list-plate-button">
										<span id="likes_{{ $summoner->playerId }}_{{ $summoner->region }}">{{ $summoner->likes }}</span>
										@if(!Auth::guest())
											@if(!$summoner->liked)
												<span id="{{ $summoner->playerId }}_{{ $summoner->region }}" class="glyphicon glyphicon-heart text-primary ajax-like">
												</span>
											@else
												<span id="{{ $summoner->playerId }}_{{ $summoner->region }}" class="glyphicon glyphicon-heart text-danger ajax-like">
												</span>
											@endif
										@else
											<a href="{{ route('users.login') }}" class=" glyphicon glyphicon-heart heart-unliked">
											</a>
										@endif
									</span>
									<span class="list-plate-button">
										{{ $summoner->comments }}
										<span class="glyphicon glyphicon-comment"></span>
									</span>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
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
                    var id=$(this).attr("id");
                    $.post('{{ route('summoners.like') }}', {
                        "summonerId_region" : $(this).attr("id")
                    }, function(response) {
                        if(response.result != null && response.result == '1'){
                            if(response.isunlike=='1'){
                                $("#likes_"+id).text(response.cnt);
                                $("#"+id).removeClass('text-danger').addClass('text-primary');
                            }else{
                                $("#likes_"+id).text(response.cnt);
                                $("#"+id).removeClass('text-primary').addClass('text-danger');
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
		var gridWidth = function() {
		  var roundDown = Math.floor(window.innerWidth / 180);
		  var percentWidth = Math.floor(1 / roundDown * 10000) / 100;
		  $('.grid-item').css({
		    'width': percentWidth + '%',
		    'height': percentWidth + 'vw'
		  });
		}

		gridWidth();

		$(window).resize(function(){
			gridWidth();
		});

		$('.grid').packery({
			itemSelector: '.grid-item',
			gutter:0
		}).packery();
	});

	</script>

	<!--End Lists-->
@endsection
