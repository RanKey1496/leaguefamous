  function countChar(val) {
    var len = val.value.length;
    var left = 300 - len;
    if (len >= 300) {
      val.value = val.value.substring(0, 300);
    } else {
      $('#charNum').text('Characters left: ' + left);
    }
  };
