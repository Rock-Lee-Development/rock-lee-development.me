<?php
//session_start();
require_once("DBController.php");
$db_handle = new DBController();

$currentEmail = $_GET['email'];
$currentTMid = $_GET['TournamentID'];


//if((!empty($currentEmail)) && (!empty($currentTMid))){


//if(!empty($result)) {

    $query = "SELECT Email FROM User WHERE Email = '" . $currentEmail . "'";
    $count = $db_handle->numRows($query);
    if($count > 0) {
        $query1 = "UPDATE Tournament set Approved = '1' WHERE TournamentID='" . $_GET["TournamentID"]. "'";
        $result = $db_handle->updateQuery($query1);
        //$actual_link = "http://localhost/public/my_site/GitHub/rock-lee-development.me/php/approved.php?TournamentID= $currentTMid&email=$currentEmail";
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."approved.php?TournamentID=" . $current_id."&email=".$email;
        $toEmail = "zs916@lindenwood.edu";
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
