@extends('template.submain')

@section('content')

	<!--Summoner Data-->

	<div class="row">
		<div class="col-md-12">
		</div>
	</div>
	<div class="row write-comment-box">
		@if(!Auth::guest())
		<div class="col-md-12 col-lg-8">
			<form method="post" action="{{ route('comments.store') }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="summonerId" value="{{ $summoner[0]->playerId }}">
				<input type="hidden" name="region" value="{{ $summoner[0]->region }}">
				<div class="form-group">
					<label>Write a comment</label>
					<textarea id="commentField" required="required" placeholder="Say something original..." name="body" class="form-control comment-form" onkeyup="countChar(this)"></textarea>
				</div>
				<div class="form-bottom">
					<input type="submit" name='post_comment' class="btn btn-default" value="Save"/>
					<div id="charNum">Characters left: 300</div>
				</div>
			</form>
		</div>
		@else
		<div class="col-md-12">
			<p class="text-center member-warning">You must be logged in to comment. If you are not a member, please leave, because this area is for members only.</p>
		</div>
		@endif
	</div>
<!--End Summoner Data-->
		<div class="grid-wrapper">
			<div class="comment-grid">
				<div class="comment-tile">
					<div class="summoner-tile">
						<div class="row">
							<div class="col-md-12">
									<!-- SIDEBAR USERPIC -->
									<img class="center-block" src="{{ $iconURL }}">
									<!-- END SIDEBAR USERPIC -->
									<!-- SIDEBAR USER TITLE -->
									<div class="text-center summoner-name">
									{{ $summoner[0]->playerName }}
									</div>
									<!-- END SIDEBAR USER TITLE -->
									<!-- SIDEBAR BUTTONS -->
									<div class="summoner-button-wrapper text-center">
										<span class="summoner-button">
												<span class="glyphicon glyphicon-comment"></span>
												{{ $summoner[0]->comments }}
										</span>
										<span class="summoner-button">
												<a href="#" class="glyphicon glyphicon-heart"></a>
												{{ $summoner[0]->likes }}
										</span>
									</div>
								</div>
						</div>

						<div class="row">
								<div class="col-xs-6 summoner-data">
										<h6>Region</h6>
										<p>{{ $summoner[0]->region }}</p>
								</div>
								<div class="col-xs-6 summoner-data">
										<h6>Popularity</h6>
										<p>{{ $summoner[0]->playerId }}</p>
								</div>
								<div class="col-xs-6 summoner-data">
										<h6>Current League</h6>
										<p>{{ $summoner[0]->tier }} {{ $summoner[0]->division }}</p>
								</div>
								<div class="col-xs-6 summoner-data">
										<h6>League Points</h6>
										<p>{{ $summoner[0]->leaguePoints }}</p>
								</div>
								<div class="col-xs-6 summoner-data">
										<h6>Max League</h6>
										<p>{{ $summoner[0]->maxTier }} {{ $summoner[0]->maxDivision }}</p>
								</div>
								<div class="col-xs-6 summoner-data">
										<h6>Win / Loss</h6>
										<p>{{ $summoner[0]->wins }} / {{ $summoner[0]->losses }}</p>
								</div>
						</div>
						<div class="summoner-buttons">
							<div>
								<button type="button" class="btn btn-default write-comment toggleButton" data-target=".write-comment-box"><span class="glyphicon glyphicon-pencil"></span> Say Something</button>
							</div>
						</div>
					</div>
				</div>
				@if($comments)
				@foreach($comments as $comment)
					@if($comment->parentId == NULL)
					<div class="comment-tile">
						<div id="comment_{{ $comment->id }}" class="comment-panel">
							    @if(!Auth::guest())
									@if(Auth::user()->id == $comment->user_id)
										<div class="comment-cog">
										<button class="clearbutton dropdown-toggle" type="button" id="dropdownmenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
											<div class="comment-cog">
									  		<span class="glyphicon glyphicon-cog"></span>
										</button>
										</div>
										<ul class="dropdown-menu dropdown-menu-right">
											<li><a href="#" id="{{ $comment->id }}" class="ajax-remove">Delete Comment</a></li>
										</ul>
									@endif
								@endif
							<div class="comment-header">
						  		<img class="img-responsive img-circle img-no-padding comment-profile-md" src="{{ url('/') }}/{{ $comment->icon }}">
									<div class="comment-username">{{ $comment->username }}</div>
									<div class="timestamp">{{ $comment->created_at }}</div>
							</div>

							<div class="comment-body">
					    	<p>{{ $comment->body }}</p>
					    </div>

							<div class="comment-footer">
								<span class="comment-replies">
										<span class="glyphicon glyphicon-comment"></span>
										{{ $comment->cntreplys }}
								</span>
								<span class="comment-likes">
										<a href="#" class="glyphicon glyphicon-heart"></a>
										{{ $summoner[0]->likes }}
								</span>
							</div>
<!--comment reply-->
			    		<div class="comment-expand"><a class="btn btn-sm comment-expand-button" data-toggle="modal" data-target="#myModal">Expand</a></div>

								@foreach($comment->replys as $commentReply)
									@if($commentReply->parentId == $comment->id)
										<div id="comment_{{ $commentReply->id }}" class="comment-reply">
											<div><img class="img-responsive img-circle img-no-padding comment-profile-sm" src="{{ url('/') }}/{{ $comment->icon }}"></div>
											<div class="reply-body">{{ $commentReply->body }}</div>
										</div>
									@endif
								@endforeach
								
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
					</div>
					@endif
				@endforeach
				@endif
			</div>
		</div>
	@if($comments)
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="comment-body">
						<div id="comment_{{ $comment->id }}">
							<div class="comment-header text-left">
						  		<div><img class="img-responsive img-no-padding comment-profile-md" src="{{ url('/') }}/{{ $comment->icon }}">
								</div>
								<div class="comment-title-wrapper">
									<div class="comment-username">{{ $comment->username }}</div>
									<div class="timestamp">{{ $comment->created_at }}</div>
							  </div>
							</div>
							<div class="modal-comment-body">
								<p>{{ $comment->body }}</p>
							</div>
							<div class="modal-reply-area">
								<form method="post" action="{{ route('comments.storeReply') }}">
									<div class="form-group">
										<label for="reply">Leave a reply:</label>
										<textarea class="form-control" rows="3" required="required" name="body" id="reply"></textarea>
									</div>
									<div class="form-bottom">
															<input type="hidden" name="_token" value="{{ csrf_token() }}">
															<input type="hidden" name="commentId" value="{{ $comment->id }}">
															<input type="hidden" name="summonerId" value="{{ $summoner[0]->playerId }}">
															<input type="hidden" name="region" value="{{ $summoner[0]->region }}">
										<input type="submit" name='post_comment' class="btn btn-default" value="Save"/>
										<div id="charNum">Characters left: 300</div>
									</div>
								</form>
							</div>
						</div>
		      </div>
		      <div class="modal-body">
						My first modal!
		      </div>
		      <div class="modal-footer">
					<button type="button" class="btn btn-warning" onclick="$('.modal-body').load('http://localhost/woodtier/public/comment/search/1');">Load Sample</button>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>
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

			$('.comment-reply-button').click(function(){
				var id = $(this).closest('.comment-panel').attr('id').slice(8);
				var commentsearch = "{{ url('/') }}/comment/search/";
				$('.modal-body').load( commentsearch + id );
				return this;
			});

		});

		$(function(){
			var gridWidth = function() {
			  var roundDown = Math.floor(window.innerWidth / 320);
			  var percentWidth = Math.floor(1 / roundDown * 1000) / 10;
			  $('.comment-tile').css({
			    'width': percentWidth + '%'
			  });
			}

			gridWidth();

			$(window).resize(function(){
				gridWidth();
			});

			$(window).load(function(){
				$('.comment-grid').packery({
					itemSelector: '.comment-tile',
					gutter:0
				}).packery();
			});
		});
/*
		$(function() {
			$('.make-reply-a').click(function(e){
				e.preventDefault();
				var id = $(this).attr("id");
				$('#'+id).css('display','none');
				$('#'+id+'_reply').css('display','inline');
			});
		});
*/
	</script>

@endsection
