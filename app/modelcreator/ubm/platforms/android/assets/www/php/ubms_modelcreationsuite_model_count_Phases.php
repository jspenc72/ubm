 <?php
require_once('globalGetVariables.php');
require_once('ubms_db_config.php');
require_once('DBConnect_UBMv1.php');		//Provides the variables used for UBMv1 database connection $conn
 		
	$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
	// check connection
	if ($conn->connect_error) {
	  trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
	}
$v4 = "'" . $conn -> real_escape_string($activePhaseId) . "'";
//SELECT
$all_items = array();
//1. Select all records for checklist items stored in model_creation_suite, Count the number of items in the checklist.
			$sqlsel1="SELECT phase_id FROM model_creation_suite
						WHERE phase_id=$v4";		//Select all 
			$rs1=$conn->query($sqlsel1);
			if($rs1 === false) {
			  trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
			} else{
				 $num_rows = mysqli_num_rows($rs1);
			}
//6. JSONP packaged $all_items array
			echo $_GET['callback'] . '(' . "{'message' : 'Query Successful','num_rows' : '$num_rows'}" . ')';				//Output $all_items array in json encoded format.
	 