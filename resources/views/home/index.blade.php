@extends('template.main')

@section('content')

<div class="section">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h1>Welcome to website!</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<h3>Recent Activity</h3>
				<div class="recent-comments-wrapper">
				</div>
			</div>
			<div class="col-md-8">
				<h3>Top 50</h3>
				<div class="grid">
					@foreach($summoners as $summoner)
						<div class="grid-item">
							<div class="grid-panel panel-bg">
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
												<span id="{{ $summoner->playerId }}_{{ $summoner->region }}" class="glyphicon glyphicon-heart ajax-like"></span>
											@else
												<span id="{{ $summoner->playerId }}_{{ $summoner->region }}" class="glyphicon glyphicon-heart heart-liked ajax-like"></span>
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
	</div>
<div class="section">
</div>

<!-- Header -->


<!--End Header-->




	<script id="tplRecent" type="text/x-handlebars-template">
		@{{#each comments}}
		<div class="row">
			<div class="col-md-12">
				<div class="recent-panel panel-bg">
					<div class="recent-header">
							<img class="img-responsive img-circle img-no-padding recent-profile-img" src="@{{profileImage}}">
							<div class="recent-user-info">
								@{{username}} &bull;&nbsp;<span class="timestamp">@{{created_at}}</span>
							</div>
					</div>
					<div class="recent-body">
						@{{body}}
					</div>
					<a href="@{{urlStart}}/@{{summoner_region}}/@{{summonerName}}">
						<div class="recent-footer">
								<div class="recent-summoner-info">
									@{{summonerName}} &bull;&nbsp;<span class="recent-region">@{{summoner_region}}</span>
								</div>
								<img class="recent-summoner-img" src="http://ddragon.leagueoflegends.com/cdn/6.12.1/img/profileicon/@{{profileIconId}}.png" />

						</div>
					</a>
				</div>
			</div>
		</div>
		@{{/each}}
	</script>

	<script type="text/javascript">

	var homeUrl = "{{ url('/') }}/";

	Handlebars.registerHelper("urlStart"), function(){
		return homeUrl;
	}

		var boomerang = function (url, tplId, anchor) {
			$.getJSON(url, function(data) {
				var template = $(tplId).html();
				var stone = Handlebars.compile(template)(data);
				$(anchor).html(stone);
			});
		};

		boomerang("http://localhost/woodtier/public/recent","#tplRecent",".recent-comments-wrapper")

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
                        $("#"+id).removeClass('heart-liked').addClass('');
                    }else{
                        $("#likes_"+id).text(response.cnt);
                        $("#"+id).removeClass('').addClass('heart-liked');
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
			var parentWidth = $('.grid').width();
		  var roundDown = Math.floor(parentWidth / 170);
		  var percentWidth = Math.floor(1 / roundDown * 10000) / 100;
		  $('.grid-item').css({
		    'width': percentWidth + '%',
		    'height': '180px'
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
