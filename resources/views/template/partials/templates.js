<script id="tplModal" type="text/x-handlebars-template">
	{{#main}}
		<div class="comment-header">
				<div><img class="img-responsive img-no-padding comment-profile-md" src="{{ url('/') }}/{{ $comment->icon }}"></div>
				<div class="comment-title-wrapper">
				<div class="comment-username">Name #{{user_id}}</div>
				<div class="timestamp">{{created_at}}</div>
			</div>
		</div>
		<div>{{body}}</div>
	{{/main}}

	{{#each replys}}
		<div>{{body}}</div>
	{{/each}}

</script>
