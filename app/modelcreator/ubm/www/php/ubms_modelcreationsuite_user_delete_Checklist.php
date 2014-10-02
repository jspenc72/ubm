<?php
require_once ('globalGetVariables.php');
require_once ('ubms_db_config.php');
require_once ('DBConnect_UBMv1.php');
//Provides the variables used for UBMv1 database connection $conn
$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
// check connection
if ($conn->connect_error) {
    trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
}
$v2 = "'" . $conn->real_escape_string($username) . "'";
$v7 = "'" . $conn->real_escape_string($activeChecklistUUID) . "'";
$all_items = array();
//1. Select all records for  items stored in ubm_model_alternative_has_pros for the current active alternative.

 $sql="SELECT * FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID WHERE UUID=$v7";
 $rs=$conn->query($sql);
 if($rs === false) {
 trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
 } else {
	 	$rows_returned = $rs->num_rows;
 	if($rows_returned==0){
	    echo $_GET['callback'] . '(' . "{'message' : 'The checklist UUID does not yet exist or has not been created.'}" . ')'; 		
 	}else{
	 	$rows_returned = $rs->num_rows;
		$rs->data_seek(0);
		while($row = $rs->fetch_assoc()){
			 $activeChecklistId = $row['checklist_id'];
		}
		$update = "UPDATE ubm_model_checklists SET Soft_DELETE='TRUE' WHERE id=$activeChecklistId";
		if ($conn->query($update) === false) {
		    trigger_error('Wrong SQL: ' . $update . ' Error: ' . $conn->error, E_USER_ERROR);
		} else {
		    $affected_rows = $conn->affected_rows;
		    echo $_GET['callback'] . '(' . "{'message' : 'The checklist was deleted successfully.'}" . ')';
		} 		
 	}
 }
