<?php
session_start();
$id = $_SESSION["UserID"];
$token = $_SESSION["Token"];
if((!empty($id)) && (!empty($token))) {
if(!empty($_POST["register-user"])) {
	/* Form Required Field Validation */
	foreach($_POST as $key=>$value) {
		if(empty($_POST[$key])) {
		$error_message = "All Fields are required";
		break;
		}
	}
	/* Password Matching Validation */
if($_POST['resPassword'] != $_POST['confirm_password']){
$error_message = 'Passwords should be same<br>';
}


if(!isset($message)) {
	require_once("DBController.php");
	$db_handle = new DBController();

	$query1 = "SELECT * FROM UserToken WHERE UserID='$id' AND Token = '$token'";
	$count = $db_handle->numRows($query1);
	if($count>0) {

    $token = $db_handle->generateNewString();
    $newPassword = $_POST["resPassword"];
    $newPasswordEncrypted = password_hash($newPassword, PASSWORD_BCRYPT);
    $query2 = "UPDATE User set PasswordHash = '$newPasswordEncrypted' WHERE UserID='$id'";
    $query3 = "UPDATE UserToken set Token = '$token' WHERE UserID='$id'";
	  $result2 = $db_handle->updateQuery($query2);
    $result3 = $db_handle->updateQuery($query3);
		if((!empty($result2)) && (!empty($result3))) {
			echo "<script> alert('your account is activate');
	    window.location.href='../index.html'; </script>";
		} else {
			echo "<script> alert('problem registration');
			window.location.href='../index.html'; </script>";
		}
	}
}
}
}else{
  echo "<script> alert('link has expired');
  window.location.href='../scscs.html'; </script>";
}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
   <meta charset="utf-8">
   <title>Login</title>
   <meta content="width=device-width, initial-scale=1.0" name="viewport">
   <meta content="" name="keywords">
   <meta content="" name="description">
 <!--<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">-->
 <link href="../css/bootstrap-grid.css" rel="stylesheet">
 <link href="../css/bootstrap-grid.min.css" rel="stylesheet">
 <link href="../css/bootstrap-reboot.css" rel="stylesheet">
 <link href="../css/bootstrap-reboot.min.css" rel="stylesheet">
 <link href="../css/bootstrap.css" rel="stylesheet">
 <link href="../css/bootstrap.min.css" rel="stylesheet">
 <link href="../css/style.css" rel="stylesheet">
 <link href="../css/Footer-with-button-logo.css" rel="stylesheet">

 </head>

 <body>
 <div class="container">
   <div class ="row justify-content-center">
 		<form id="register-form" action="" method="post" role="form" >
 			<h2>REGISTER</h2>


 				<div class="form-group">
 					<input type="password" name="resPassword" id="password" tabindex="2" class="form-control" placeholder="Password">
 				</div>
 				<div class="form-group">
 					<input type="password" name="confirm_password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
 				</div>
 				<div class="form-group">
 					<div class="row">
 						<div class="col-sm-6 col-sm-offset-3">
 							<input type="submit" name="register-user" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
 						</div>
 					</div>
 				</div>

 		</form>
 	</div>
 </div>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
     <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
     <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
     <script src="../js/bootstrap.js"></script>
     <script src="../js/bootstrap.min.js"></script>
     <script src="../js/index.js"></script>
     <script src="../js/resetpassword.js.js"></script>
   </body>
 </html>
