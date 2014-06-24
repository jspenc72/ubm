<?php
require_once('globalGetVariables.php');
//require_once('ubms_db_config.php');
require_once('DBConnect_UBMv1.php');		//Provides the variables used for UBMv1 database connection $conn

$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
// check connection
if ($conn -> connect_error) {
	trigger_error('Database connection failed: ' . $conn -> connect_error, E_USER_ERROR);
}
$v2 = "'" . $conn -> real_escape_string($activeUUID) . "'";
//SELECT
$all_items = array();
//1. Select all records for checklist items stored in model_creation_suite, Count the number of items in the checklist.
			$sqlsel1="SELECT * FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID WHERE UUID=$v2";
			$rs1=$conn->query($sqlsel1);
			if($rs1 === false) {
			  trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
			} else {
				if(mysqli_num_rows($rs1)>0){
//2. Add the result set to the $all_items [] array	
					while ($items = $rs1->fetch_assoc()) {
						$modelId = stripslashes($items['model_id']);
						$positionId = stripslashes($items['position_id']);
						$jobDescriptionId = stripslashes($items['jobDescription_id']);
						$policyId = stripslashes($items['policy_id']);
						$procedureId = stripslashes($items['procedure_id']);
						$stepId = stripslashes($items['step_id']);
						$taskId = stripslashes($items['task_id']);
						
						if($modelId >= 1) {
							$objectType = "MD";
							$sqlsel2="SELECT * FROM ubm_model WHERE id=$modelId";
							$rs2=$conn->query($sqlsel2);
						} elseif ($positionId >=1) {
							$objectType = "PS";
							$sqlsel2="SELECT * FROM ubm_model_positions WHERE id=$positionId";
							$rs2=$conn->query($sqlsel2);
						} elseif ($jobDescriptionId >=1) {
							$objectType = "JD";
							$sqlsel2="SELECT * FROM ubm_model_jobDescriptions WHERE id=$jobDescriptionId";
							$rs2=$conn->query($sqlsel2);
						} elseif ($policyId >=1) {
							$objectType = "PL";
							$sqlsel2="SELECT * FROM ubm_model_policies WHERE id=$policyId";
							$rs2=$conn->query($sqlsel2);
						} elseif ($procedureId >=1) {
							$objectType = "PR";
							$sqlsel2="SELECT * FROM ubm_model_procedures WHERE id=$procedureId";
							$rs2=$conn->query($sqlsel2);
						} elseif ($stepId >=1) {
							$objectType = "ST";
							$sqlsel2="SELECT * FROM ubm_model_steps WHERE id=$stepId";
							$rs2=$conn->query($sqlsel2);
						} elseif ($taskId >=1) {
							$objectType = "TK";
							$sqlsel2="SELECT * FROM ubm_model_tasks WHERE id=$taskId";
							$rs2=$conn->query($sqlsel2);
						} else {
							echo "ERROR";
						}
						if($rs2 === false) {
						  trigger_error('Wrong SQL: ' . $sqlsel2 . ' Error: ' . $conn->error, E_USER_ERROR);
						} else {
							while ($items2 = $rs2->fetch_assoc()) {
								$items2 ['object_type'] = $objectType;
								$all_items [] = $items2;
							}	
						}		
					}				
//6. JSONP packaged $all_items array
							echo $_GET['callback'] . '(' . json_encode($all_items) . ')';				//Output $all_items array in json encoded format.		
				}else{
				
				}								
			}
