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
if($_POST['password'] != $_POST['confirm_password']){
$error_message = 'Passwords should be same<br>';
}

/* Email Validation */
if(!isset($error_message)) {
	if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
	$error_message = "Invalid Email Address";
	}
}

if(!isset($message)) {
  require_once("DBController.php");
  $db_handle = new DBController();
  $query = "SELECT * FROM registered_user where email = '" . $_POST["email"] . "'";
  $count = $db_handle->numRows($query);

  if($count==0) {
    $query = "INSERT INTO registered_user (user_name, first_name, last_name, password, email) VALUES
    ('" . $_POST["userName"] . "', '" . $_POST["firstName"] . "', '" . $_POST["lastName"] . "', '" . md5($_POST["password"]) . "', '" . $_POST["email"] . "')";
    $current_id = $db_handle->insertQuery($query);
    if(!empty($current_id)) {
      $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."activate.php?id=" . $current_id;
      $toEmail = $_POST["email"];
      $subject = "User Registration Activation Email";
      $content = "Click this link to activate your account. <a href='" . $actual_link . "'>" . $actual_link . "</a>";
      $mailHeaders = "From: Admin\r\n";
      if(mail($toEmail, $subject, $content, $mailHeaders)) {
        $message = "You have registered and the activation mail is sent to your email. Click the activation link to activate you account.";
      }
      unset($_POST);
    } else {
      $message = "Problem in registration. Try Again!";
    }
  } else {
    $message = "User Email is already in use.";
  }
}
}

if(!empty($message)) {
    if(isset($message)) echo $message;
}

if(!empty($message)) {
    if(isset($message)) echo $message;
}



/* 	<?php  ?>
	<div class="success-message"><?php ?></div>
	<?php } ?>
	<?php if(!empty($error_message)) { ?>
	<div class="error-message"><?php if(isset($error_message)) echo $error_message; ?></div>
	<?php } ?>  */

?>
