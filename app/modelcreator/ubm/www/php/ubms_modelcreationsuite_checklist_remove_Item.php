<?php
require_once('globalGetVariables.php');
require_once('ubms_db_config.php');
require_once('DBConnect_UBMv1.php');		//Provides the variables used for UBMv1 database connection $conn
error_reporting(E_ALL);
ini_set('display_errors', '1');
$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
// check connection
if ($conn -> connect_error) {
	trigger_error('Database connection failed: ' . $conn -> connect_error, E_USER_ERROR);
}
$activeUUID = $_GET['activeUUID'];

$v6 = "'" . $conn -> real_escape_string($activeUUID) . "'";
$sql = "DELETE FROM ubm_modelcreationsuite_heirarchy_object_closureTable 
		WHERE descendant_id=$v6 
		AND path_length=1";

if ($conn->query($sql) === false) {
    //trigger_error('Wrong SQL: ' . $sqldel . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
	$affected_rows = $conn->affected_rows;
		echo $_GET['callback'] . '(' . "{'message' : 'The number of affected rows is $affected_rows. the Item removed was: $activeUUID '}" . ')';
}

