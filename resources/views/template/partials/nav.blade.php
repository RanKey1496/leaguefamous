<div id="flexnav">
  <a href="{{route('home')}}" id="flexnav-brand">
		<div class="text-center">
      B
    </div>
  </a>
		<form id="frmSearch" method="GET" action="" class="nav-search-form">
      <span class="glyphicon glyphicon-search search-icon"></span>
			<input id="txtSearch" type="text" class="form-control nav-search-input" aria-label="..." placeholder="Find summoners...">
			<div class="dropdown nav-region-menu">
				<button class="btn btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
				NA
				<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
					<li><a href="#">NA</a></li>
					<li><a href="#">LAN</a></li>
					<li><a href="#">LAS</a></li>
					<li><a href="#">BR</a></li>
					<li role="separator" class="divider"></li>
					<li><a href="#">EUW</a></li>
					<li><a href="#">EUNE</a></li>
					<li><a href="#">RU</a></li>
					<li><a href="#">TR</a></li>
					<li role="separator" class="divider"></li>
					<li><a href="#">KR</a></li>
					<li><a href="#">OCE</a></li>
				</ul>
			</div>
			<input id="search-submit" type="submit" value="Search">
		</form>
	<div class="flexgrower">
	</div>
	<div class="">
	</div>
	<div>
  	@include('template.partials.loginmenu')
	</div>
</div>

<div class="nav-spacer"></div>

<!-- unberbox -->

<div id="underbox"> Hello
</div>

<!-- end underbox -->

<!--Search-->

<div class="section">
	<div class="container">
		<div class="search-wrapper">
			<form id="frmSearch" method="GET" action="">
				<input id="txtSearch" type="text" class="form-control summoner-search" aria-label="..." placeholder="Find summoners...">
				<div class="dropdown region-menu">
					<button class="btn btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					NA
					<span class="caret"></span>
					</button>
					<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
						<li><a href="#">NA</a></li>
						<li><a href="#">LAN</a></li>
						<li><a href="#">LAS</a></li>
						<li><a href="#">BR</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="#">EUW</a></li>
						<li><a href="#">EUNE</a></li>
						<li><a href="#">RU</a></li>
						<li><a href="#">TR</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="#">KR</a></li>
						<li><a href="#">OCE</a></li>
					</ul>
				</div>
			</form>
		</div>
	</div class="container">
</div>
</div>

<script type="text/javascript">

	  $(document).ready(function() {
	    $('.underbox-show').click(function(){
	      var id = $(this).attr('data');
	      var underboxUrl = "{{ url('/') }}/user/";
	      $('#underbox').load( underboxUrl + id );
	      $('#underbox').show();
	      return this;
	    });
	  });

</script>

<!-- end search -->
