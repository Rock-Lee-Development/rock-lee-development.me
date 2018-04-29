<?php

if(!isset($message)){
    session_start();
    //connect DB
require_once("DBController.php");
$db_handle = new DBController();
    $email = $_SESSION["email"];

        //get tournament info
    $tmname = $_POST["tmname"];
    $sdate = $_POST["StartDate"];
    $edate = $_POST["EndDate"];

    $startDate = date("Y-m-d H:i:s", strtotime($sdate));
    $endDate = date("Y-m-d H:i:s", strtotime($edate));

        //get team info
    $teamSize =  $_POST["teamSize"];
    $teamNum =  $_POST["teamNumber"];


    $type = $_POST["gType"];
    if ($type == 'Team') {
        $type = 1;

    } else if($type == 'Individual')  {
        $type = 0;
        $teamNum = 0;
        $teamSize = 0;
    }

    $des = $_POST['description'];

//insert into tounament id
$query = "insert into Tournament (Name, Descripton,StartDate,EndDate,Approved,isTeamBased,Creator)
values ('$tmname', '$des','$startDate', '$endDate',0,'$type','$email')";
    $current_id = $db_handle->insertQuery($query); //get current tournament id

   for($x =1;$x<=$teamNum;$x++) {
       $teamName = "Team ".$x;
       //insert into team table
       $add_token_query = "INSERT INTO Team (TeamName, TeamLimit,TournamentID) VALUES(\"$teamName\",\"$teamSize\",\"$current_id\")";
       $tokenresult = $db_handle->addTokenQuery($add_token_query);
   }

    //$current_id = $db_handle->insertQuery($query);


if(!empty($message)) {
    if(isset($message)) echo $message;
}

if(!empty($error_message)) {
    if(isset($error_message)) echo $error_message;
}

if(isset($_POST['done']))
{

	$file = rand(1000,100000)."-".$_FILES['file']['name'];
  $file_loc = $_FILES['file']['tmp_name'];
	$file_size = $_FILES['file']['size'];
	$file_type = $_FILES['file']['type'];
	$folder="../uploads/";

	// new file size in KB
	$new_size = $file_size/1024;
	// new file size in KB

	// make file name in lower case
	$new_file_name = strtolower($file);
	// make file name in lower case

	$final_file=str_replace(' ','-',$new_file_name);

	if(move_uploaded_file($file_loc,$folder.$final_file))
	{
		$sql="INSERT INTO tbl_uploads(file,type,size) VALUES('$final_file','$file_type','$new_size')";
		$query= $db_handle->insertQuery($sql);
		$message = "successfuly upload";
	}
	else
	{

	$message = "error while uploading file";
	}
}
if (!empty($current_id)) {
  echo "<script> alert('Your tournament is sent. pending');
window.location.href='../php/index.php'; </script>";
      unset($_POST);
  } else {
      $message = "Problem in registration. Try Again!";
  }


}

?>
