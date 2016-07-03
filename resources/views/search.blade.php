<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="{{ asset('plugins\bootstrap\css\bootstrap.css')}}">
	<link rel="stylesheet" href="{{ asset('plugins\css\general.css')}}">
	<script src="{{ asset('plugins/jquery/js/jquery-2.1.4.js') }}"></script>
	<script src="{{ asset('plugins/bootstrap/js/bootstrap.js') }}"></script>
	<script type="text/javascript">
		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		})
	</script>
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="icon">
        <input type="text" id="search" placeholder="Search summoners"></div>
        <h4 id="results-text">Showing results for: <strong id="search-string">Array</strong></h4>
    <div id="search-results"></div>

	<form method="post" action="{{ route('executeSearch') }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="text" name="keywords" placeholder="Search summoners">
					<input type="submit" name='post_comment' class="btn btn-success" value="Post"/>
				</form>

    <script type="text/javascript">
	    $('div.icon').click(function(){
		    $('input#search').focus();
		});
		
    	$("input#search").live("keyup", function(e) {

		    // Set Search String
		    var search_string = $(this).val();

		    // Do Search
		    if(search_string !== ''){
		        $.ajax({
		            type: "POST",
		            url: "http://localhost/leaguefamous-html/public/executeSearch",
		            data: { keywords: search_string },
		            cache: false,
		            success: function(html){
		                $("ul#results").html(html);
		            }
		        });
		    }return false;
		});
    </script>
</body>
</html>