<?php
//get tm id
//get des
//get name
//update
if(isset($_POST['get_id'])) {

    // Create connection
    require_once("DBController.php");
    $db_handle = new DBController();


    $tmID = $_POST['get_id'];
    $name = $_POST['tm_name'];
    $des = $_POST['desc'];
    //delete tounament
    $query = "UPDATE Tournament Set Name = '$name', Descripton = '$des' WHERE TournamentID = '$tmID' ";

    //
    //delete other table relate with this id
    //UserTournaments
    //team
    //teammember
    //records
    //matches

    $result = $db_handle->updateQuery($query);

    if ($result) {

        echo "<script> alert('you successfully update a tournament $tmID') </script>";

    } else {
        echo "<script> alert('wrong $tmID') </script>";
    }

}

?>