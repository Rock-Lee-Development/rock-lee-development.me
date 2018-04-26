<?php
//session_start();
require_once("DBController.php");
$db_handle = new DBController();

//$currentEmail = $_GET['email'];
$currentTMid = $_POST['get_id'];


//if((!empty($currentEmail)) && (!empty($currentTMid))){


//if(!empty($result)) {

$query = "SELECT Creator FROM Tournament WHERE TournamentID = '" . $currentTMid . "'";
$email = $db_handle->getEmail($query);
if(!empty($email)) {
    $query1 = "UPDATE Tournament set Approved = '1' WHERE TournamentID='" . $currentTMid . "'";
    $result = $db_handle->updateQuery($query1);

        //$actual_link = "http://localhost/public/my_site/GitHub/rock-lee-development.me/php/approved.php?TournamentID= $currentTMid&email=$currentEmail";
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."approved.php?TournamentID=" . $currentTMid."&email=".$email;
        $toEmail = $email;
        $subject = "Tournament status";
        $content = "Tounrmanet is approved. <a href ='" . $actual_link ."'> </a>";
        $mailHeaders = "From: noreply@tourneyregistration.com\r\n";
        if (mail($toEmail, $subject, $content, $mailHeaders)) {
            echo "<script> alert('Your tounrmanet is approved. check your email ');
        window.location.href='../index.html'; </script>";
            exit;
        }
        unset($_POST);
    }
else {
$message = "Problem in account activation.";
}

?>
