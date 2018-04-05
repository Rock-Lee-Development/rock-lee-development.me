<?php

$servername = "rockleedb.cqkqw4vhznsx.us-east-1.rds.amazonaws.com";
$databaseName = "rocklee";
$databasePassword = "lindenwood";

$conn = mysqli_connect($servername, $databaseName, $databasePassword, $databaseName);

if (!$conn) {
    die("Connection to server failed. Contact system adminstrator: " . mysqli_connect_error());
    header('Location: ./error.html');

} else {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $check_email_query = "select Email from User where Email = \"$email\"";
    $result = mysqli_query($conn, $check_email_query);

    if (!$result) {
        die("There was a database error: " . mysqli_error($conn));
        header('Location: ../error.html');
    } else {
        if (mysqli_num_rows($result) == 0) {
            echo "<script> alert('Your email address was not found in the Tournament System. Please register as a new user');
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
                    header('Location: ../Home_Page.html');
                } else {
                   echo "<script> alert('The password you entered does not match the associated user account');
                 window.location.href='../index.html'; </script>";

                }
            }
        }
        // while($row = mysqli_fetch_assoc($result))
        // {
        //    echo $row["Email"];
        // }

        // header('Location: ../Home_Page.html');
    }



}
