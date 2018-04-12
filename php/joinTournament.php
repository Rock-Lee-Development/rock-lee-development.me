<?php
session_start();
//user id
//tournament id
if(!isset($message)) {
  require_once("DBController.php");
  $db_handle = new DBController();
  $email = $_SESSION["email"];
  $query = "SELECT UserID FROM User WHERE email='$email'";
$current_id = $db_handle->getUserID($query);
$query = "INSERT INTO UserTournaments (TournamentID, UserID) VALUES
('" . $_POST["TMname"] . "', '$current_id')";
$insideTable = $db_handle->insertQuery($query);
if(!empty($insideTable)) {
  echo "<script> alert('you successfuly join this tournament');
           window.location.href='../index.html'; </script>";

}

}else{
  echo "<script> alert('something wrong');
           window.location.href='../index.html'; </script>";
}
?>
