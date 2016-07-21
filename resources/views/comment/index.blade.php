

	@if($comment)
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
				<form method="post" action="{{ route('comments.store') }}">
					<div class="form-group">
						<label for="reply">Leave a reply:</label>
						<textarea class="form-control" rows="3" required="required" id="reply"></textarea>
					</div>
					<div class="form-bottom">
						<input type="submit" name='post_comment' class="btn btn-default" value="Save"/>
						<div id="charNum">Characters left: 300</div>
					</div>
				</form>
			</div>
			</div>
				@foreach($commentReplys as $commentReply)
					<div id="comment_{{ $commentReply->id }}" class="modal-reply-wrapper">
						<div class="modal-reply-header">
							<div><img class="img-responsive img-circle img-no-padding comment-profile-sm" src="{{ url('/') }}/{{ $comment->icon }}"></div>
							<div><span class="comment-username">{{ $commentReply->username }}</span> <span class="timestamp">&bull; {{ $commentReply->created_at }}</span></div>
						</div>
						<div class="modal-reply-body">{{ $commentReply->body }}</div>
					</div>
				@endforeach
		</div>
	@endif
