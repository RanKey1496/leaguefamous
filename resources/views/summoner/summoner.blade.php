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
				<input type="submit" name='post_comment' class="btn btn-success" value="Post"/>
				<div id="charNum">Characters left: 300</div>
			</form>
		</div>
		@else
		<div class="col-md-12">
			<p class="text-center">You must be logged in to comment. If you are not a member, please leave, because this area is for members only.</p>
		</div>
		@endif
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="comment-section-header text-center">
				<div>
					<button type="button" class="btn write-comment toggleButton" data-target=".write-comment-box"><span class="glyphicon glyphicon-pencil"></span></button>
				</div>
					<ul class="nav nav-pills nav-pills-center" role="tablist">
	  					<li role="presentation" class="active"><a href="#">Recent</a></li>
	  				    <li role="presentation"><a href="#">Popular</a></li>
					</ul>

				@if(!Auth::guest())
                    <div class="logged-in dropdown">
                        <button class="clearbutton dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
													<span class="collapse-text">{{Auth::user()->username}}</span>
													<img class="img-responsive img-no-padding user-profile-pic" src="{{ url('/') }}/{{Auth::user()->profileImage}}">
												</button>
                    	<ul class="dropdown-menu dropdown-menu-right">
				            		<li><a href="{{route('users.settings')}}">Settings</a></li>
				            		<li><a href="{{route('users.edit.profile')}}">Change my avatar</a></li>
				            		<li><a href="{{route('users.edit.password')}}">Change my password</a></li>
				            		<li role="separator" class="divider"></li>
				         				<li><a href="{{route('users.logout')}}">Logout</a></li>
			            		</ul>
                    </div>
                @else
								<div class="nav-not-logged-in dropdown">
			            <button class="clearbutton dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
			              Login <span class="caret"></span>
			            </button>
			            <ul id="login-dp" class="dropdown-menu dropdown-menu-right">
			              <li>
			                 <div class="row">
			                    <div class="col-md-12">
			                       {!! Form::open(['route' => 'users.login', 'method' => 'POST', 'id' =>  'login-nav']) !!}

			                        <div class="form-group">
			                            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Enter E-mail','required']) !!}
			                        </div>

			                        <div class="form-group">
			                            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Enter Password','required']) !!}
			                            <div class="help-block text-right"><a href="{{route('users.password.email')}}">Forget the password?</a></div>
			                        </div>

			                        <div class="form-group">
			                            {!! Form::submit('Sign in', ['class' => 'btn btn-primary btn-block']) !!}
			                        </div>
			                      {!! Form::close() !!}
			                    </div>
			                 </div>
			                 <div class="row">
			                   <div class="col-md-12 text-center">
			                     <a href="{{route('users.register')}}">Register New User</a>
			                   </div>
			                 </div>
			              </li>
			            </ul>
			          </div>
                @endif
			</div>
		</div>
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
								</div>

								<div class="comment-body">
							    	<p>{{ $comment->body }}</p>
						    		<div class="">
							    		@foreach($comments as $commentReply)
							    			@if($commentReply->parentId == $comment->id)
							    				<div id="comment_{{ $commentReply->id }}" class="comment-reply">
							    					<div><img class="img-responsive img-circle img-no-padding comment-profile-sm" src="{{ url('/') }}/{{ $comment->icon }}"></div>
							    					<div><span class="comment-username">{{ $commentReply->username }}</span> <span class="timestamp">&bull; {{ $commentReply->created_at }}</span></div>
												    @if(!Auth::guest())
														@if(Auth::user()->id == $commentReply->user_id)
														  		<a href="#" id="{{ $commentReply->id }}" class="glyphicon glyphicon-remove text-danger pull-right ajax-remove" style="font-size: 20px; text-decoration: none;"></a>
														@endif
													@endif
													<div class="reply-body">{{ $commentReply->body }}</div>
							    				</div>
							    			@endif
							    		@endforeach
							    	</div>
							    </div>
<!--comment reply-->
					    		@if(!Auth::guest())
					    			<a class="btn btn-xs comment-reply-button" data-toggle="modal" data-target="#myModal">Reply</a>
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
								@endif
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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.

        Indeed, i was accounting for a couple, where usually just 1 works. which is mainly the situation for a great part of them. When i'm short in money i can eat daily on a excessively unhealthy diet which goes for $5-6 a day, and that's just for me, just the food, no soda, just water, and I have a motorcycle to ride where they sell the cheap food. Rent around here for a single person goes for $75-100 with private bathroom. You can get them cheaper but then again i wouldn't recommend those areas.

        Indeed, i was accounting for a couple, where usually just 1 works. which is mainly the situation for a great part of them. When i'm short in money i can eat daily on a excessively unhealthy diet which goes for $5-6 a day, and that's just for me, just the food, no soda, just water, and I have a motorcycle to ride where they sell the cheap food. Rent around here for a single person goes for $75-100 with private bathroom. You can get them cheaper but then again i wouldn't recommend those areas.

        Indeed, i was accounting for a couple, where usually just 1 works. which is mainly the situation for a great part of them. When i'm short in money i can eat daily on a excessively unhealthy diet which goes for $5-6 a day, and that's just for me, just the food, no soda, just water, and I have a motorcycle to ride where they sell the cheap food. Rent around here for a single person goes for $75-100 with private bathroom. You can get them cheaper but then again i wouldn't recommend those areas.

        Indeed, i was accounting for a couple, where usually just 1 works. which is mainly the situation for a great part of them. When i'm short in money i can eat daily on a excessively unhealthy diet which goes for $5-6 a day, and that's just for me, just the food, no soda, just water, and I have a motorcycle to ride where they sell the cheap food. Rent around here for a single person goes for $75-100 with private bathroom. You can get them cheaper but then again i wouldn't recommend those areas.
      </div>
      <div class="modal-footer">
        <div class="left-side">
            <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Never mind</button>
        </div>
        <div class="divider"></div>
        <div class="right-side">
            <button type="button" class="btn btn-danger btn-simple">Delete</button>
        </div>
      </div>
    </div>
  </div>
</div>

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

		$(function() {
			$('.make-reply-a').click(function(e){
				e.preventDefault();
				var id = $(this).attr("id");
				$('#'+id).css('display','none');
				$('#'+id+'_reply').css('display','inline');
			});
		});

	</script>

@endsection
