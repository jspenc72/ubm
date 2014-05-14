<?php
require_once('globalGetVariables.php');
//require_once('ubms_db_config.php');
require_once('DBConnect_UBMv1.php');		//Provides the variables used for UBMv1 database connection $conn

$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
// check connection
	if ($conn->connect_error) {
	  trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
	}
//SELECT
$all_items = array();
//1. Select all records for checklist items stored in model_creation_suite, Count the number of items in the checklist.
			$sqlsel1="SELECT * FROM ubm_model_has_alternatives WHERE model_UUID=$activeModelUUID";		//Select all 
			$rs1=$conn->query($sqlsel1);
			if($rs1 === false) {
			  trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
			} else{
				while ($items1 = $rs1->fetch_assoc()) {
					$returnItemId = stripslashes($items1['alternative_id']);
					$sqlsel2="SELECT * FROM ubm_model_alternatives WHERE id=$returnItemId AND decision='Use Now'";		//Select all 
					$rs2=$conn->query($sqlsel2);
					if($rs2 === false) {
					  trigger_error('Wrong SQL: ' . $sqlsel2 . ' Error: ' . $conn->error, E_USER_ERROR);
					} else {
						while ($items2 = $rs2->fetch_assoc()) {
							$returnItemId2 = stripslashes($items2['id']);
							$sqlsel3="SELECT * FROM ubm_model_alternative_has_investments WHERE alternative_id=$returnItemId2";		//Select all 
							$rs3=$conn->query($sqlsel3);
							if($rs2 === false) {
							  trigger_error('Wrong SQL: ' . $sqlsel3 . ' Error: ' . $conn->error, E_USER_ERROR);
							} else {
								while ($items3 = $rs3->fetch_assoc()) {
									$returnItemId3 = stripslashes($items3['investment_id']);
									$sqlsel4="SELECT * FROM ubm_model_investments WHERE id=$returnItemId3";		//Select all 
									$rs4=$conn->query($sqlsel4);
									if($rs3 === false) {
									  trigger_error('Wrong SQL: ' . $sqlsel3 . ' Error: ' . $conn->error, E_USER_ERROR);
									} else {
										while ($items4 = $rs4->fetch_assoc()) {				
											$all_items [] = $items4;
										}	
									}									
								}	
							}									
						}
					}									
				}								
			}

//6. JSONP packaged $all_items array
			echo $_GET['callback'] . '(' . json_encode($all_items) . ')';				//Output $all_items array in json encoded format.
	 