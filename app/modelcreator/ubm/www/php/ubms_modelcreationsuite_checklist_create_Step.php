<?php
require_once ('globalGetVariables.php');
require_once ('ubms_db_config.php');
require_once ('DBConnect_UBMv1.php');
// error_reporting(E_ALL);
// ini_set('display_errors', '1');

$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
$username = $_GET['username'];
$stepTitle = $_GET['stepTitle'];
$stepInstruction = $_GET['stepInstruction'];
$stepAlertType = $_GET['stepAlertType'];
$stepAlertText = $_GET['stepAlertText'];
$allottedTimeHrs = $_GET['allottedTimeHrs'];
$allottedTimeMin = $_GET['allottedTimeMin'];
$stepAlertText = $_GET['stepAlertText'];
$activeChecklistUUID = $_GET['activeChecklistUUID'];

// check connection 
if ($conn->connect_error) {
    trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
}
//INSERT
$v2 = "'" . $conn -> real_escape_string($username) . "'";
$v3 = "'" . $conn -> real_escape_string($stepTitle) . "'";
$v4 = "'" . $conn -> real_escape_string($stepInstruction) . "'";
$v5 = "'" . $conn -> real_escape_string($stepAlertType) . "'";
$v6 = "'" . $conn -> real_escape_string($stepAlertText) . "'";
$v7 = "'" . $conn -> real_escape_string($allottedTimeHrs) . "'";
$v8 = "'" . $conn -> real_escape_string($allottedTimeMin) . "'";
$v9 = "'" . $conn -> real_escape_string($activeChecklistUUID) . "'";

$sqlins = "INSERT INTO ubm_model_steps (created_by, title, instruction, alert_type, alert_text, allotted_time_hrs, allotted_time_min)
            VALUES ($v2,$v3,$v4,$v5,$v6,$v7,$v8)";
if ($conn -> query($sqlins) === false) {
    echo "test";
    //trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn -> error, E_USER_ERROR);
} else {
	$last_inserted_ST_id = $conn -> insert_id;
	$affected_rows = $conn -> affected_rows;
	if($affected_rows>0){
		require('ubms_modelcreationsuite_create_hierarchical_relationship.php');		
		$stepRelationship = createChildUUIDwithHierarchicalRelationship($v9, $last_inserted_ST_id, "ST", $v2, $DBServer, $DBUser, $DBPass, $DBName);
		if($stepRelationship['status']==TRUE){
//1. Create specification of the checklistItem
			$InstanceUUID = $stepRelationship['NewChildUUID'];
		    $sqlins = "INSERT INTO ubm_model_checklistItems (Instance_UUID, created_by) VALUES ($InstanceUUID, $v2)";
		    if ($conn->query($sqlins) === false) {
		        trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn->error, E_USER_ERROR);
		    } else {
				$last_inserted_CLI_id = $conn -> insert_id;
				$itemRelationship = createChildUUIDwithHierarchicalRelationship($v9, $last_inserted_CLI_id, "CLI", $v2, $DBServer, $DBUser, $DBPass, $DBName);
				if($itemRelationship['status']==TRUE){
					echo $_GET['callback'] . '(' . "{'message' : 'Checklist Step: $last_inserted_ST_id was created successfully!'}" . ')';	
				}else{
					echo $_GET['callback'] . '(' . "{'message' : 'Checklist Item: $last_inserted_id was not created or tied to the checklist!'}" . ')';	
				}
		    }		
		}else{
			echo $_GET['callback'] . '(' . "{'message' : 'Checklist Step: $last_inserted_id was not tied to the checklist!'}" . ')';	
		}
	}
}