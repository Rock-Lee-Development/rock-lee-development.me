<?php

//connect to database
require_once("DBController.php");
$db_handle = new DBController();


$final = $_POST["final"];

echo "<script> alert('starting update record $records');
           window.location.href='../index.html'; </script>";

?>