<?php
require_once('globalGetVariables.php');
require_once('ubms_db_config.php');
require_once('DBConnect_UBMv1.php');		//Provides the variables used for UBMv1 database connection $conn
$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
// check connection
if ($conn -> connect_error) {
	trigger_error('Database connection failed: ' . $conn -> connect_error, E_USER_ERROR);
}
$v3 = "'" . $conn -> real_escape_string($checklistTitle) . "'";
$v4 = "'" . $conn -> real_escape_string($checklistDescription) . "'";
$v5 = "'" . $conn -> real_escape_string($username) . "'";
$v6 = "'" . $conn -> real_escape_string($checklistPurpose) . "'";
	//1. Insert Position into the ubm_model_checklists table.
$sqlins = "INSERT INTO ubm_model_checklists (title, description, purpose, created_by) 
			VALUES ( $v3, $v4, $v6, $v5 )"; //Creates a New Position record.
if ($conn -> query($sqlins) === false) {
	trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn -> error, E_USER_ERROR);
} else {
	$last_inserted_id = $conn -> insert_id;
	$affected_rows = $affected_rows + $conn -> affected_rows;
	//2. Make an entry in the antiSlipsism table to generate a Universal Unique Identifier for the Position to create an instance that will allow objects to be attached to it.
	$sqlins2 = "INSERT INTO ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID (checklist_id, created_by) 
				VALUES ( $last_inserted_id , $v5 )";
	if ($conn -> query($sqlins2) === false) {
		trigger_error('Wrong SQL: ' . $sqlins2 . ' Error: ' . $conn -> error, E_USER_ERROR);
	} else {
			$last_inserted_CL_UUID = $conn -> insert_id;		
			$affected_rows = $affected_rows + $conn -> affected_rows;
			$sqlins3 =  "INSERT INTO ubm_modelcreationsuite_heirarchy_object_closureTable(ancestor_id, descendant_id, path_length)
					 VALUES ( $last_inserted_CL_UUID , $last_inserted_CL_UUID,'0' )";
		if ($conn -> query($sqlins3) === false) {
			trigger_error('Wrong SQL: ' . $sqlins3 . ' Error: ' . $conn -> error, E_USER_ERROR);
		} else {
			$affected_rows = $affected_rows + $conn -> affected_rows;	
			echo $_GET['callback'] . '(' . "{'message' : 'The affected rows is: $affected_rows . Requested Checklist $v3 was created successfully, given the UUID: $last_inserted_CL_UUID.'}" . ')';
		}
	}
}
