@extends('template.submain')

@section('content')

	<!--Summoner Data-->
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
	<div class="comment-grid">
		<div class="comment-tile">
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
					<button type="button" class="btn btn-default write-comment toggleButton" data-target=".write-comment-box"><span class="glyphicon glyphicon-pencil"></span> Say Something</button>
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
				    	{{ $comment->body }}
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

						@foreach($comment->replys as $commentReply)
							@if($commentReply->parentId == $comment->id)
								<div id="comment_{{ $commentReply->id }}" class="comment-reply">
									<div><img class="img-responsive img-circle img-no-padding comment-profile-sm" src="{{ url('/') }}/{{ $comment->icon }}"></div>
									<div class="reply-body">{{ $commentReply->body }}</div>
								</div>
							@endif
						@endforeach

		    		<div class="comment-expand"><button class="btn btn-default btn-sm comment-expand-button" data-toggle="modal" data-target="#myModal" onClick="openModal({{ $comment->id }})">Open</button></div>

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
		@else
		<div class="comment-tile">
			<h2 class="howsad">{{ $summoner[0]->playerName }} has no comments yet.</h2>
		</div>
		@endif
	</div>
	<a class="load-more-link append-button"><div class="load-more-comments">Load More</div></a>

<!-- Modal -->

	@if($comments)
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg">
	    <div class="modal-content">
	      <div class="modal-body">
					<div id="comment_{{ $comment->id }}">
						<div class="comment-header">
					  		<div><img class="img-responsive img-no-padding comment-profile-md" src="{{ url('/') }}/{{ $comment->icon }}"></div>
								<div class="comment-title-wrapper">
								<div class="comment-username">{{ $comment->username }}</div>
								<div class="timestamp">{{ $comment->created_at }}</div>
						  </div>
						</div>
						<div class="modal-comment-body">
							{{ $comment->body }}
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
	      <div class="modal-footer">
	    	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>
	@endif

	<script>

	var homeUrl = "{{ url('/') }}/";

	</script>

@if($comments)
	<script id="tplModal" type="text/x-handlebars-template">
		@{{#comment}}
			<div class="comment-header">
					<div><img class="img-responsive img-no-padding comment-profile-md" src="{{ url('/') }}/{{ $comment->icon }}"></div>
					<div class="comment-username">@{{username}}</div>
					<div class="timestamp">@{{created_at}}</div>
			</div>
			<div class="modal-comment-body">@{{body}}</div>

			@{{#each replies}}
				<div>
					<img class="img-responsive comment-profile-sm" src="@{{profileImage}}") />
					<div>@{{body}}</div>
				</div>
			@{{/each}}
		@{{/comment}}
	</script>

	<script id="tplComments2" type="text/x-handlebars-template">
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
				</div>
			</div>
		@{{/each}}
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
				</div>
			</div>
		@{{/each}}
	</script>
@endif

	<script>
/*	var boomerang = function (url, tplId, anchor) {
		$.getJSON(url, function(data) {
			var template = $(tplId).html();
			var stone = Handlebars.compile(template)(data);
			$(anchor).html(stone);
		});
	};
*/

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

/* Comment Remove and Open Button */

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

		/* Packery */

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

			$('.append-button').on( 'click', function() {

				var url = "{{ url('/') }}/comment/" + "{{ $summoner[0]->region }}" + "/" + "{{ $summoner[0]->playerName }}"

				$.getJSON( url , function(data) {
					var template = $('#tplComments').html();
					var stone = Handlebars.compile(template)(data);
					var $items = $(stone);
				  $('.comment-grid').append( $items )
					.packery( 'appended', $items );
					})
				});

			$(window).scroll( function() {

				var url = "{{ url('/') }}/comment/" + "{{ $summoner[0]->region }}" + "/" + "{{ $summoner[0]->playerName }}"
				if($(window).scrollTop() == $(document).height() - $(window).height()) {
					$.getJSON( url , function(data) {
						var template = $('#tplComments').html();
						var stone = Handlebars.compile(template)(data);
						var $items = $(stone);
					  $('.comment-grid').append( $items )
						.packery( 'appended', $items );
						})
					}
			});

			  // append items to grid

			$(window).load(function(){
				$('.comment-grid').packery({
					itemSelector: '.comment-tile',
					gutter:0
				}).packery()
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
