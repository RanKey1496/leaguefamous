@extends('template.main')

@section('content')

	<!--Summoner Data-->
	<div class="container">
	    <div class="row">
	        <div class="col-md-2">
		<img class="img-rounded" src="{{ 
			$iconURL }}">
			</div>
			<div class="col-md-5">
		<p>{{ $summoner[0]->playerId }}</p>
		<p>{{ $summoner[0]->playerName }}</p>
		<p>{{ $summoner[0]->region }}</p>
			</div>
			<div class="col-md-5">
		<p>{{ $summoner[0]->tier }} {{ $summoner[0]->division }} - {{ $summoner[0]->leaguePoints }} LP</p>
		<p>Max Rank - {{ $summoner[0]->maxTier }} {{ $summoner[0]->maxDivision }}</p>
		<p>{{ $summoner[0]->wins }}/{{ $summoner[0]->losses }}</p>
		    </div>
		    <div class="col-md-12">
		<p>{{ $summoner[0]->likes }} 200 Likes</p>
		<p>100 Comments</p>

			</div>
		</div>
	</div>
	<!--End Summoner Data-->

		
	@if($summoner[0])
		<div>
			{!! $summoner[0]->playerName !!}
		</div>    
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
		<hr/>
		<div>
			@if($comments)
				<ul style="list-style: none; padding: 0">
					@foreach($comments as $comment)
						@if($comment->parentId == NULL)
							<div id="comment_{{ $comment->id }}" class="panel panel-primary">
							  	<div class="panel-heading">
								    <strong>{{ $comment->username }}</strong> 
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
						@endif
					@endforeach
				</ul>
    		@endif
		</div>
	@else
		404 error
	@endif
<p>{{ $summoner[0]->leagueName }}</p>
		<p>{{ $summoner[0]->queue }}</p>
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
	</script>

@endsection