<?php
require_once('globalGetVariables.php');
require_once('ubms_db_config.php');
require_once('DBConnect_UBMv1.php');		//Provides the variables used for UBMv1 database connection $conn

$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
// check connection
if ($conn -> connect_error) {
	trigger_error('Database connection failed: ' . $conn -> connect_error, E_USER_ERROR);
}

//INSERT
$v2 = "'" . $conn -> real_escape_string($strategicAllianceComment) . "'";
$v3 = "'" . $conn -> real_escape_string($strategicAllianceDescription) . "'";
$v5 = "'" . $conn -> real_escape_string($activeModelUUID) . "'";

$sqlins = "INSERT INTO ubm_model_strategicalliances (strategicalliance_description, strategicalliance_comment) VALUES ( $v2, $v3 )"; 	//Creates a New Strategic Alliance record.
if ($conn -> query($sqlins) === false) {
	trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn -> error, E_USER_ERROR);
} else {
	$last_inserted_id = $conn -> insert_id;
	//$affected_rows = $conn -> affected_rows;
	$sqlins2 = "INSERT INTO ubm_model_has_strategicalliances (model_UUID, strategicalliance_id) VALUES ( $v5, $last_inserted_id )";
	if ($conn -> query($sqlins2) === false) {
		trigger_error('Wrong SQL: ' . $sqlins2 . ' Error: ' . $conn -> error, E_USER_ERROR);
	} else {

	}
}

echo $_GET['callback'] . '(' . "{'message' : 'Strategic Alliance \"$strategicAllianceComment\" created successfully!'}" . ')';