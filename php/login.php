<?php

// to get data stored in a session, you must let the browser know to start a session
session_start();

$servername = "rockleedb.cqkqw4vhznsx.us-east-1.rds.amazonaws.com";
$databaseName = "rocklee";
$databasePassword = "lindenwood";

$conn = mysqli_connect($servername, $databaseName, $databasePassword, $databaseName);

// Sesion variables for database information. 
$_SESSION["servername"] = $servername;
$_SESSION["databasename"] = $databaseName ;
$_SESSION["password"] = $password;


if (!$conn) {
    die("Connection to server failed. Contact system adminstrator: " . mysqli_connect_error());
    header('Location: ./error.html');

} else {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $check_email_query = "select Email from User where Email = \"$email\" and Status = 1";
   
    $result = mysqli_query($conn, $check_email_query);

    if (!$result) {
        die("There was a database error: " . mysqli_error($conn));
        header('Location: ../error.html');
    } else {
        if (mysqli_num_rows($result) == 0) {
            echo "<script> alert('Your Lindenwood email address is not currrently in our system, or it has not been activated. If you have registered please check your email for a User Account activation link. Otherwise, please register as a new user.');
              window.location.href='../index.html'; </script>";
        } else if (mysqli_num_rows($result) == 1) {

           // $check_status_query = "DD"; 

            $get_password_query = "select PasswordHash from User where Email = \"$email\"";
            $result2 = mysqli_query($conn, $get_password_query);

            if (!$result2) {
                die("There was a database error: " . mysqli_error($conn));
                header('Location: ../error.html');
            } else {
                $row = mysqli_fetch_assoc($result2);
                $hashed_password = $row["PasswordHash"];

                if (password_verify($password, $hashed_password)) {

                    // Session variable for Email Address; 
                    $_SESSION["email"] = $email; 

                    //Redirect. 
                    header('Location: pull_user_info.php');
                } else {
                   echo "<script> alert('The password you entered does not match the associated user account');
                 window.location.href='../index.html'; </script>";

                }
            }
        }
   
    
    }



}
