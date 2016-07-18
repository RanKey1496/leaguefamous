

	@if($comment)
	<div class="comment-tile">
	<div id="comment_{{ $comment->id }}" class="comment-panel">
	<div class="comment-header text-left">
  		<div><img class="img-responsive img-circle img-no-padding comment-profile-md" src="{{ url('/') }}/{{ $comment->icon }}">
		</div>
		<div class="comment-title-wrapper"><span class="comment-username">{{ $comment->username }}</span> <span class="timestamp">&bull; {{ $comment->created_at }}</span>

	    </div>
	</div>
	<div class="comment-body">
		<p>{{ $comment->body }}</p>
		@foreach($commentReplys as $commentReply)
			<div id="comment_{{ $commentReply->id }}" class="comment-reply">
				<div><img class="img-responsive img-circle img-no-padding comment-profile-sm" src="{{ url('/') }}/{{ $comment->icon }}"></div>
				<div><span class="comment-username">{{ $commentReply->username }}</span> <span class="timestamp">&bull; {{ $commentReply->created_at }}</span></div>
				<div class="reply-body">{{ $commentReply->body }}</div>
			</div>
		@endforeach
	</div>
	</div>
	</div>
	@endif
