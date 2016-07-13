	<link rel="stylesheet" href="{{ asset('plugins\bootstrap\css\bootstrap.css')}}">
	<link rel="stylesheet" href="{{ asset('plugins\css\general.css')}}">
	<link rel="stylesheet" href="{{ asset('plugins\css\demo.css')}}">
	<link rel="stylesheet" href="{{ asset('plugins\css\ct-paper.css')}}">
	<link href='https://fonts.googleapis.com/css?family=Dosis:400,300,200' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Ropa+Sans' rel='stylesheet' type='text/css'>
	<script src="{{ asset('plugins/jquery/js/jquery-2.1.4.js') }}"></script>
	<script src="{{ asset('plugins/bootstrap/js/bootstrap.js') }}"></script>
	<script src="{{ asset('plugins/jquery/js/bootstrap-datepicker.js') }}"></script>
	<script src="{{ asset('plugins/jquery/js/bootstrap-select.js') }}"></script>
	<script src="{{ asset('plugins/jquery/js/ct-paper.js') }}"></script>
	<script src="{{ asset('plugins/jquery/js/ct-paper-checkbox.js') }}"></script>
	<script src="{{ asset('plugins/jquery/js/ct-paper-radio.js') }}"></script>
	<script src="{{ asset('plugins/jquery/js/salvattore.min.js') }}"></script>

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