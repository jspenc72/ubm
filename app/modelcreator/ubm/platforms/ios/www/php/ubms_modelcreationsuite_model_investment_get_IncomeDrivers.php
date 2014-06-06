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
			FROM ubm_model_investment_has_income_drivers  
			JOIN ubm_model_investment_income_drivers
			ON ubm_model_investment_has_income_drivers.income_driver_id=ubm_model_investment_income_drivers.id
			WHERE ubm_model_investment_has_income_drivers.investment_id=$activeModelInvestmentId
			ORDER BY ubm_model_investment_income_drivers.id";													//Get all alternatives for current model.
			//Select all 
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

	 