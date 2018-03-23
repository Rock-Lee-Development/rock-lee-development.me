// Get the modal
var modal = document.getElementById('myModale');

// Get the button that opens the modal
var btn = document.getElementById("register-submit");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

$(window).load(function () {
     var submit = false;
     $("#register-submit").submit(function(e) {
          setTimeout(function(){
              alert("me after 9000 mili seconds");
              submit = true;
              $("#register-submit").submit(); // if you want
          }, 9000);
          if(!submit)
              e.preventDefault();
     });
};
