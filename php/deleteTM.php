<?php
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

    $tmID = $_POST['val'];
    $result = $conn->query( "DELETE * FROM Tournament WHERE TournamentID = '$tmID' ");
    $row = $result->fetch_assoc();
    if($row){

        echo "<script> alert('you successfully delete a tournament $tmID') </script>";

   }else
{
    echo "<script> alert('wrong $tmID') </script>";
}


?>