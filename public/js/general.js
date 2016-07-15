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

/* Croppie */

$(function(){
  var cropImageUrl = $('.cropImage').data("id");


  $uploadCrop = $('#uploadImage').croppie({
      enableExif: true,
      viewport: {
          width: 150,
          height: 150,
          type: 'circle'
      },
      boundary: {
          width: 300,
          height: 300
      }
  });
});

/* show hide */


$(function(){
 $('.toggleButton').click(function(){
   var toggleTarget = $(this).data('target');
   $(toggleTarget).slideToggle(100);
 });

});

/* region text changer */
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
