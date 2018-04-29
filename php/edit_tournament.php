<?php

//connect to database
require_once("DBController.php");
$db_handle = new DBController();

//get tournament id
//check number of team
//find how many matches need
//get winner id
//get loser id
$index = 1;

for($i = 1;$i<15;$i++)
{
    $win1 = $_POST["t".$i];
    if(!empty($win1))
    {
        echo "<script> alert('starting update record $win1');
           </script>";
    }else{
        echo "<script> alert('game not recorded');
           </script>";
        break;
    }
}

$final = $_POST["final"];

//$query = "INSERT INTO Matches(MatchType,TournamentID,WinnerID,LoserID)
//VALUE ('team','','$win1')";


?>