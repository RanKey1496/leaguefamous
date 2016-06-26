@extends('template.main')

@section('content')
	<!--Header-->
	<div class="container">
	  <div class="jumbotron">
	    <h1>League Famous</h1> 
	    <p>.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p> 
	  </div>

	<!--Search-->
	<div class="btn-group" role="group" aria-label="">
	  <button type="button" class="btn btn-primary">NA</button>
	  <button type="button" class="btn btn-default">EUW</button>
	  <button type="button" class="btn btn-default">EUNE</button>
	  <button type="button" class="btn btn-default">BR</button>
	  <button type="button" class="btn btn-default">TR</button>
	  <button type="button" class="btn btn-default">RU</button>
	  <button type="button" class="btn btn-default">LAN</button>
	  <button type="button" class="btn btn-default">LAS</button>
	  <button type="button" class="btn btn-default">OCE</button>
	  <button type="button" class="btn btn-default">KR</button>
	  <button type="button" class="btn btn-default">JP</button>
	</div>
	<hr/>
	<div class="row">
	  <div class="col-lg-6">
	    <div class="input-group">
	      <input type="text" class="form-control" placeholder="Search for...">
	      <span class="input-group-btn">
	        <button class="btn btn-default" type="button">Go!</button>
	      </span>
	    </div><!-- /input-group -->
	  </div><!-- /.col-lg-6 -->
	</div><!-- /.row -->
	<!--End Search-->

	</div>
	<hr/>
	<!--End Header-->

	<!--Lists-->
	<div class="table-responsive">
	  <table class="table table-hover">
	    <thead>
			<th>Imagen</th>
			<th>Region</th>
			<th>Tier</th>
			<th>Likes</th>
		</thead>
		<tbody>
			<tr class="table-row" data-href="http://efukt.com">
				<td>
					<a href="#" class="pull-left">
						<img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
					</a>
				</td>
				<td>
					<span class="media-meta pull-right">Febrero 13, 2016</span>
				</td>
				<td>
					<span class="media-meta pull-middle">Pagado</span>
				</td>
				<td>
					<p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
				</td>
				<td>
					<a href="javascript:;" class="star">
						<i class="glyphicon glyphicon-star"></i>
					</a>
				</td>
			</tr>

			<tr class="table-row" data-href="facebook.com">
				<td>
					<a href="#" class="pull-left">
						<img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
					</a>
				</td>
				<td>
					<span class="media-meta pull-right">Febrero 13, 2016</span>
				</td>
				<td>
					<span class="media-meta pull-middle">Pagado</span>
				</td>
				<td>
					<p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
				</td>
				<td>
					<a href="javascript:;" class="star">
						<i class="glyphicon glyphicon-star"></i>
					</a>
				</td>
			</tr>

			<tr class="table-row" data-href="google.com">
				<td>
					<a href="#" class="pull-left">
						<img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
					</a>
				</td>
				<td>
					<span class="media-meta pull-right">Febrero 13, 2016</span>
				</td>
				<td>
					<span class="media-meta pull-middle">Pagado</span>
				</td>
				<td>
					<p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
				</td>
				<td>
					<a href="javascript:;" class="star">
						<i class="glyphicon glyphicon-star"></i>
					</a>
				</td>
			</tr>
		</tbody>
	  </table>
	</div>

	<script type="text/javascript">
		$(document).ready(function($) {
			$(".table-row").click(function() {
				window.document.location = $(this).data("href");
			});
		});
	</script>

	<style type="text/css">
		.table-row{
		cursor:pointer;
		}
	</style>
	<!--End Lists-->
@endsection