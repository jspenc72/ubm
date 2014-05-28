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
//1. Select all records in the ubm_model_alternatives table that have an instance created in the ubm_model_has_alternatives table for the activeModelId.
			$sqlsel1="SELECT * 					
			FROM ubm_model_has_investments  
			JOIN ubm_model_investments 
			ON ubm_model_has_alternatives.alternative_id=ubm_model_alternatives.id
			WHERE ubm_model_has_alternatives.model_UUID='$activeModelUUID'
			ORDER BY ubm_model_alternatives.id";												//Get all alternatives for current model.
			//Select all 
			$rs1=$conn->query($sqlsel1);
			if($rs1 === false) {
			  trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
			} else {
				if(mysqli_num_rows($rs1)>0){
//2. Add the result set to the $all_items [] array	
					while ($items = $rs1->fetch_assoc()) {
						$returnItemId = stripslashes($items['id']);
						$sqlsel2="SELECT * 						
						FROM ubm_model_alternative_has_investments 
						JOIN ubm_model_invesetments 
						ON ubm_model_alternative_has_investment.investment_id=ubm_model_investments.id
						WHERE ubm_model_alternative_has_investments.alternative_id='$returnItemId'";											//Get all risks for the current alternative.
						//Select all 
						$rs2=$conn->query($sqlsel2);
						if($rs2 === false) {
						  trigger_error('Wrong SQL: ' . $sqlsel2 . ' Error: ' . $conn->error, E_USER_ERROR);
						} else {
							while ($items2 = $rs2->fetch_assoc()) {
								$returnItemId2 = stripslashes($items['investment_id']);
								$sqlsel3="SELECT * 						
								FROM ubm_model_investment_has_risks  
								JOIN ubm_model_risks 
								ON ubm_model_investment_has_risks.risk_id=ubm_model_risks.id
								WHERE ubm_model_investment_has_risks.investment_id='$returnItemId'
								ORDER BY ubm_model_risks.id";											//Get all risks for the current alternative.
								//Select all 
								$rs3=$conn->query($sqlsel3);
								if($rs3 === false) {
								  trigger_error('Wrong SQL: ' . $sqlsel2 . ' Error: ' . $conn->error, E_USER_ERROR);
								} else {
									while ($items3 = $rs3	->fetch_assoc()) {
										if(mysqli_num_rows($rs3)>0){
											$all_items [] = $items3;
										}
									}
								}
							}
						}
					}				
//6. JSONP packaged $all_items array
							echo $_GET['callback'] . '(' . json_encode($all_items) . ')';				//Output $all_items array in json encoded format.			
				}else{
				
				}								
			}

	 