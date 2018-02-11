$(document).ready(function() {
    $('#login-form-link').click(function(e) {
    	$("#login-form").toggle(900).fadeIn(300);
 		$("#register-form").fadeOut(300);
		$('#register-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
	$('#register-form-link').click(function(e) {
		$("#register-form").toggle(900).fadeIn(400);
 		$("#login-form").fadeOut(400);
		$('#login-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});

});
