<?php
if($_POST['resPassword'] != $_POST['confirm_password']){
$error_message = 'Passwords should be same<br>';
}

if(!isset($message)) {
	require_once("DBController.php");
	$db_handle = new DBController();
	$id = $_GET['UserID'];
	$token = $_GET['Token'];
	$query1 = "SELECT * FROM UserToken WHERE UserID='$id' AND Token = '$token'";
	$count = $db_handle->numRows($query1);
	if($count>0) {
    $token = generateNewString();
    $newPassword = $_POST("resPassword");
    $newPasswordEncrypted = password_hash($newPassword, PASSWORD_BCRYPT);
    $query2 = "UPDATE User set PasswordHashs = '$newPasswordEncrypted' WHERE UserID='" . $_GET["UserID"]. "'";
    $query3 = "UPDATE UserToken set Token = '$token' WHERE UserID='" . $_GET["UserID"]. "'";
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
?>

<html>
<head>
  <link href="css/style.css" type="text/css" rel="stylesheet" />
  </head>
  <body>
		<form id="register-form" action="" method="post" role="form" style="display: none;">
			<h2>REGISTER</h2>

				<div class="form-group">
					 <div class="row">
					<div class="col">
					 <input type="text" name="firstName" id="firstName" tabindex="1" class="form-control" placeholder="First Name" value="<?php if(isset($_POST['firstName'])) echo $_POST['firstName']; ?>">
					</div>
					<div class="col">
					 <input type="text" name="lastName" id="lastName" tabindex="1" class="form-control" placeholder="Last Name" value="<?php if(isset($_POST['lastName'])) echo $_POST['lastName']; ?>">
					</div>
				</div>
			</div>
				<div class="form-group">
					<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/index.js"></script>
    <script src="js/resetpassword.js.js"></script>
  </body>
</html>
