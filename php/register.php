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
	if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
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
      $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."activate.php?id=" . $current_id;
      $toEmail = $_POST["email"];
      $subject = "User Registration Activation Email";
      $content = "Click this link to activate your account. <a href='" . $actual_link . "'>" . $actual_link . "</a>";
      $mailHeaders = "From: Admin\r\n";
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



/* 	<?php  ?>
	<div class="success-message"><?php ?></div>
	<?php } ?>
	<?php if(!empty($error_message)) { ?>
	<div class="error-message"><?php if(isset($error_message)) echo $error_message; ?></div>
	<?php } ?>  */
/*header("Location: https://login.microsoftonline.com/common/oauth2/authorize?client_id=00000002-0000-0ff1-ce00-000000000000&redirect_uri=https%3a%2f%2foutlook.office.com%2fowa%2f&resource=00000002-0000-0ff1-ce00-000000000000&response_mode=form_post&response_type=code+id_token&scope=openid&msafed=0&client-request-id=82680fda-df35-4c56-a505-cac648ea8f1a&protectedtoken=true&domain_hint=lindenwood.edu&nonce=636573473347223421.ea347e6d-d2ec-4361-821a-dd10ae0676d7&state=DctBCsMwDERRu71LV3ViS67cTegdegMRCRpIYzA2uX60eJ_ZjHfO3c3N-GhxhZBeBXNBA4AZ0qRsW0mCgK4hI6XwhsRBJEXWSIWkePs-53ry_GnK-3_Zt0P0OGuVSWU8ePTfV2Vruvalt6EX#exsvurl=1&ll-cc=1033&modurl=0", true,303);
exit;*/
?>
