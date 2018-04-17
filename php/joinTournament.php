<?php
session_start();
//user id
//tournament id
if(!isset($message)) {
  require_once("DBController.php");
  $db_handle = new DBController();
  $email = $_SESSION["email"];
  $query = "SELECT UserID FROM User WHERE email='$email'";
  //$UserID_Tournament= "SELECT From "
$current_id = $db_handle->getUserID($query);

  //if it is a team game
if(!empty($_POST["teamName"]))
{
 $TMname =  $_POST["TMname"];
 $TeamName= $_POST["TeamName"];

    //check limit size
<<<<<<< HEAD
    $result = "SELECT COUNT(*) FROM TeamMembers WHERE TeamID = ".$_POST["teamName"];
    $row_count = $db_handle->getCount($result);

    $result = "SELECT TeamLimit FROM Team WHERE TournamentID = ' ".$_POST["TMname"]."' AND TeamID = ' ".$_POST["teamName"]." ' ";
    $team_limit=$db_handle->getTeamLimit($result);

    if($team_limit>=$row_count)//number of UserID rows in Teammbers table
    {

    $query5 = "INSERT INTO UserTournaments (TournamentID, UserID) VALUES
    ('" . $_POST["TMname"] . "', '$current_id')";
    $insideTable = $db_handle->insertQuery($query5);
        //enroll into team
        $query4 ="INSERT INTO TeamMembers (TeamID,UserID) VALUES
        ('" . $_POST["teamName"] . "', '$current_id')";
        $insideTable = $db_handle->insertQuery($query4);

        if(!empty($insideTable)){

          //check the user already in the tournament

            echo "<script> alert(\'You successfuly join the team\');
           window.location.href=\'../index.html\'; </script>";
        }
        else{
=======
    $result1 = "SELECT COUNT(*) FROM TeamMembers WHERE TeamID = '$TeamName'";
    $row_count = $db_handle->getCount($result1);

    $result2 = "SELECT TeamLimit FROM Team WHERE TournamentID ='$TMname' AND TeamID = '$TeamName'";
    $team_limit=$db_handle->getTeamLimit($result2);

    if($row_count<$team_limit) //number of UserID rows in Teammbers table
    {
      $query2 ="INSERT INTO TeamMembers (TeamID,UserID) VALUES
      ('" . $_POST["TeamName"] . "', '$current_id')";
      $insideTable = $db_handle->insertQuery($query2);

       if(!empty($insideTable)){
      $query1 = "INSERT INTO UserTournaments (TournamentID, UserID) VALUES
      ('" . $_POST["TMname"] . "', '$current_id')";
      $insideTable2 = $db_handle->insertQuery($query1);
      echo "<script> alert('You successfuly join the team');
     window.location.href='../index.html'; </script>";
        }else{
>>>>>>> origin/master
            echo "<script> alert('something wrong');
           window.location.href='../index.html'; </script>";
         }

}else{
  $query1 = "SELECT UserID FROM User WHERE email='$email'";
$current_id = $db_handle->getUserID($query1);
$query2 = "INSERT INTO UserTournaments (TournamentID, UserID) VALUES
('" . $_POST["TMname"] . "', '$current_id')";
<<<<<<< HEAD
$insideTable = $db_handle->insertQuery($query2);
    echo "<script> alert('you successfulyuuuuuuu join this tournament');
           window.location.href='../index.html'; </script>";

}




=======
$insideTable = $db_handle->insertQuery($query);
echo "<script> alert('you successfulyuuuuuuuu join this tournament');
         window.location.href='../index.html'; </script>";
}

}else{
  echo "<script> alert('something wrong');
           window.location.href='../index.html'; </script>";
}
>>>>>>> origin/master
}else{
  echo "<script> alert('something wrong');
           window.location.href='../index.html'; </script>";
}
?>
