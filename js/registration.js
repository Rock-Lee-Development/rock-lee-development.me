
$('#register-submit').on('click', function validatemyForm() {
      var x = document.forms["myForm"]["newEmail"].value;
      var atpos = x.indexOf("@lindenwood");
      var dotpos = x.lastIndexOf(".edu");
      if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
          alert("must be a valid lindenwood email motherfucka!!");
          return false;
      }
  });
