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
$v3 = "'" . $conn -> real_escape_string($description) . "'";
$v4 = "'" . $conn -> real_escape_string($title) . "'";
$v5 = "'" . $conn -> real_escape_string($username) . "'";
$v6 = "'" . $conn -> real_escape_string($purpose) . "'";
$v7 = "'" . $conn -> real_escape_string($activeObjectUUID) . "'";
$v8 = "'" . $conn -> real_escape_string($scope) . "'";
$v9 = "'" . $conn -> real_escape_string($effectiveDate) . "'";
 echo $_GET['callback'] . '(' . "{'message' : '2: $v2, 3: $v3, 4: $v4, 5: $v5, 6: $v6, 7: $v7, 8: $v8, 9: $v9 !'}" . ')';

$sqlins = "INSERT INTO ubm_model_procedures (description, title, created_by, purpose, scope, effective_date) 
			VALUES ( $v3, $v4, $v5, $v6, $v8, $v9 )"; //Creates a New Core Value record.
if ($conn -> query($sqlins) === false) {
	trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn -> error, E_USER_ERROR);
} else {
//2. Create a UUID for the Procedure that was created.
	$last_inserted_PR_id = $conn -> insert_id;
	//$affected_rows = $conn -> affected_rows;
	$sqlins2 = "INSERT INTO ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID (legal_entity_id, model_id, position_id, jobDescription_id, policy_id, procedure_id, step_id	, task_id, created_by) 
				VALUES ( '0','0','0','0','0', $last_inserted_PR_id,'0','0',$v5 )";
	if ($conn -> query($sqlins2) === false) {
		trigger_error('Wrong SQL: ' . $sqlins2 . ' Error: ' . $conn -> error, E_USER_ERROR);
	} else {		
//3. Now INSERT the ST_UUID into the Closure table so it reports to itself.
		$last_inserted_PR_UUID = $conn -> insert_id;
		$sqlins3 =  "INSERT INTO ubm_modelcreationsuite_heirarchy_object_closureTable(ancestor_id, descendant_id, path_length)
					 VALUES ( $last_inserted_PR_UUID,$last_inserted_PR_UUID,'0' )";
		if ($conn -> query($sqlins3) === false) {
			trigger_error('Wrong SQL: ' . $sqlins3 . ' Error: ' . $conn -> error, E_USER_ERROR);
			echo "there was a problem";
		} else {
			$closure_self_link_id = $conn -> insert_id;
//4. Now INSERT the links to all the ancestors of the PR_UUID into the Closure table so has a tie to all ojects above it.			
			$sqlins3 =  "INSERT INTO ubm_modelcreationsuite_heirarchy_object_closureTable(ancestor_id, descendant_id, path_length)
						 SELECT a.ancestor_id, d.descendant_id, a.path_length+d.path_length+1
						   FROM ubm_modelcreationsuite_heirarchy_object_closureTable a, ubm_modelcreationsuite_heirarchy_object_closureTable d
						  WHERE a.descendant_id=$v7 
						  	AND d.ancestor_id=$last_inserted_PR_UUID";
			if ($conn -> query($sqlins3) === false) {
				trigger_error('Wrong SQL: ' . $sqlins3 . ' Error: ' . $conn -> error, E_USER_ERROR);
				echo "there was a problem";
			} else {
				echo $_GET['callback'] . '(' . "{'message' : 'Requested Procedure: $last_inserted_PR_id - $v4 was created successfully, given UUID: $last_inserted_PR_UUID and an instance created with self link id: $closure_self_link_id and attached to model id: $v2 !'}" . ')';
			}			
		}
	}
}