function countChar(val) {
  var len = val.value.length;
  var left = 300 - len;
  if (len >= 300) {
    val.value = val.value.substring(0, 300);
  } else {
    $('#charNum').text('Characters left: ' + left);
  }
};

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
