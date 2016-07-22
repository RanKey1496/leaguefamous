

	@if($comment)
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
