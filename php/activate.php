<?php
	require_once("DBController.php");

	$db_handle = new DBController();
	$id = $_GET['UserID'];
	$token = $_GET['Token'];
	$query1 = "SELECT * FROM UserToken WHERE UserID='$id' AND Token = '$token'";
	$count = $db_handle->numRows($query1);
	if($count>0) {
	$query = "UPDATE User set status = '1' WHERE UserID='" . $_GET["UserID"]. "'";
	$result = $db_handle->updateQuery($query);
		if(!empty($result)) {
			echo "<script> alert('your account is activate');
	    window.location.href='../index.html'; </script>";
		} else {
			echo "<script> alert('problem registration');
			window.location.href='../index.html'; </script>";
		}
	}
?>
