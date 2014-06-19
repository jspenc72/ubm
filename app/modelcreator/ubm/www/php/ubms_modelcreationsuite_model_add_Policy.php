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
$v3 = "'" . $conn -> real_escape_string($activePositionId) . "'";
$v4 = "'" . $conn -> real_escape_string($activeJobDescriptionUUID) . "'";
$v5 = "'" . $conn -> real_escape_string($activePolicyId) . "'";
$v6 = "'" . $conn -> real_escape_string($activeProcedureId) . "'";
$v7 = "'" . $conn -> real_escape_string($activeStepId) . "'";
$v8 = "'" . $conn -> real_escape_string($activeTaskId) . "'";
$v9 = "'" . $conn -> real_escape_string($username) . "'";

//2. Insert the activePolicyId into the UUID table, creating a new instance of the Policy specification.
$sqlins = "INSERT INTO ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID (legal_entity_id, model_id, position_id, jobDescription_id, policy_id, procedure_id, step_id, task_id, created_by) VALUES ('0','0','0','0',$v5,'0','0','0',$v9)";
if ($conn -> query($sqlins) === false) {
	trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn -> error, E_USER_ERROR);
} else {
//3. Insert a row in the hierarchy object closureTable so the policy is tied to itself in the hierarchy object table.
	$last_inserted_policy_uuid = $conn -> insert_id;	
	$sqlins2 = "INSERT INTO ubm_modelcreationsuite_heirarchy_object_closureTable ( ancestor_id, descendant_id, path_length, created_by ) 
						VALUES ( $last_inserted_policy_uuid, $last_inserted_policy_uuid, '0', $v9 )";
	if ($conn -> query($sqlins2) === false) {
		trigger_error('Wrong SQL: ' . $sqlins2 . ' Error: ' . $conn -> error, E_USER_ERROR);
	} else {
//5. Now INSERT the links to all the ancestors of the PL_UUID into the Closure table so has a tie to all ojects above it.
			$sqlins3 =  "INSERT INTO ubm_modelcreationsuite_heirarchy_object_closureTable(ancestor_id, descendant_id, path_length)
						 SELECT a.ancestor_id, d.descendant_id, a.path_length+d.path_length+1
						   FROM ubm_modelcreationsuite_heirarchy_object_closureTable a, ubm_modelcreationsuite_heirarchy_object_closureTable d
						  WHERE a.descendant_id=$v4 
						  	AND d.ancestor_id=$last_inserted_policy_uuid";
			if ($conn -> query($sqlins3) === false) {
				trigger_error('Wrong SQL: ' . $sqlins3 . ' Error: ' . $conn -> error, E_USER_ERROR);
				echo "there was a problem";
			} else {
				$affected_rows = $conn->affected_rows;
				$last_inserted = $conn -> insert_id;
				echo $_GET['callback'] . '(' . "{'message' : 'Requested Policy $v5 was created successfully and added to jobDescriptionId $v4, the number of affected rows is: $affected_rows the relationship in the closure table is $last_inserted!'}" . ')';
			}		
	}
}