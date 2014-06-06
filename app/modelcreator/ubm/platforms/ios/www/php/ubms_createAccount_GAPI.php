<?php
require_once('globalGetVariables.php');
require_once('ubms_db_config.php');
require_once('DBConnect_UBMv1.php');		//Provides the variables used for UBMv1 database connection $conn

$displayNameGAPI = $_GET['displayNameGAPI'];
$emailGAPI = $_GET['emailGAPI'];
	//$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
	$conn = new mysqli("localhost","jessespe","Xfn73Xm0","jessespe_FindMyDriver");
	// check connection
	if ($conn->connect_error) {
	  trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
	}
$sqlins = "INSERT INTO members (display_name, email)
				VALUES ('$displayNameGAPI', '$emailGAPI')";
if (!$conn -> query($sqlins)) {
	$theError = $conn -> error;
	echo $_GET['callback'] . '(' . "{'message' : 'Unable to Process your request: $theError'}" . ')';
} else {
	$last_inserted_id = $conn -> insert_id;
	//$affected_rows = $conn -> affected_rows;
	echo $_GET['callback'] . '(' . "{'message' : 'The userID was: $last_inserted_id, the received display name and email $displayNameGAPI and $emailGAPI'}" . ')';
}