<?php
	require_once("DBController.php");

	$db_handle = new DBController();
	$id = $_GET['UserID'];
	$token = $_GET['Token'];

	$verify_query = "SELECT * FROM UserToken WHERE UserID='$id' AND Token = '$token'";
	$count = $db_handle->numRows($verify_query);

	if($count > 0) {
	$update_status_query = "UPDATE User set status = '1' WHERE UserID='" . $_GET["UserID"]. "'";
	$save_token_query = "UPDATE UserToken set Token = '$token' WHERE UserID='$id'";

  $saveresult = $db_handle->updateQuery($save_token_query);
	$result = $db_handle->updateQuery($update_status_query);


		if(!empty($result)) {
			echo "<script> alert('Your Gamer Tree User Account has been activated. Please proceed to login and enjoy use of the tournament management system.');
	    window.location.href='../index.html'; </script>";
		} else {
			echo "<script> alert('There has been a problem with your registration. Please contact the Lindenwood University Library and Academic resources center to report your issue.');
			window.location.href='../index.html'; </script>";
		}
	}
?>
