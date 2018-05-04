<?php
if(isset($_POST["Update"])) {
    //connect to database
    require_once("DBController.php");
    $db_handle = new DBController();
    //get tournament id
    $tm_id = $_POST["GameID"];

    //check type
    //check team / individual
    $type = "SELECT isTeamBased FROM Tournament WHERE TournamentID = '" . $tm_id . "'";
    if ($type == 0) //individual
    {
        $sql1 = "INSERT INTO Matches(MatchType,TournamentID,WinnerID,LoserID)
            VALUES('Individual','$tm_id','','')";
        $individual = $db_handle->getCount($sql1);

    } else if ($type == 1) { //team size

        //check number of team
        $query = "SELECT COUNT(*) FROM Team WHERE TournamentID = '$tm_id' ";
        $team_num = $db_handle->getCount($query);

        //find how many matches need
        $matches = $team_num - 2;
        for ($i = 1; $i <= $matches; $i++) {

            $win = $_POST["tm" . $i];
            if ($win != "????") {
                //get teamid
                $teamID = "SELECT TeamID FROM Team TournamentID = '$tm_id' and TeamName ='$win' ";
                $currenTeam = $db_handle->getUserTeamID($teamID);
                //members
                $result1 = "SELECT COUNT(*) FROM TeamMembers WHERE TeamID = '$currenTeam'";
                $row_count = $db_handle->getCount($result1);


                echo "<script> alert('starting update record $win with tournament id $tm_id and tm $i');
           </script>";
                for ($member = 0; $member < $row_count; $member++) {

                    //get users id
                    $query3 = "SELECT UserID FROM TeamMembers Where TeamID = $currenTeam";
                    $user = $db_handle->getUserID($query3);

                    //see which match
                    $query = "UPDATE Matches SET WinnerID = $user
                            WHERE  TournamentID = '$tm_id' ";
                    $db_handle->insertQuery($query);


                }

            }

            //final winner
            $final = $_POST["finals"];
        }

//$query = "INSERT INTO Matches(MatchType,TournamentID,WinnerID,LoserID)
//VALUE ('team','','$win1')";
    } else {
        echo "<script> alert('Bad Connect');
           </script>";
    }

}
?>