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

$all_items = array();
//1. Select all records for  items stored in ubm_model_alternative_has_pros for the current active alternative.
			$sqlsel1="SELECT * FROM ubm_model_alternative_has_cons WHERE alternative_id=$activeModelAlternativeId";		//Select all 
			$rs1=$conn->query($sqlsel1);
			if($rs1 === false) {
			  trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
			} else{
				while ($items1 = $rs1->fetch_assoc()) {
					$returnItemId = stripslashes($items1['con_id']);
					$sqlsel2="SELECT * FROM ubm_model_alternative_cons WHERE id=$returnItemId";		//Select all 
					$rs2=$conn->query($sqlsel2);
					if($rs2 === false) {
					  trigger_error('Wrong SQL: ' . $sqlsel2 . ' Error: ' . $conn->error, E_USER_ERROR);
					} else {
						while ($items2 = $rs2->fetch_assoc()) {				
							$all_items [] = $items2;
						}	
					}									
				}								
			}

//6. JSONP packaged $all_items array
			echo $_GET['callback'] . '(' . json_encode($all_items) . ')';				//Output $all_items array in json encoded format.
	 