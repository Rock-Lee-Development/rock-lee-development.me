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
    <div class="modal fade" id="forgotmodal" tabindex="-1" role="dialog" aria-labelledby="myModallabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel">Enter the Email Address Associated With Your Account</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body mx-3">
            <div class="form-group">
              <input type="password" name="resPassword" id="newPassword" required="required" tabindex="2" class="form-control" placeholder="New Password">
            </div>
            <div class="form-group">
              <input type="password" name="confirm_password" id="confirm-password" tabindex="2" required="required" class="form-control"
              oninput="checkPasswords(this)" placeholder="Confirm Password">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/index.js"></script>
    <script src="js/resetpassword.js.js"></script>
  </body>
</html>
