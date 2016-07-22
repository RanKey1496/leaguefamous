@extends('template.submain')

@section('content')

	<!--Summoner Data-->

	<div class="row">
		<div class="col-md-12">
			<div class="comment-section-header">
				<div>
					<button type="button" class="btn write-comment toggleButton" data-target=".write-comment-box"><span class="glyphicon glyphicon-pencil"></span></button>
				</div>
			</div>
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
			<p class="text-center">You must be logged in to comment. If you are not a member, please leave, because this area is for members only.</p>
		</div>
		@endif
	</div>
<!--End Summoner Data-->
		@if($comments)
		<div class="grid-wrapper">
			<div id="grid" data-columns>
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
								<div class="comment-header text-left">
							  		<div><img class="img-responsive img-circle img-no-padding comment-profile-md" src="{{ url('/') }}/{{ $comment->icon }}">
									</div>
									<div class="comment-title-wrapper"><span class="comment-username">{{ $comment->username }}</span> <span class="timestamp">&bull; {{ $comment->created_at }}</span>
								    </div>
								    <span>Este comentario tiene tu ano y {{ $comment->cntreplys }} replys</span>
								</div>

								<div class="comment-body">
							    	<p>{{ $comment->body }}</p>
						    		<div class="">
							    		@foreach($comment->replys as $commentReply)
							    			@if($commentReply->parentId == $comment->id)
							    				<div id="comment_{{ $commentReply->id }}" class="comment-reply">
							    					<div><img class="img-responsive img-circle img-no-padding comment-profile-sm" src="{{ url('/') }}/{{ $comment->icon }}"></div>
													<div class="reply-body">{{ $commentReply->body }}</div>
							    				</div>
							    			@endif
							    		@endforeach
							    	</div>
							    </div>
<!--comment reply-->
					    		<a class="btn btn-xs comment-reply-button" data-toggle="modal" data-target="#myModal">Expand</a>
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
			</div>
		</div>
		@endif
	<div class-"row">
		<div class="col-md-12" style="margin-top:50px">
		</div>
	</div>
	@if($comments)
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title" id="myModalLabel">Replies (0) !!FIX!!</h4>
		      </div>
		      <div class="comment-body">
				<div id="comment_{{ $comment->id }}">
					<div class="comment-header text-left">
				  		<div><img class="img-responsive img-no-padding comment-profile-md" src="{{ url('/') }}/{{ $comment->icon }}">
						</div>
						<div class="comment-title-wrapper"><span class="comment-username">{{ $comment->username }}</span> <span class="timestamp">&bull; {{ $comment->created_at }}</span>
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
