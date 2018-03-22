<?php

  $servername = "rockleedb.cqkqw4vhznsx.us-east-1.rds.amazonaws.com";
  $databaseName = "rocklee";
  $databasePassword = "lindenwood";
 
  $conn = mysqli_connect($servername, $databaseName, $databasePassword, $databaseName); 

  if (!$conn) 
  {
     die("Connection to server failed. Contact system adminstrator: " . mysqli_connect_error());
  } 
  else 
  { 
    $username = $_POST["username"];
    $password = $_POST["password"];

    // In here we need to figure out if the actual username and password typed in the box is in our database. 
    // If it's not, we need to tell the user that they gave us the wrong shit. 

     header('Location: ./Home_Page.html');
  }






  ?> 