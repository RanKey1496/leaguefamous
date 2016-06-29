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
							<div class="panel panel-primary">
							  	<div class="panel-heading">
								    <strong>{{ $comment->username }}</strong> 
								    <span class="text-default">{{ $comment->created_at }}</span>
								    @if(!Auth::guest())
										@if(Auth::user()->id == $comment->user_id)
										  		<span class="glyphicon glyphicon-remove text-danger pull-right"></span>
										@endif
									@endif
								</div>
								<div class="panel-body">
							    	<p>{{ $comment->body }}</p>
							    		<div class="list-group">
								    		@foreach($comments as $commentReply)
								    			@if($commentReply->parentId == $comment->id)
								    				<div class="list-group-item">
								    					<strong>{{ $commentReply->username }}</strong> 
													    <span class="text-default">{{ $commentReply->created_at }}</span>
													    @if(!Auth::guest())
															@if(Auth::user()->id == $commentReply->user_id)
															  		<span class="glyphicon glyphicon-remove text-danger pull-right"></span>
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

@endsection