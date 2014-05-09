 <?php
require_once('globalGetVariables.php');
require_once('ubms_db_config.php');
require_once('DBConnect_UBMv1.php');		//Provides the variables used for UBMv1 database connection $conn
 		
	$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
	// check connection
	if ($conn->connect_error) {
	  trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
	}
$v4 = "'" . $conn -> real_escape_string($activeModelUUID) . "'";
$v5 = "'" . $conn -> real_escape_string($activePhaseId) . "'";
//SELECT
$all_items = array();
//1. Select all records for checklist items stored in model_creation_suite, Count the number of items in the checklist.
			$sqlsel1="SELECT * FROM model_creation_suite
						JOIN model_creation_suite_has_prepared_by_records
						ON model_creation_suite.line_number=model_creation_suite_has_prepared_by_records.task_id
						WHERE model_UUID=$v4 AND phase_id=$v5";		//Select all 
			$rs1=$conn->query($sqlsel1);
			if($rs1 === false) {
			  trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
			} else{
				$num_rows = mysqli_num_rows($rs1);
			}
//6. JSONP packaged $all_items array
			echo $_GET['callback'] . '(' . "{'message' : 'Query Successful','num_rows' : '$num_rows'}" . ')';
	 