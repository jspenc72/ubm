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
foreach ($taskOrder as $UUID => $position) {
	$sql="UPDATE `ubm_model_taskUUID_has_tasknumber` SET task_UUID=$UUID, task_number=$position WHERE task_UUID=$UUID";
	if($conn->query($sql) === false) {
	  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
	} else {
	  $affected_rows = $conn->affected_rows;
	}
}
echo $_GET['callback'] . '(' . "{'message' : 'The number of affected rows is $affected_rows.'}" . ')';