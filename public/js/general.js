/* Character counter */

function countChar(val) {
  var len = val.value.length;
  var left = 300 - len;
  if (len >= 300) {
    val.value = val.value.substring(0, 300);
  } else {
    $('#charNum').text('Characters left: ' + left);
  }
};

/* underbox */



$(document).ready(function() {
/*
   $('#underbox').click(function(e) {
        $('#hide-underbox').toggle();
        e.stopPropagation();
   });

   $(document.body).click(function() {
        $('#underbox').slideUp();
   });

   $('#underbox').click(function(e) {
        e.stopPropagation();
   });
   */
});
// Search Region Selector
  $(function(){
    var region = "na";
    $(".dropdown-menu li a").click(function(){
      $(this).parents(".dropdown").find('.btn').html($(this).text() + ' <span class="caret"></span>');
      $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
      region = $(this).text().toLowerCase();
    });

    document.getElementById('frmSearch').onsubmit = function() {
      window.location = '{{ url('/') }}/' + region + '/' + document.getElementById('txtSearch').value;
      return false;
    }
  });
/* navbar shadow on scroll */

$(window).scroll(function() {
    var scroll = $(window).scrollTop();
    if (scroll > 0) {
        $("#flexnav").addClass("active");
    }
    else {
        $("#flexnav").removeClass("active");
    }
});

/* show hide */

$(function(){
 $('.toggleButton').click(function(){
   var toggleTarget = $(this).data('target');
   $(toggleTarget).slideToggle(200);
 });

});

/* region text changer */
/*
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
*/
