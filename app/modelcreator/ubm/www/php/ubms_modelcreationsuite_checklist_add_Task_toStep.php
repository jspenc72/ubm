<?php
require_once ('globalGetVariables.php');
require_once ('ubms_db_config.php');
require_once ('DBConnect_UBMv1.php');
 //Provides the variables used for UBMv1 database connection $conn

$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);

// check connection
if ($conn->connect_error) {
    trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
}

$username = $_GET['username'];
$activeStepUUID = $_GET['activeStepUUID'];
$activeTaskId = $_GET['activeTaskId'];

//INSERT
$v2 = "'" . $conn->real_escape_string($username) . "'";
$v3 = "'" . $conn->real_escape_string($activeStepUUID) . "'";
$v4 = "'" . $conn->real_escape_string($activeTaskId) . "'";

//Create an Instance of the Task
require('ubms_modelcreationsuite_create_hierarchical_relationship.php');        
$taskRelationship = createChildUUIDwithHierarchicalRelationship($v3, $v4, "TK", $v2, $DBServer, $DBUser, $DBPass, $DBName);
$taskRelationship['status'];
if($taskRelationship['status']==TRUE){
//1. Create specification of the checklistItem
    $InstanceUUID = $taskRelationship['NewChildUUID'];
    $sqlins = "INSERT INTO ubm_model_checklistItems (Instance_UUID, created_by) VALUES ($InstanceUUID, $v2)";
    if ($conn->query($sqlins) === false) {
        trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn->error, E_USER_ERROR);
    } else {
        $last_inserted_CLI_id = $conn -> insert_id;
        $itemRelationship = createChildUUIDwithHierarchicalRelationship($v3, $last_inserted_CLI_id, "CLI", $v2, $DBServer, $DBUser, $DBPass, $DBName);
        if($itemRelationship['status']==TRUE){
            echo $_GET['callback'] . '(' . "{'message' : 'Checklist Step: $last_inserted_ST_id was created successfully!'}" . ')';  
        }else{
            echo $_GET['callback'] . '(' . "{'message' : 'Checklist Item: $last_inserted_id was not created or tied to the checklist!'}" . ')'; 
        }
    }       
}else{
    echo $_GET['callback'] . '(' . "{'message' : 'Checklist Step: $last_inserted_id was not tied to the checklist!'}" . ')';    
}



//Create an Instance of the checklistItem

