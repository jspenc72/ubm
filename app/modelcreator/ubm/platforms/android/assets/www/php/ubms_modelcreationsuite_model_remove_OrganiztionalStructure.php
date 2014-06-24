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
$v3 = "'" . $conn -> real_escape_string($activeOrganizationalStructureId) . "'";

 $sql="DELETE FROM ubm_model_has_organizationalstructures WHERE organizationalstructure_id=$v3 AND model_UUID=$v2";

 if($conn->query($sql) === false) {
 	trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
 } else {
 	$affected_rows = $conn->affected_rows;
	echo $_GET['callback'] . '(' . "{'message' : 'The number of affected rows is $affected_rows. the Model modified was $v2.'}" . ')';

 }
