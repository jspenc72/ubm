<?php
require_once('globalGetVariables.php');
//require_once('ubms_db_config.php');
require_once('DBConnect_UBMv1.php');		 //Provides the variables used for UBMv1 database connection $conn

$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
//    check connection
if ($conn -> connect_error) {
	trigger_error('Database connection failed: ' . $conn -> connect_error, E_USER_ERROR);
}
// INSERT
$v2 = "'" . $conn -> real_escape_string($activeModelUUID) . "'";
$v4 = "'" . $conn -> real_escape_string($taskId) . "'";
$v5 = "'" . $conn -> real_escape_string($actionRequired) . "'";
		
$sql="UPDATE `model_creation_suite_has_prepared_by_records` SET status='FALSE', action_required=$v5 WHERE model_UUID=$v2 AND task_id=$v4";
  		
if($conn->query($sql) === false) {
	trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
	$affected_rows = $conn->affected_rows;
	echo $_GET['callback'] . '(' . "{'message' : 'Task $taskId was set as not complete'}" . ')';
		  }
  
  