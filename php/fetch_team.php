<?php

session_start(); 

if(isset($_POST['get_option']))
{
    $servername = $_SESSION["servername"]; 
    $username = $_SESSION["databasename"];
    $password = $_SESSION["password"];
    $dbname = $_SESSION["databasename"];
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $tmID = $_POST['get_option'];
    $result = $conn->query( "SELECT * FROM Tournament WHERE TournamentID = '$tmID' AND Approved = '1' AND isTeamBased = '1'");
    $row = $result->fetch_assoc();
    if($row){

        $find = $conn->query("select TeamName from Team where TournamentID = '$tmID'");

            echo "Select A Team";

            echo "<select>";
            while ($row = $find->fetch_assoc()) {
                echo "<option>" . $row['TeamName'] . "</option>";
            }
            echo "</select>";
            exit;


    }


}
?>