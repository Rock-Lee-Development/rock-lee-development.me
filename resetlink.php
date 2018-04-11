<?php
session_start();

$servername = "rockleedb.cqkqw4vhznsx.us-east-1.rds.amazonaws.com";
$databaseName = "rocklee";
$databasePassword = "lindenwood";

$conn = mysqli_connect($servername, $databaseName, $databasePassword, $databaseName);

// Sesion variables for database information.
$_SESSION["servername"] = $servername;
$_SESSION["databasename"] = $databaseName ;
$_SESSION["password"] = $password;

require_once("php/DBController.php");
$db_handle = new DBController();
$id = $_GET['UserID'];
$token = $_GET['Token'];
$query1 = "SELECT * FROM UserToken WHERE UserID='$id' AND Token = '$token'";
$count = $db_handle->numRows($query1);
if($count>0) {
  $query3 = "UPDATE UserToken set Token = '$token' WHERE UserID='$id'";
  $result3 = $db_handle->updateQuery($query3);
  // Session variable for Email Address;
  $_SESSION["UserID"] = $id;
  $_SESSION["Token"] = $token;
header('Location: respassword.php');
}else {

}





 ?>
