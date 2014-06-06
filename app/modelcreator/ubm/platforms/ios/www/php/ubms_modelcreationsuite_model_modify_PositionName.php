<?php
require_once('globalGetVariables.php');
require_once('ubms_db_config.php');
require_once('DBConnect_UBMv1.php');		 //Provides the variables used for UBMv1 database connection $conn

$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
//    check connection
if ($conn -> connect_error) {
	trigger_error('Database connection failed: ' . $conn -> connect_error, E_USER_ERROR);
}
// INSERT
$v2 = "'" . $conn -> real_escape_string($email) . "'";
$v3 = "'" . $conn -> real_escape_string($name) . "'";
$v4 = "'" . $conn -> real_escape_string($positionNameId) . "'";
		
$sql="UPDATE `ubm_modelCreationSuite_orgChart_positionName` SET email=$v2, name=$v3 WHERE id=4";
  		
if($conn->query($sql) === false) {
	trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
	$affected_rows = $conn->affected_rows;
	echo $_GET['callback'] . '(' . "{'message' : 'The new email is $v2 and the new name is $v3'}" . ')';
		  }
  
  
  
