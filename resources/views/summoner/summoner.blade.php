@extends('template.submain')

@section('content')

	<!--Summoner Data-->
	<div class="row">
		<div class="col-md-12">
			<div class="comment-section-header text-center">
				<div class="write-comment">
					<button class="btn"><span class="glyphicon glyphicon-pencil"></span></button>
				</div>
					<ul class="nav nav-pills nav-pills-center" role="tablist">
	  					<li role="presentation" class="active"><a href="#">Recent</a></li>
	  				    <li role="presentation"><a href="#">Popular</a></li>
					</ul>	
				
				<div class="logged-in">
					<a href="#"><img class="img-responsive img-circle img-no-padding user-profile-pic" src="{{ $iconURL }}"></a>
				</div>
			</div>
		</div>
	</div>
<!--End Summoner Data-->
	<div class="row">
		@if($comments)
			<div class="comment-grid">
				@foreach($comments as $comment)
					@if($comment->parentId == NULL)
					<div class="col-sm-6 col-md-4 col-lg-3 comment-tile">
						<div id="comment_{{ $comment->id }}" class="comment-panel">
							<div class="row">
								<div class="col-md-12 comment-header text-center">
									<div class="comment-cog">
										    @if(!Auth::guest())
												@if(Auth::user()->id == $comment->user_id)
												  		<a href="#" id="{{ $comment->id }}" class="glyphicon glyphicon-cog ajax-remove"></a>
												@endif
											@endif
									</div>
							  		<div><img class="img-responsive img-circle img-no-padding comment-profile-md" style="width:56px; height: 56px; margin-right:20px;" src="{{ url('/') }}/{{ $comment->icon }}">
									</div>
									<div class="comment-title-wrapper">
								    	<span class="comment-username">{{ $comment->username }}</span>
								    	<br>
								    	<span>{{ $comment->created_at }}</span>
								    </div>
								</div>

								<div class="col-md-12">
							    	<p>{{ $comment->body }}</p>
						    		<div class="list-group">
							    		@foreach($comments as $commentReply)
							    			@if($commentReply->parentId == $comment->id)
							    				<div id="comment_{{ $commentReply->id }}" class="list-group-item">
							    					<strong>{{ $commentReply->username }}</strong> 
												    <span class="text-default">{{ $commentReply->created_at }}</span>
												    @if(!Auth::guest())
														@if(Auth::user()->id == $commentReply->user_id)
														  		<a href="#" id="{{ $commentReply->id }}" class="glyphicon glyphicon-remove text-danger pull-right ajax-remove" style="font-size: 20px; text-decoration: none;"></a>
														@endif
													@endif
													<p>{{ $commentReply->body }}</p>
							    				</div>
							    			@endif
							    		@endforeach
							    	</div>
							    </div>
<!--comment reply-->
					    		@if(!Auth::guest())
					    		<div class="col-md-12">
					    			<a href="" id="make_{{ $comment->id }}" class="make-reply-a">Reply</a>
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
								@endif
							</div>
						</div>
					</div>
					@endif
				@endforeach
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
		});

		$(function(){
			$('.make-reply-a').click(function(e){
				e.preventDefault();
				var id = $(this).attr("id");
				$('#'+id).css('display','none');
				$('#'+id+'_reply').css('display','inline');
			});
		});

		// init Masonry
		var $grid = $('.comment-grid').masonry({
		  // options...
		});
		// layout Masonry after each image loads
		$grid.imagesLoaded().progress( function() {
		  $grid.masonry('layout');
		});
		$('.comment-grid').masonry({
  			itemSelector: '.comment-tile',
  			columnWidth: 1,
		});


		switch("{{ $summoner[0]->region }}") {
			case "na":
				document.getElementById("region").innerHTML = "North America";
				break;
			case "lan":
				document.getElementById("region").innerHTML = "Latin America North";
				break;
			case "las":
				document.getElementById("region").innerHTML = "Latin America South";
				break;
			case "br":
				document.getElementById("region").innerHTML = "Brazil";
				break;
			case "euw":
				document.getElementById("region").innerHTML = "Europe West";
				break;
			case "eune":
				document.getElementById("region").innerHTML = "Europe Nordic & East";
				break;
			case "ru":
				document.getElementById("region").innerHTML = "Russia";
				break;
			case "tr":
				document.getElementById("region").innerHTML = "Turkey";
				break;
			case "kr":
				document.getElementById("region").innerHTML = "South Korea";
				break;
			case "oce":
				document.getElementById("region").innerHTML = "Oceania";
				break;
			case "jp":
				document.getElementById("region").innerHTML = "Japan";
				break;
			default:
				document.getElementById("region").innerHTML = "{{ $summoner[0]->region }}";
		};
	</script>

@endsection