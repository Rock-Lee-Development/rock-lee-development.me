<?php
require_once("DBController.php");
$db_handle = new DBController();
    // Create connection


    $tmID = $_POST['get_id'];
    $result = $db_handle->deleteQuery( "DELETE  FROM Tournament WHERE TournamentID = '$tmID' ");
    $result1 = $db_handle->deleteQuery( "DELETE  FROM tbl_uploads WHERE TournamentId = '$tmID' ");

    if($result){

        echo "<script> alert('you successfully delete a tournament $tmID') </script>";

   }else
{
    echo "<script> alert('wrong $tmID') </script>";
}


?>
