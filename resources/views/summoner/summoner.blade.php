@extends('template.submain')

@section('content')

	<!--Summoner Data-->
<!--End Summoner Data-->
	<div class="comment-grid">
		<div class="comment-tile stamped">
			<div class="summoner-tile">
				<div class="row">
					<div class="col-md-12">
							<!-- SIDEBAR USERPIC -->
							<img class="center-block" src="{{ $iconURL }}">
							<!-- SIDEBAR USER TITLE -->
							<div class="text-center summoner-name">
							<h2>{{ $summoner[0]->playerName }}</h2>
							</div>
							<!-- END SIDEBAR USER TITLE -->
							<!-- SIDEBAR BUTTONS -->
							<div class="summoner-likes-comments">
								<span>
										<span class="glyphicon glyphicon-comment"></span>
										{{ $summoner[0]->comments }}
								</span>
								<span>
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
								<p>1</p>
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
			</div>
			<div class="summoner-buttons">
					<button type="button" class="btn btn-default write-comment" data-toggle="modal" data-target="#writeModal"><span class="glyphicon glyphicon-pencil"></span> Say Something</button>
			</div>
		</div>
		@if($comments)
			@foreach($comments as $comment)
			@endforeach
		@else
		<div class="comment-tile">
			<h2 class="howsad">{{ $summoner[0]->playerName }} has no comments yet.</h2>
		</div>
		@endif
	</div>
	<a class="load-more-link append-button"><div class="load-more-comments">Load More</div></a>

<!-- Modal -->

<div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div id="commentModalBody" class="modal-body">
      </div>
      <div class="modal-footer">
    	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<form method="post" action="{{ route('comments.store') }}">
	<div class="modal fade" id="writeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-body">
					@if(!Auth::guest())
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="summonerId" value="{{ $summoner[0]->playerId }}">
							<input type="hidden" name="region" value="{{ $summoner[0]->region }}">
							<div class="form-group">
								<label>Write a comment</label>
								<input id="commentField" required="required" placeholder="Say something original..." name="body" class="form-control comment-form" onkeyup="countChar(this)"></input>
							</div>
							<div class="form-bottom">
								<div id="charNum">Characters left: 300</div>
							</div>
					@else
						<p class="text-center member-warning">You must be logged in to comment. If you are not a member, please leave, because this area is for members only.</p>
					@endif
	      </div>
	      <div class="modal-footer">
					<input type="submit" name='post_comment' class="btn btn-primary" value="Save"/>
	    		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>
</form>

@if($comments)
<script id="tplModal" type="text/x-handlebars-template">
	@{{#comment}}
		<div class="comment-header">
				<div><img class="img-responsive img-no-padding comment-profile-lg" src="{{ url('/') }}/{{ $comment->icon }}"></div>
				<div class="comment-username">@{{username}}</div>
				<div class="timestamp">@{{created_at}}</div>
		</div>
		<div class="modal-comment-body">@{{body}}</div>

		<div class="modal-reply-area">
			<form method="post" action="{{ route('comments.storeReply') }}">
				<div class="form-group">
					<label for="reply">Leave a reply:</label>
					<textarea class="form-control" rows="3" required="required" name="body" id="reply"></textarea>
				</div>
				<div class="form-bottom">
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<input type="hidden" name="commentId" value="@{{id}}">
										<input type="hidden" name="summonerId" value="{{ $summoner[0]->playerId }}">
										<input type="hidden" name="region" value="{{ $summoner[0]->region }}">
					<input type="submit" name='post_comment' class="btn btn-default" value="Save"/>
					<div id="charNum">Characters left: 300</div>
				</div>
			</form>
		</div>
		@{{#each replies}}
			<div class="modal-reply-header">
				<img class="img-responsive comment-profile-sm" src="@{{profileImage}}") />
				<div>@{{username}}</div>
			</div>
			<div class="modal-reply-body">@{{body}}</div>
		@{{/each}}
	@{{/comment}}
</script>

<script id="tplComments" type="text/x-handlebars-template">
	@{{#each comments}}
		<div class="comment-tile" style="width: @{{customWidth}}%">
			<div class="comment-panel">
				<div class="comment-header">
						<img class="img-responsive img-circle img-no-padding comment-profile-md" src="@{{profileImage}}">
						<div class="comment-username">@{{username}}</div>
						<div class="timestamp">@{{created_at}}</div>
				</div>
				<div class="comment-body">
					@{{body}}
				</div>

				<div class="comment-footer">
					<span class="comment-replies">
							<span class="glyphicon glyphicon-comment"></span>
							69
					</span>
					<span class="comment-likes">
							<span id="@{{id}}" class="glyphicon glyphicon-heart"></span>
							69
					</span>
				</div>

				<div class="comment-expand"><button class="btn btn-default btn-sm comment-expand-button" data-toggle="modal" data-target="#commentModal" onClick="openModal(@{{id}})">Open</button></div>

			</div>
		</div>
	@{{/each}}
</script>
@endif

<script>
var homeUrl = "{{ url('/') }}/";

Handlebars.registerHelper("customWidth", function(){
	var roundDown = Math.floor(window.innerWidth / 300);
	var percentWidth = Math.floor(1 / roundDown * 1000) / 10;
	return new Handlebars.SafeString(percentWidth);
});

var boomerang = function (url, tplId, anchor) {
	$.getJSON(url, function(data) {
		var template = $(tplId).html();
		var stone = Handlebars.compile(template)(data);
		$(anchor).html(stone);
	});
};

var openModal = function (commentId) {
	boomerang('{{ url('/') }}/comment/content/' + commentId, '#tplModal', '.modal-body');
};

var loadComments = function (region,summonerName) {
	boomerang('{{ url('/') }}/comment/' + region + '/' + summonerName, '#tplComments', '.comment-grid');
}

// loadComments("{{ $summoner[0]->region }}","{{ $summoner[0]->playerName }}")

// Comment Remove and Open Button

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
		$('#commentModalBody').load( commentsearch + id );
		return this;
	});

});

// Packery

$(function(){
	var gridWidth = function() {
	  var roundDown = Math.floor(window.innerWidth / 300);
	  var percentWidth = Math.floor(1 / roundDown * 1000) / 10;
	  $('.comment-tile').css({
	    'width': percentWidth + '%'
	  });
	}

	gridWidth();

	$(window).resize(function(){
		gridWidth();
	})

	var loadMore = function () {
		var url = "{{ url('/') }}/comment/" + "{{ $summoner[0]->region }}" + "/" + "{{ $summoner[0]->playerName }}"
		$.getJSON( url , function(data) {
			var template = $('#tplComments').html();
			var stone = Handlebars.compile(template)(data);
			var $items = $(stone);
			$('.comment-grid').append( $items )
			.packery( 'appended', $items ).packery();
		})
	}

	var loadFront = function () {
		var url = "{{ url('/') }}/comment/" + "{{ $summoner[0]->region }}" + "/" + "{{ $summoner[0]->playerName }}"
		$.getJSON( url , function(data) {
			var template = $('#tplComments').html();
			var stone = Handlebars.compile(template)(data);
			var $items = $(stone);
			$('.comment-grid').prepend( $items )
			.packery( 'prepended', $items ).packery();
		})
	}

	$('.append-button').on( 'click', function() {
		loadFront();
	});

	loadMore();
// append items to grid
	$(window).load(function(){
		$('.comment-grid').packery({
			itemSelector: '.comment-tile',
			gutter:0
		}).packery().packery( 'stamp', '.stamped')
	})
})

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
