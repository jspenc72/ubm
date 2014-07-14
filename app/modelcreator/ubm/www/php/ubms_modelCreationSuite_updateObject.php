<?php
require_once('globalGetVariables.php');
require_once('ubms_db_config.php');
require_once('DBConnect_UBMv1.php');		//Provides the variables used for UBMv1 database connection $conn
error_reporting(E_ALL);
ini_set('display_errors', '1');
$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
// check connection
if ($conn -> connect_error) {
	trigger_error('Database connection failed: ' . $conn -> connect_error, E_USER_ERROR);
}
// Switch statement check the object type and creates the appropriate variable depending on the object_type passed
$objectType = $objectArray['object_type'];
switch ($objectType) {
  case 'PS':
    $table = 'ubm_model_positions';
    $object = 'position_id';
    break;
  case 'JD':
    $table = 'ubm_model_jobDescriptions';
    $object = 'jobDescription_id';
    break;
  case 'PL':
    $table = 'ubm_model_policies';
    $object = 'policy_id';
    break;
  case 'PR':
    $table = 'ubm_model_procedures';
    $object = 'procedure_id';
    break;
  case 'ST':
    $table = 'ubm_model_steps';
    $object = 'step_id';
    break;
  case 'TK':
    $table = 'ubm_model_tasks';
    $object = 'task_id';
    break;
  default:
   echo "The correct object type was not given $objectType";
   die();
}
//get the activeObjectId from the objectUUID
$sqlsel1 = "SELECT * FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID WHERE UUID=$activeObjectUUID";
$rs1 = $conn->query($sqlsel1);
if ($rs1 === false) {
    trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
    while ($items1 = $rs1->fetch_assoc()) {
    	//pass in 'object' variable as column name
        $activeObjectId = stripslashes($items1[$object]);
    }
    //add 'adapted from' id to object array
    $objectArray['adapted_from_id'] = $activeObjectId;
    //add userame to object array
	$objectArray['creator_username'] = $username;
	// assign keys to the column variable
	$columns = implode(", ",array_keys($objectArray));
	//escape all the inputs in the array
	$escaped_values = mysqli_real_escape_string($conn, $objectArray);
	//store the escaped values into the values variable
	$values  = implode(", ", $escaped_values);
	//insert the modified object into the appropriate specification table
	$sqlins = "INSERT INTO $table ($columns) VALUES ($values)";
	if ($conn -> query($sqlins) === false) {
		trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn -> error, E_USER_ERROR);
	} else {
		//get laster inserted id
		$last_inserted_id = $conn->insert_id;
		// Upadate the object id in the anti solipsism table to point to the new object id
		$sql="UPDATE `ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID` SET $object=$last_inserted_id WHERE UUID=$activeObjectUUID";
		if($conn->query($sql) === false) {
		  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
		} else {
			// get the amount of affected rows
			$affected_rows = $conn->affected_rows;
			//display a message
			echo $_GET['callback'] . '(' . "{'message' : 'Object was successfully modified. Affected Rows: $affected_rows'}" . ')';
		}
	}
}
