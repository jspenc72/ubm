<?php
require_once ('globalGetVariables.php');
require_once ('ubms_db_config.php');
require_once ('DBConnect_UBMv1.php');
// error_reporting(E_ALL);
// ini_set('display_errors', '1');

$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
$username = $_GET['username'];
$taskTitle = $_GET['taskTitle'];
$taskInstruction = $_GET['taskInstruction'];
$taskAlertType = $_GET['taskAlertType'];
$taskAlertText = $_GET['taskAlertText'];
$allottedTimeHrs = $_GET['allottedTimeHrs'];
$allottedTimeMin = $_GET['allottedTimeMin'];
$taskAlertText = $_GET['taskAlertText'];
$activeChecklistUUID = $_GET['activeChecklistUUID'];

// check connection 
if ($conn->connect_error) {
    trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
}
//INSERT
$v2 = "'" . $conn -> real_escape_string($username) . "'";
$v3 = "'" . $conn -> real_escape_string($taskTitle) . "'";
$v4 = "'" . $conn -> real_escape_string($taskInstruction) . "'";
$v5 = "'" . $conn -> real_escape_string($taskAlertType) . "'";
$v6 = "'" . $conn -> real_escape_string($taskAlertText) . "'";
$v7 = "'" . $conn -> real_escape_string($allottedTimeHrs) . "'";
$v8 = "'" . $conn -> real_escape_string($allottedTimeMin) . "'";
$v9 = "'" . $conn -> real_escape_string($activeChecklistUUID) . "'";

$sqlins = "INSERT INTO ubm_model_tasks (created_by, title, instruction, alert_type, alert_text, allotted_time_hrs, allotted_time_min)
            VALUES ($v2,$v3,$v4,$v5,$v6,$v7,$v8)";
if ($conn -> query($sqlins) === false) {
    echo "test";
    //trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn -> error, E_USER_ERROR);
} else {
	$last_inserted_TK_id = $conn -> insert_id;
	$affected_rows = $conn -> affected_rows;
	if($affected_rows>0){
		require('ubms_modelcreationsuite_create_hierarchical_relationship.php');		
		$taskRelationship = createChildUUIDwithHierarchicalRelationship($v9, $last_inserted_TK_id, "TK", $v2, $DBServer, $DBUser, $DBPass, $DBName);
		if($taskRelationship['status']==TRUE){
//1. Create specification of the checklistItem
			$InstanceUUID = $taskRelationship['NewChildUUID'];
		    $sqlins = "INSERT INTO ubm_model_checklistItems (Instance_UUID, created_by) VALUES ($InstanceUUID, $v2)";
		    if ($conn->query($sqlins) === false) {
		        trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn->error, E_USER_ERROR);
		    } else {
				$last_inserted_CLI_id = $conn -> insert_id;
				$itemRelationship = createChildUUIDwithHierarchicalRelationship($v9, $last_inserted_CLI_id, "CLI", $v2, $DBServer, $DBUser, $DBPass, $DBName);
				if($itemRelationship['status']==TRUE){
					echo $_GET['callback'] . '(' . "{'message' : 'Checklist Task: $last_inserted_TK_id was created successfully!'}" . ')';	
				}else{
					echo $_GET['callback'] . '(' . "{'message' : 'Checklist Item: $last_inserted_CLI_id was not created or tied to the checklist!'}" . ')';	
				}
		    }		
		}else{
			echo $_GET['callback'] . '(' . "{'message' : 'Checklist Task: $last_inserted_TK_id was not tied to the checklist!'}" . ')';	
		}
	}
}

