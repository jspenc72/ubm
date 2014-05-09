<?php
 require_once('globalGetVariables.php'); 

$DBServer = 'localhost'; // e.g 'localhost' or '192.168.1.100'
$DBUser   = 'jessespe';
$DBPass   = 'Xfn73Xm0';
$DBName   = 'jessespe_UBMv1';			
$numberofresolutions = 2;
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
					$returnedModelId = stripslashes($items['model_id']);			
					$sqlsel2="SELECT * FROM ubm_model WHERE id='$returnedModelId'";		//Select all information for each model that was in the first result set...
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