<?php

if(!isset($message)){
    session_start();
    //connect DB
require_once("DBController.php");
$db_handle = new DBController();
    $email = $_SESSION["email"];

        //get tournament info
    $tmname = $_POST["tmname"];
    $sdate = $_POST["StartDate"];
    $edate = $_POST["EndDate"];

    $startDate = date("Y-m-d H:i:s", strtotime($sdate));
    $endDate = date("Y-m-d H:i:s", strtotime($edate));

        //get team info
    $teamSize =  $_POST["teamSize"];
    $teamNum =  $_POST["teamNumber"];

    $type = $_POST["gType"];
    if ($type == 'Team') {
        $type = 1;

    } else if($type == 'Individual')  {
        $type = 0;
        $teamNum = 0;
        $teamSize = 0;
    }

    $des = $_POST['description'];

//insert into tounament id
$query = "insert into Tournament (Name, Descripton,StartDate,EndDate,Approved,isTeamBased)
values ('$tmname', '$des','$startDate', '$endDate',0,'$type')";
    $current_id = $db_handle->insertQuery($query); //get current tournament id

   for($x =1;$x<=$teamNum;$x++) {
       $teamName = "Team ".$x;
       //insert into team table
       $add_token_query = "INSERT INTO Team (TeamName, TeamLimit,TournamentID) VALUES(\"$teamName\",\"$teamSize\",\"$current_id\")";
       $tokenresult = $db_handle->addTokenQuery($add_token_query);
   }

    //$current_id = $db_handle->insertQuery($query);

    if (!empty($current_id)) {
        $actual_link = "http://localhost/public/my_site/GitHub/rock-lee-development.me/php/approved.php?TournamentID= $current_id&email=$email";
        $toEmail = 'ccjumpper@gmail.com';
        $subject = "New Tournament need chack status";
        $content = "Click this link to activate your account. <a href='" . $actual_link . "'> </a>";
        $mailHeaders = "From: noreply@tourneyregistration.com\r\n";
        if (mail($toEmail, $subject, $content, $mailHeaders)) {
            echo "<script> alert('Your tounrmanet is sent. An activation link has been sent to your email.');
        window.location.href='../pull_user_info.php'; </script>";
              //send eamil to creator
              $toEmail = $email;
              $subject = "Tournament status";
              $content = "Your tournament is pending to be checked.";
              $mailHeaders = "From: noreply@tourneyregistration.com\r\n";
              if (mail($toEmail, $subject, $content, $mailHeaders)){
                  echo "<script> alert('Your tournament is sent. pending');
          window.location.href='../php/pull_user_info.php'; </script>";
                  exit;
              }
        }
        unset($_POST);
    } else {
        $message = "Problem in registration. Try Again!";
    }


}

if(!empty($message)) {
    if(isset($message)) echo $message;
}

if(!empty($error_message)) {
    if(isset($error_message)) echo $error_message;
}

?>
