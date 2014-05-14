<?php
require_once('globalGetVariables.php');
require_once('ubms_db_config.php');
require_once('DBConnect_UBMv1.php');		//Provides the variables used for UBMv1 database connection $conn
			
	$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
	 
	// check connection
	if ($conn->connect_error) {
	  trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
	}
		 
//SELECT
		$sqlsel="SELECT * FROM ubm_model_has_members WHERE member_id='$username'";		//Select all model_id that $username has been added to.
		$rs=$conn->query($sqlsel);
		 
		if($rs === false) {
		  trigger_error('Wrong SQL: ' . $sqlsel . ' Error: ' . $conn->error, E_USER_ERROR);
		} else {			

			$all_items = array();
			while ($items = $rs->fetch_assoc()) {
					$returnedModelUUID = stripslashes($items['model_UUID']);			
					$sqlsel2="
					SELECT * FROM ubm_model 
						JOIN ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID
							ON ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.model_id=ubm_model.id
					WHERE ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.UUID='$returnedModelUUID'";		//Select all information for each model that was in the first result set...
					$rs2=$conn->query($sqlsel2);
					 
					if($rs2 === false) {												//If something is wrong...
					  trigger_error('Wrong SQL: ' . $sqlsel2 . ' Error: ' . $conn->error, E_USER_ERROR);
					} else {
							while ($items2 = $rs2->fetch_assoc()) {						//If nothing is wrong: add the model record to the $all_items array
								$all_items[] = $items2;
							}
					}			
				//$all_items[] = $items;
			}
		  $rows_returned = $rs->num_rows;
			//echo $_GET['callback'] . '(' . "{'message' : ''}" . ')';							
			echo $_GET['callback'] . '(' . json_encode($all_items) . ')';				//Output $all_items array in json encoded format.
		}	 