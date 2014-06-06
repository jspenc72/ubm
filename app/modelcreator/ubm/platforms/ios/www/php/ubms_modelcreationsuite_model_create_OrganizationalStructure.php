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
$v2 = "'" . $conn -> real_escape_string($OrganizationalStructureTitle) . "'";
$v3 = "'" . $conn -> real_escape_string($organizationalStructureTitleReportsTo) . "'";
$v5 = "'" . $conn -> real_escape_string($activeModelUUID) . "'";

$sqlins = "INSERT INTO ubm_model_organizationalstructures ( structure_title, structure_reports_to ) VALUES ( $v2, $v3 )"; //Creates a New Organizational Strucure record.
if ($conn -> query($sqlins) === false) {
	trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn -> error, E_USER_ERROR);
} else {
	$last_inserted_id = $conn -> insert_id;
	//$affected_rows = $conn -> affected_rows;
	$sqlins2 = "INSERT INTO ubm_model_has_organizationalstructures (model_UUID, organizationalstructure_id) VALUES ( $v5, $last_inserted_id )";
	if ($conn -> query($sqlins2) === false) {
		trigger_error('Wrong SQL: ' . $sqlins2 . ' Error: ' . $conn -> error, E_USER_ERROR);
	} else {

	}
}

echo $_GET['callback'] . '(' . "{'message' : 'Organizational Structure \"$title\" created successfully!'}" . ')';

