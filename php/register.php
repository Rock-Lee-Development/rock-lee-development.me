<?php
	if(!empty($_POST["register-user"])) {
		/* Form Required Field Validation */
		foreach($_POST as $key=>$value) {
			if(empty($_POST[$key])) {
			$error_message = "All Fields are required";
			break;
			}
		}
    /* Password Matching Validation */
if($_POST['newPassword'] != $_POST['confirm_password']){
$error_message = 'Passwords should be same<br>';
}

/* Email Validation */
if(!isset($error_message)) {
	if (!filter_var($_POST["newEmail"], FILTER_VALIDATE_EMAIL)) {
	$error_message = "Invalid Email Address";
	}
}

if(!isset($message)) {
  require_once("DBController.php");
  $db_handle = new DBController();
  $query = "SELECT * FROM User WHERE email='" . $_POST["newEmail"] . "'";
  $count = $db_handle->numRows($query);

  if($count==0) {
    $query = "INSERT INTO User (FirstName, LastName, PasswordHash, Email) VALUES
    ('" . $_POST["firstName"] . "', '" . $_POST["lastName"] . "', '" . password_hash( $_POST["newPassword"], PASSWORD_DEFAULT) . "', '" . $_POST["newEmail"] . "')";
    $current_id = $db_handle->insertQuery($query);
    if(!empty($current_id)) {
      $actual_link = "http://localhost/public/my_site/GitHub/rock-lee-development.me/php/"."activate.php?UserID=" . $current_id;
      $toEmail = $_POST["newEmail"];
      $subject = "User Registration Activation Email";
      $content = "Click this link to activate your account. <a href='" . $actual_link . "'>" . $actual_link . "</a>";
      $mailHeaders = "From: noreply@tourneyregistration.com\r\n";
      if(mail($toEmail, $subject, $content, $mailHeaders)) {
        echo "<script> alert('Your account has been registered and is pending approval.');
        window.location.href='../index.html'; </script>";
				exit;
      }
      unset($_POST);
    } else {
      $message = "Problem in registration. Try Again!";
    }
  } else {
    echo "<script> alert('The email address you entered is already associated with a user account');
    window.location.href='../index.html'; </script>";
		exit;
  }
}
}

if(!empty($message)) {
    if(isset($message)) echo $message;
}

if(!empty($error_message)) {
    if(isset($error_message)) echo $error_message;
}

?>
