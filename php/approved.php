<?php
require_once("DBController.php");
$db_handle = new DBController();
if(!empty($_GET["TournamentID"])) {
$query = "UPDATE Tournament set Approved = '1' WHERE TournamentID='" . $_GET["TournamentID"]. "'";
$result = $db_handle->updateQuery($query);
if(!empty($result)) {
$message = "Your tournament is approved.";
} else {
$message = "Problem in account activation.";
}
}
?>