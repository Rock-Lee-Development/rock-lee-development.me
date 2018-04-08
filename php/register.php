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
  $token = $db_handle->generateNewString();

  if($count==0) {
    $query = "INSERT INTO User (FirstName, LastName, PasswordHash, Email) VALUES
    ('" . $_POST["firstName"] . "', '" . $_POST["lastName"] . "', '" . password_hash( $_POST["newPassword"], PASSWORD_DEFAULT) . "', '" . $_POST["newEmail"] . "')";
    $current_id = $db_handle->insertQuery($query);
    $add_token_query = "INSERT INTO UserToken (UserID, Token) VALUES(\"$current_id\", \"$token\")";
   	$tokenresult = $db_handle->addTokenQuery($add_token_query);

     if(!empty($current_id)) {
<<<<<<< HEAD
      $actual_link = "http://ec2-34-229-212-55.compute-1.amazonaws.com/php/activate.php?UserID=$current_id&Token=$token";
=======
      $actual_link = "http://ec2-34-229-212-55.compute-1.amazonaws.com/php/activate.php?UserID=$current_id?Token=$token";
>>>>>>> 9709bdea5870be04cedfb5769bde1c4d84bfdb1f
      $toEmail = $_POST["newEmail"];
      $subject = "Gamer Tree User Account Activation Email";
      $content = "Thank you for registering with Lindenwood University's Gamer Tree tournament management system \n
      Please click this link to activate your Gamer Tree User Account.\n $actual_link";
      $mailHeaders = "From: noreply@gamertree.com\r\n";

     $returnval = mail($toEmail, $subject, $content, $mailHeaders);

     if($returnval){
       echo "<script> alert('Your user account has been succesfully registered. Please check your Lindenwood email address for an activation email.');
                window.location.href='../index.html'; </script>";
         exit;
     }else {
      $message = "Problem in registration. Try Again!";
     }
      unset($_POST);
    }
     else 
    {
      $message = "Problem in registration. Try Again!";
    }


  }
   else
   {
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
