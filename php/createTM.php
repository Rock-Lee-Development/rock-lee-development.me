

<?php
$servername = "rockleedb.cqkqw4vhznsx.us-east-1.rds.amazonaws.com";
$username = "rocklee";
$password = "lindenwood";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "<h1>Connected successfully</h1>";

$tmname = $_POST["tmname"];
$sdate = $_POST["startDate"];
$stime = $_POST["startTime"];
$originalsDate = $sdate.' '.$stime;
$startDate = date("Y-m-d H:i:s", strtotime($originalsDate));

$edate = $_POST["endDate"];
$etime = $_POST["closeTime"];
$originaleDate = $edate.' '.$etime;
$endDate = date("Y-m-d H:i:s", strtotime($originaleDate));

$des = $_POST['description'];
//$ii=$splitTime[1];

//echo "<br >";
    //echo $tmname;
   // echo "<br >";
   // echo $startDate;
//echo "<br >";
//echo $endDate;
//echo "<br >";
//echo $des;
//echo $ii;
//$con = $sdate." ".$stime;



$result = mysqli_query($conn,"USE rocklee");

$conn->query($result);

$result = "INSERT INTO Tournament (Name, Descripton,StartDate,EndDate,Approved)
VALUES ('$tmname', '$des','$startDate', '$endDate',0)";

if ($conn->query($result) === TRUE) {
    echo "<br >";
    echo "New record created successfully";
    echo "<br >";
} else {
    echo "Error: " . $result . "<br>" . $conn->error;
}

$result = mysqli_query($conn,"SELECT * FROM Tournament");

echo "<table border='1'>
<tr>
<th>ID</th>
<th>Name</th>
<th>Description</th>
<th>StartDate</th>
<th>EndDate</th>
<th>Prove Status</th>
</tr>";


if($result === FALSE) {
    die(mysqli_error($conn));
}

while($row = mysqli_fetch_array($result))
{
    echo "<tr>";
    echo "<td>" . $row['TournamentID'] . "</td>";
    echo "<td>" . $row['Name'] . "</td>";
    echo "<td>" . $row['Descripton'] . "</td>";
    echo "<td>" . $row['StartDate'] . "</td>";
    echo "<td>" . $row['EndDate'] . "</td>";
    echo "<td>" . $row['Approved'] . "</td>";
    echo "</tr>";
    echo  "<br >";
}
echo "</table>";


mysqli_close($conn);



?>