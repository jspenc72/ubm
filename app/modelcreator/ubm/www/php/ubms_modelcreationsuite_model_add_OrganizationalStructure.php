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
$v2 = "'" . $conn -> real_escape_string($activeModelUUID) . "'";
$v3 = "'" . $conn -> real_escape_string($organizationalStructureId) . "'";

$sqlins = "INSERT INTO ubm_model_has_organizationalstructures (model_UUID, organizationalstructure_id) VALUES ($v2, $v3)";

if ($conn -> query($sqlins) === false) {
	trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn -> error, E_USER_ERROR);
} else {
	$last_inserted_id = $conn -> insert_id;
	$affected_rows = $conn -> affected_rows;
}
echo $_GET['callback'] . '(' . "{'message' : 'The number of affected rows is $affected_rows. the Model modified was $v2.'}" . ')';