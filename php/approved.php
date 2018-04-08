<?php
session_start();
require_once("DBController.php");
$db_handle = new DBController();
$currentEmail = $_SESSION["email"];

if(!empty($_GET["TournamentID"])) {
$query = "UPDATE Tournament set Approved = '1' WHERE TournamentID='" . $_GET["TournamentID"]. "'";
$result = $db_handle->updateQuery($query);
//$currentEmail = $_GET["email"];
if(!empty($result)) {
$message = "Your tournament is approved.";

    $toEmail = $currentEmail;
    $subject = "Tournament status";
    $content = "Tounrmanet is approved";
    $mailHeaders = "From: noreply@tourneyregistration.com\r\n";
    if (mail($toEmail, $subject, $content, $mailHeaders)) {
        echo "<script> alert('Your tounrmanet is approved. check your email');
        window.location.href='../index.html'; </script>";
        exit;
    }
    unset($_POST);
} else {
$message = "Problem in account activation.";
}
}
?>