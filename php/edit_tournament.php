<?php

//connect to database
require_once("DBController.php");
$db_handle = new DBController();

//get tournament id
$tm_id = $_POST["records"];

//check number of team
$query = "SELECT COUNT(*) FROM Team WHERE TournamentID = '$tm_id' ";
$team_num = $db_handle->getCount($query);

//find how many matches need
$matches = $team_num -2;

//get winner id - t_num
//get loser id -

//final winner
$final = $_POST["final"];


for($i = 1;$i<=$matches;$i++)
{

    $win1 = $_POST["t".$i];
    if(!empty($win1))
    {
        echo "<script> alert('starting update record $win1 with tournament id $tm_id');
           </script>";
           echo "<script> alert('starting update record $win1 with tournament id $tm_id and tm $i');
           </script>";
        //get team id
        $getuser = "SELECT TeamID FROM Team Where TournamentID = $tm_id";
        $teamid = $db_handle->getTeamID($getuser);

        //get users id
        $query3 = "SELECT UserID FROM TeamMembers Where TeamID = $teamid";
        $user = $db_handle->getUserID($query3);

        $query = "INSERT INTO Game(MatchesType,TournamentID,WinnerID)
         VALUES('Team','$tm_id','$user') ";
        $db_handle->insertQuery($query);

        //update records

    }else{
        echo "<script> alert('game not recorded');
           </script>";

    }
}



//$query = "INSERT INTO Matches(MatchType,TournamentID,WinnerID,LoserID)
//VALUE ('team','','$win1')";


?>