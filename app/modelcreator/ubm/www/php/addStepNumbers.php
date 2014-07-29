<?php
require_once('globalGetVariables.php');
//require_once('ubms_db_config.php');
require_once('DBConnect_UBMv1.php');		//Provides the variables used for UBMv1 database connection $conn
error_reporting(E_ALL);
ini_set('display_errors', '1');
$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
if ($conn->connect_error) {
  trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
}
$sqlsel1="SELECT UUID FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID WHERE step_id >= 1";
$rs1=$conn->query($sqlsel1);
if($rs1 === false) {
  trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
	if(mysqli_num_rows($rs1)>0){
		while ($items = $rs1->fetch_assoc()) {
			$UUID = stripslashes($items['UUID']);
			$i=0;

			$sqlsel2="SELECT descendant_id FROM ubm_modelcreationsuite_heirarchy_object_closureTable WHERE ancestor_id=$UUID AND path_length=1";
			$rs2=$conn->query($sqlsel2);
			if($rs2 === false) {
			  trigger_error('Wrong SQL: ' . $sqlsel2 . ' Error: ' . $conn->error, E_USER_ERROR);
			} else {
				if(mysqli_num_rows($rs2)>0){
					while ($items = $rs2->fetch_assoc()) {
						$i++;
						$descendantId = stripslashes($items['descendant_id']);
						$sqlins4 = "INSERT INTO ubm_model_taskUUID_has_tasknumber (task_UUID, task_number, created_by) 
	                        VALUES ( $descendantId, $i, 'UBM')";
				            if ($conn->query($sqlins4) === false) {
				            trigger_error('Wrong SQL: ' . $sqlins4 . ' Error: ' . $conn->error, E_USER_ERROR);
				            echo "there was a problem";
				            } else {
				            }
					}				
				}else{
				}	
			}
		}				
	}else{
	}	
       echo "Done";
}

			
