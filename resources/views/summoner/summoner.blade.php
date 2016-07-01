@extends('template.main')

@section('content')

	<!--Summoner Data-->
	<div class="container">
	    <div class="row">
		        <div class="col-md-6 summoner-profile-left">
					<div class="summoner-avatar"><img class="img-rounded" src="{{ 
				$iconURL }}">
					</div>
					<div class="summoner-name">
						{{ $summoner[0]->playerName }}
					</div>
					<div id="region" class="summoner-region">
						{{ $summoner[0]->region }}
					</div>
					<div class="summoner-button">
						{{ $summoner[0]->likes }} 200 Likes
					</div>
					<div class="summoner-button">
						100 Comments
					</div>
				</div>
				<div class="col-md-6 summoner-profile-right">
					<div class="col-xs-3 col-md-6 summoner-data">
						<h6>Current League</h6>
						<p>{{ $summoner[0]->tier }} {{ $summoner[0]->division }}</p>
					</div>
					<div class="col-xs-3 col-md-6 summoner-data">
						<h6>Max League</h6>
						<p>{{ $summoner[0]->maxTier }} {{ $summoner[0]->maxDivision }}</p>
					</div>
					<div class="col-xs-3 col-md-6 summoner-data">
						<h6>Win / Loss</h6>
						<p>{{ $summoner[0]->wins }} / {{ $summoner[0]->losses }}</p>
					</div>
					<div class="col-xs-3 col-md-6 summoner-data">
						<h6>Popularity</h6>
						<p>{{ $summoner[0]->playerId }}</p>
					</div>
			    </div>
		</div>
	</div>
	<!--End Summoner Data-->

		<div class="container">
	@if($summoner[0])
		<div>
			<h2>Leave a comment</h2>
		</div>
		@if(Auth::guest())
			<a href="{{ route('users.login') }}">Login to Comment</a>
		@else
			<div class="panel-body">
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
		@endif
		</div>
		@if($comments)
			<ul style="list-style: none; padding: 0">
				@foreach($comments as $comment)
					@if($comment->parentId == NULL)
					<div class="container">
						<div class="row">
							<div class="col-md-8">
								<div id="comment_{{ $comment->id }}" class="panel comment-panel">
								  	<div class="panel-heading">
									    <span class="comment-username">{{ $comment->username }}</span>
									    <span class="text-default">{{ $comment->created_at }}</span>
									    @if(!Auth::guest())
											@if(Auth::user()->id == $comment->user_id)
											  		<a href="#" id="{{ $comment->id }}" class="glyphicon glyphicon-remove text-danger pull-right ajax-remove" style="font-size: 20px; text-decoration: none;"></a>
											@endif
										@endif
									</div>
									<div class="panel-body">
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
								    	<div>
								    		@if(!Auth::guest())
												<div class="panel-body">
													<form method="post" action="{{ route('comments.storeReply') }}">
														<input type="hidden" name="_token" value="{{ csrf_token() }}">
														<input type="hidden" name="commentId" value="{{ $comment->id }}">
														<input type="hidden" name="summonerId" value="{{ $summoner[0]->playerId }}">
														<input type="hidden" name="region" value="{{ $summoner[0]->region }}">
														<div class="form-group">
															<textarea required="required" placeholder="Enter comment here" name="body" class="form-control"></textarea>
														</div>
														<input type="submit" name='post_comment' class="btn btn-success" value="Post"/>
													</form>
												</div>
											@endif
								    	</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					@endif
				@endforeach
			</ul>
		@endif
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
		}
	</script>

@endsection