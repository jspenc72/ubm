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
$v3 = "'" . $conn -> real_escape_string($title) . "'";
$v6 = "'" . $conn -> real_escape_string($instruction) . "'";
$v7 = "'" . $conn -> real_escape_string($username) . "'";
$v8 = "'" . $conn -> real_escape_string($activeObjectUUID) . "'";
// echo $_GET['callback'] . '(' . "{'message' : '2: $v2, 3: $v3, 6: $v6, 7: $v7, 8: $v8 !'}" . ')';
$sqlins = "INSERT INTO ubm_model_tasks (title, instruction, created_by) VALUES ( $v3, $v6, $v7 )"; //Creates a New Core Value record.
if ($conn -> query($sqlins) === false) {
	trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn -> error, E_USER_ERROR);
} else {
	//2. Create a UUID for the Task that was created.
	$last_inserted_TK_id = $conn -> insert_id;
	//$affected_rows = $conn -> affected_rows;
	$sqlins2 = "INSERT INTO ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID (legal_entity_id, model_id, position_id, jobDescription_id, policy_id, procedure_id, step_id	, task_id, created_by) 
				VALUES ( '0','0','0','0','0','0','0',$last_inserted_TK_id,$v7 )";
	if ($conn -> query($sqlins2) === false) {
		trigger_error('Wrong SQL: ' . $sqlins2 . ' Error: ' . $conn -> error, E_USER_ERROR);
	} else {		
//3. Now INSERT the TA_UUID into the Closure table so it reports to itself.
		$last_inserted_TK_UUID = $conn -> insert_id;
		$sqlins3 =  "INSERT INTO ubm_modelcreationsuite_heirarchy_object_closureTable(ancestor_id, descendant_id, path_length)
					 VALUES ( $last_inserted_TK_UUID,$last_inserted_TK_UUID,'0' )";
		if ($conn -> query($sqlins3) === false) {
			trigger_error('Wrong SQL: ' . $sqlins3 . ' Error: ' . $conn -> error, E_USER_ERROR);
			echo "there was a problem";
		} else {
			$TK_UUID_Self_Link = $conn -> insert_id;
//4. Now INSERT the links to all the ancestors of the TA_UUID into the Closure table so has a tie to all ojects above it.			
        $sqlins7 = "INSERT INTO ubm_modelcreationsuite_heirarchy_object_closureTable(ancestor_id, descendant_id, path_length)
						 SELECT a.ancestor_id, d.descendant_id, a.path_length+d.path_length+1
						   FROM ubm_modelcreationsuite_heirarchy_object_closureTable a, ubm_modelcreationsuite_heirarchy_object_closureTable d
						  WHERE a.descendant_id=$v8 
						  	AND d.ancestor_id=$last_inserted_TK_UUID";
		if ($conn -> query($sqlins7) === false) {
			trigger_error('Wrong SQL: ' . $sqlins7 . ' Error: ' . $conn -> error, E_USER_ERROR);
			echo "there was a problem";
		} else {
				$rows_in_closure = $conn ->affected_rows;
				$sqlsel1="SELECT *                  
	            FROM ubm_modelcreationsuite_heirarchy_object_closureTable
	            JOIN ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID
	            ON ubm_modelcreationsuite_heirarchy_object_closureTable.descendant_id=ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.UUID
	            JOIN ubm_model_taskUUID_has_tasknumber
	            ON ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.UUID=ubm_model_taskUUID_has_tasknumber.task_UUID
	            JOIN ubm_model_tasks
	            ON ubm_model_tasks.id=ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.task_id
	            WHERE ubm_modelcreationsuite_heirarchy_object_closureTable.ancestor_id=$v8
	            AND ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.task_id>0
	            ORDER BY task_number";
	            $rs1=$conn->query($sqlsel1);
	            if($rs1 === false) {
	              trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
	            } else {
	                $rows_returned = $rs1->num_rows +1;
	            }
	            $sqlins4 = "INSERT INTO ubm_model_taskUUID_has_tasknumber (task_UUID, task_number, created_by) 
	                        VALUES ( $last_inserted_TK_UUID, $rows_returned, $v7 )";
	            if ($conn->query($sqlins4) === false) {
	            trigger_error('Wrong SQL: ' . $sqlins4 . ' Error: ' . $conn->error, E_USER_ERROR);
	            echo "there was a problem";
	            } else {
	                echo $_GET['callback'] . '(' . "{'message' : 'Requested Task $title was created successfully given the Task Id: $last_inserted_TK_id, an instance of the task was 
	                created and given UUID $last_inserted_TK_UUID and the self link the closure table is: $TK_UUID_Self_Link and rows in closure is: $rows_in_closure attached to Step: $v8 was added to model id: $v2 !'}" . ')';
	            }
			}			
		}
	}
}
