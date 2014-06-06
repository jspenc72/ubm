<?php
echo "this is a test";

require_once('../globalGetVariables.php');
require_once('../ubms_db_config.php');
require_once('../DBConnect_UBMv1.php');		//Provides the variables used for UBMv1 database connection $conn	
$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
// check connection
if ($conn -> connect_error) {
	trigger_error('Database connection failed: ' . $conn -> connect_error, E_USER_ERROR);
}
//SELECT
$all_items = array();
//1. Select all records for checklist items stored in model_creation_suite, Count the number of items in the checklist.
			$sqlsel1="SELECT c.* FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID u
						JOIN ubm_modelcreationsuite_heirarchy_object_closureTable c
						ON (u.UUID=c.descendant_id)
						WHERE c.ancestor_id=$activeObjectUUID";
			
			//$sqlsel1="SELECT * FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID WHERE UUID=1";		//Select all 
			$rs1=$conn->query($sqlsel1);
			if($rs1 === false) {
			  trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
			} else{
				while ($items1 = $rs1->fetch_assoc()) {
					$all_items[] = $items1;
				}								
			}
//6. JSONP packaged $all_items array
			echo $_GET['callback'] . '(' . json_encode($all_items) . ')';				//Output $all_items array in json encoded format.
	 