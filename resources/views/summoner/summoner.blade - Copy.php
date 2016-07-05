@extends('template.submain')

@section('content')

	<!--Summoner Data-->
	<div class="section1 maze">
		<div class="container">
		    <div class="row">
		        <div class="col-md-2 summoner-profile-left">
					<div class="summoner-avatar"><img class="img-rounded" src="{{ 
				$iconURL }}">
					</div>
				</div>
				<div class="col-md-10 summoner-profile-right">
					<div class="col-md-12 summoner-name">
							{{ $summoner[0]->playerName }}
					</div>
					<div class="col-md-12 summoner-button-wrapper">
						<span class="summoner-button">
							<a href="#" class="glyphicon glyphicon-heart"></a>
							{{ $summoner[0]->likes }}
						</span>
						<span class="summoner-button">
							<span class="glyphicon glyphicon-comment"></span>
							{{ $summoner[0]->comments }}
						</span>
					</div>
					<div class="col-md-12">
						<div class="col-xs-6 col-sm-4 col-md-2 summoner-data">
							<h6>Region</h6>
							<p>{{ $summoner[0]->region }}</p>
						</div>
						<div class="col-xs-6 col-sm-4 col-md-2 summoner-data">
							<h6>Popularity</h6>
							<p>{{ $summoner[0]->playerId }}</p>
						</div>
						<div class="col-xs-6 col-sm-4 col-md-2 summoner-data">
							<h6>Current League</h6>
							<p>{{ $summoner[0]->tier }} {{ $summoner[0]->division }}</p>
						</div>
						<div class="col-xs-6 col-sm-4 col-md-2 summoner-data">
							<h6>League Points</h6>
							<p>{{ $summoner[0]->leaguePoints }}</p>
						</div>
						<div class="col-xs-6 col-sm-4 col-md-2 summoner-data">
							<h6>Max League</h6>
							<p>{{ $summoner[0]->maxTier }} {{ $summoner[0]->maxDivision }}</p>
						</div>
						<div class="col-xs-6 col-sm-4 col-md-2 summoner-data">
							<h6>Win / Loss</h6>
							<p>{{ $summoner[0]->wins }} / {{ $summoner[0]->losses }}</p>
						</div>
					</div>
			    </div>
				</div>
			</div>
		</div>
	</div>
	<!--End Summoner Data-->

	@if($summoner[0])
		<div class="container-flexible member-warning">
		@if(Auth::guest())
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<p class="text-center">This area is for Wood Tier members only. If you are a member, please <a href="{{ route('users.login') }}">Login</a> to comment. Otherwise, please exit this page.</p>
					</div>
				</div>
			</div>
		@else
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<form method="post" action="{{ route('comments.store') }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="summonerId" value="{{ $summoner[0]->playerId }}">
							<input type="hidden" name="region" value="{{ $summoner[0]->region }}">
							<div class="form-group">
								<textarea required="required" placeholder="Enter comment here" name="body" class="form-control"></textarea>
							</div>
							<input type="submit" name='post_comment' class="btn btn-success" value="Post"/>
						</form>
					</div>
				</div>
			</div>
		@endif
		</div>
		<div class="section comment-section">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h1 class="section-header">Comments</h1>
					</div>
				</div>
		@if($comments)
				<div class="row">
					<div class="comment-grid">
				@foreach($comments as $comment)

					@if($comment->parentId == NULL)
					<div class="col-sm-6 col-lg-4 comment-tile">
						<div id="comment_{{ $comment->id }}" class="comment-panel">
							<div class="row">
								<div class="col-md-12 comment-header">
									<div class="comment-cog">
										    @if(!Auth::guest())
												@if(Auth::user()->id == $comment->user_id)
												  		<a href="#" id="{{ $comment->id }}" class="glyphicon glyphicon-cog ajax-remove"></a>
												@endif
											@endif
									</div>
							  		<div><img class="img-responsive img-circle comment-profile-md" style="width:56px; height: 56px; margin-right:20px;" src="{{ url('/') }}/{{ $comment->icon }}">
									</div>
									<div class="comment-title-wrapper">
								    	<span class="comment-username">{{ $comment->username }}</span>
								    	<br>
								    	<span>{{ $comment->created_at }}</span>
								    </div>
								</div>

								<div class="col-md-12">
							    	<p>{{ $comment->body }}</p>
						    		<div class="list-group">
							    		@foreach($comments as $commentReply)
							    			@if($commentReply->parentId == $comment->id)
							    				<div id="comment_{{ $commentReply->id }}" class="list-group-item">
							    					<strong>{{ $commentReply->username }}</strong> 
												    <span class="text-default">{{ $commentReply->created_at }}</span>
												    @if(!Auth::guest())
														@if(Auth::user()->id == $commentReply->user_id)
														  		<a href="#" id="{{ $commentReply->id }}" class="glyphicon glyphicon-remove text-danger pull-right ajax-remove" style="font-size: 20px; text-decoration: none;"></a>
														@endif
													@endif
													<p>{{ $commentReply->body }}</p>
							    				</div>
							    			@endif
							    		@endforeach
							    	</div>
							    </div>
<!--comment reply-->
					    		@if(!Auth::guest())
					    		<div class="col-md-12">
					    			<a href="" id="make_{{ $comment->id }}" class="make-reply-a">Reply</a>
									<div id="make_{{ $comment->id }}_reply" class="panel-body" style="display:none;">
										<form method="post" action="{{ route('comments.storeReply') }}">
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<input type="hidden" name="commentId" value="{{ $comment->id }}">
											<input type="hidden" name="summonerId" value="{{ $summoner[0]->playerId }}">
											<input type="hidden" name="region" value="{{ $summoner[0]->region }}">
											<div class="form-group">
												<textarea required="required" placeholder="Enter comment here" name="body" class="form-control"></textarea>
											</div>
											<input type="submit" name='post_comment' class="btn btn-success" value="Reply"/>
										</form>
									</div>
								</div>
								@endif
							</div>
						</div>
					</div>
					@endif
				@endforeach
					</div>
				</div>
			</div>
		@endif
			</div>
		</div>
	@else
		404 error
	@endif
	<script type="text/javascript">
		$(function() {
			$('.ajax-remove').click(function(e) {
				e.preventDefault();
				var id = $(this).attr("id");
				$.post('{{ route('comments.destroy') }}', {
					"comment" : $(this).attr("id")
				}, function(response) {
					if(response.result != null && response.result == '1'){
						if(response.isdeleted=='1'){
							$("#comment_"+id).remove();
						}
					}else{
						alert("Server Error");
					}
				}, "json").always(function() {
                    });
				return false;
			});
		});

		$(function(){
			$('.make-reply-a').click(function(e){
				e.preventDefault();
				var id = $(this).attr("id");
				$('#'+id).css('display','none');
				$('#'+id+'_reply').css('display','inline');
			});
		});
/*
		// init Masonry
		var $grid = $('.comment-grid').masonry({
		  // options...
		});
		// layout Masonry after each image loads
		$grid.imagesLoaded().progress( function() {
		  $grid.masonry('layout');
		});
		$('.comment-grid').masonry({
  			itemSelector: '.comment-tile',
  			columnWidth: 1,
		});

*/

		switch("{{ $summoner[0]->region }}") {
			case "na":
				document.getElementById("region").innerHTML = "North America";
				break;
			case "lan":
				document.getElementById("region").innerHTML = "Latin America North";
				break;
			case "las":
				document.getElementById("region").innerHTML = "Latin America South";
				break;
			case "br":
				document.getElementById("region").innerHTML = "Brazil";
				break;
			case "euw":
				document.getElementById("region").innerHTML = "Europe West";
				break;
			case "eune":
				document.getElementById("region").innerHTML = "Europe Nordic & East";
				break;
			case "ru":
				document.getElementById("region").innerHTML = "Russia";
				break;
			case "tr":
				document.getElementById("region").innerHTML = "Turkey";
				break;
			case "kr":
				document.getElementById("region").innerHTML = "South Korea";
				break;
			case "oce":
				document.getElementById("region").innerHTML = "Oceania";
				break;
			case "jp":
				document.getElementById("region").innerHTML = "Japan";
				break;
			default:
				document.getElementById("region").innerHTML = "{{ $summoner[0]->region }}";
		};
	</script>

@endsection