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
$v2 = "'" . $conn -> real_escape_string($coreValueTitle) . "'";
$v3 = "'" . $conn -> real_escape_string($summary) . "'";
$v4 = "'" . $conn -> real_escape_string($username) . "'";
$v5 = "'" . $conn -> real_escape_string($activeModelUUID) . "'";

$sqlins = "INSERT INTO ubm_model_corevalues (value_title, value_summary, created_by) VALUES ( $v2, $v3, $v4 )"; //Creates a New Core Value record.
if ($conn -> query($sqlins) === false) {
	trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn -> error, E_USER_ERROR);
} else {
	$last_inserted_id = $conn -> insert_id;
	//$affected_rows = $conn -> affected_rows;
	$sqlins2 = "INSERT INTO ubm_model_has_corevalues (model_UUID, corevalue_id) VALUES ( $v5, $last_inserted_id )";
	if ($conn -> query($sqlins2) === false) {
		trigger_error('Wrong SQL: ' . $sqlins2 . ' Error: ' . $conn -> error, E_USER_ERROR);
	} else {

	}
}

echo $_GET['callback'] . '(' . "{'message' : 'Core-Value $coreValueTitle created successfully!'}" . ')';
