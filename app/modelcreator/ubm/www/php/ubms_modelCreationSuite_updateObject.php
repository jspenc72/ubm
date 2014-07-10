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

$table = $objectArray['object_type'];
switch ($table) {
  case PS:
    $table = 'ubm_model_positions';
    $object = 'position_id';
    break;
  case JD:
    $table = 'ubm_model_jobDescriptions';
    $object = 'jobDescription_id';
    break;
  case PL:
    $table = 'ubm_model_policies';
    $object = 'policy_id';
    break;
  case PR:
    $table = 'ubm_model_procedures';
    $object = 'procedure_id';
    break;
  case ST:
    $table = 'ubm_model_steps';
    $object = 'step_id';
    break;
  case TK:
    $table = 'ubm_model_tasks';
    $object = 'task_id';
    break;
  default:
   echo "The correct object type was not given";
}

$sqlsel1 = "SELECT * FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID WHERE UUID=$activeObjectUUID";
$rs1 = $conn->query($sqlsel1);
if ($rs1 === false) {
    trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
    while ($items1 = $rs1->fetch_assoc()) {
        $activeObjectId = stripslashes($items1[$object]);
    }
}
$objectArray['adapted_from_id'] = $activeObjectId;
$objectArray['creator_username'] = $username;
$columns = implode(", ",array_keys($objectArray));

$escaped_values = array_map('mysql_real_escape_string', array_values($objectArray));
$values  = implode(", ",$escaped_values);

$sql = "INSERT INTO $table ($columns) VALUES ($values)";
if ($conn -> query($sqlins) === false) {
	trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn -> error, E_USER_ERROR);
} else {
	echo $_GET['callback'] . '(' . "{'message' : 'Object was successfully modified.'}" . ')';
}