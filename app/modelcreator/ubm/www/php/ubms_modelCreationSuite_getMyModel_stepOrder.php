<?php
require_once('globalGetVariables.php');
require_once('ubms_db_config.php');
require_once('DBConnect_UBMv1.php');		//Provides the variables used for UBMv1 database connection $conn
error_reporting(E_ALL);
    ini_set('display_errors', '1');
$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
// check connection
	if ($conn->connect_error) {
	  trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
	}
//SELECT
$all_items = array();
//1. Select all records for checklist items stored in model_creation_suite, Count the number of items in the checklist.
			$sqlsel1="SELECT * 					
			FROM ubm_modelcreationsuite_heirarchy_object_closureTable
			JOIN ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID
			ON ubm_modelcreationsuite_heirarchy_object_closureTable.descendant_id=ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.UUID
			JOIN ubm_model_stepUUID_has_stepnumber
			ON ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.UUID=ubm_model_stepUUID_has_stepnumber.step_UUID
			JOIN ubm_model_steps
			ON ubm_model_steps.id=ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.step_id
			WHERE ubm_modelcreationsuite_heirarchy_object_closureTable.ancestor_id= $activeModelUUID
			AND ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.step_id>0
			ORDER By step_number";
			$rs1=$conn->query($sqlsel1);
			if($rs1 === false) {
			  trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
			} else {
				if(mysqli_num_rows($rs1)>0){
//2. Add the result set to the $all_items [] array	
					while ($items = $rs1->fetch_assoc()) {
						$all_items [] = $items;		
					}				
//6. JSONP packaged $all_items array
							echo $_GET['callback'] . '(' . json_encode($all_items) . ')';				//Output $all_items array in json encoded format.		
				}else{
				
				}								
			}

			
