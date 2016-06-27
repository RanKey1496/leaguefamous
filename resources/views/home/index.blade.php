@extends('template.main')

@section('content')
	<!--Header-->
	<div class="container">
	  <div class="jumbotron">
	    <h1>Welcome</h1> 
	    <p>.Wombats are short-legged, muscular quadrupedal marsupials that are native to Australia. They are about 1 m (40 in) in length with small, stubby tails. There are three extant species and they are all members of the family Vombatidae. They are adaptable and habitat tolerant, and are found in forested, mountainous, and heathland areas of south-eastern Australia, including Tasmania, as well as an isolated patch of about 300 ha (740 acres) in Epping Forest National Park[2] in central Queensland.</p> 
	  </div>

	<!--Search-->
	<div class="dropdown pull-right">
	  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
	    North America
	    <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
	    <li><a href="#">North America</a></li>
	    <li><a href="#">Latin America North</a></li>
	    <li><a href="#">Latin America South</a></li>
	    <li><a href="#">Brazil</a></li>
	    <li role="separator" class="divider"></li>
	    <li><a href="#">Europe West</a></li>
	    <li><a href="#">Europe Nordic &amp; East</a></li>
	    <li><a href="#">Russia</a></li>
	    <li><a href="#">Turkey</a></li>
	    <li role="separator" class="divider"></li>
	    <li><a href="#">South Korea</a></li>
	    <li><a href="#">Oceania</a></li>
	    <li role="separator" class="divider"></li>
	    <li><a href="#">All</a></li>
	  </ul>
	</div>
	<div class="row">
	  <div class="col-md-4">
	    <div class="input-group">
	      <input type="text" class="form-control" placeholder="Search summoners...">
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