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
//INSERT
$v2 = "'" . $conn->real_escape_string($activeChecklistUUID) . "'";
$v7 = "'" . $conn->real_escape_string($activeStepId) . "'";
$v8 = "'" . $conn->real_escape_string($activeTaskId) . "'";
$v9 = "'" . $conn->real_escape_string($username) . "'";

//Create an Instance of the Step
$sqlins = "INSERT INTO ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID (step_id, created_by) VALUES ($v7,$v9)";
if ($conn->query($sqlins) === false) {
    trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
    echo $affected_rows = $conn -> affected_rows;
    $last_inserted_step_UUID = $conn->insert_id;
//1. Create specification of the checklistItem
    $sqlins = "INSERT INTO ubm_model_checklistItems (Instance_UUID, created_by) VALUES ($last_inserted_step_UUID, $v9)";
    if ($conn->query($sqlins) === false) {
        trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn->error, E_USER_ERROR);
    } else {
        echo $affected_rows = $affected_rows + $conn -> affected_rows;
        $last_inserted_checklistItem_id = $conn->insert_id;
    //2. Create instance of the checklistItem specification
        $sqlins = "INSERT INTO ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID ( checklistItem_id, created_by) VALUES ( $last_inserted_checklistItem_id,$v9)";
        if ($conn->query($sqlins) === false) {
            trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn->error, E_USER_ERROR);
        } else {
            echo $affected_rows = $affected_rows + $conn -> affected_rows;
            $last_inserted_checklistItem_UUID = $conn->insert_id;
        //3. Create Self Link of the checklistItem instance
            $sqlins = "INSERT INTO ubm_modelcreationsuite_heirarchy_object_closureTable ( ancestor_id, descendant_id, path_length) VALUES ( $last_inserted_checklistItem_UUID,$last_inserted_checklistItem_UUID, '0')";
            if ($conn->query($sqlins) === false) {
                trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn->error, E_USER_ERROR);
            } else {
             echo $affected_rows = $affected_rows + $conn -> affected_rows;

            }
            //3. Create Self Link of the Step instance
            $sqlins = "INSERT INTO ubm_modelcreationsuite_heirarchy_object_closureTable ( ancestor_id, descendant_id, path_length) VALUES ( $last_inserted_step_UUID,$last_inserted_step_UUID, '0')";
            if ($conn->query($sqlins) === false) {
                trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn->error, E_USER_ERROR);
            } else {
             echo $affected_rows = $affected_rows + $conn -> affected_rows;

            }
            //5. Now attach checklistItem to Checklist.
            $sqlins3 = "INSERT INTO ubm_modelcreationsuite_heirarchy_object_closureTable(ancestor_id, descendant_id, path_length)
                             SELECT a.ancestor_id, d.descendant_id, a.path_length+d.path_length+1
                               FROM ubm_modelcreationsuite_heirarchy_object_closureTable a, ubm_modelcreationsuite_heirarchy_object_closureTable d
                              WHERE a.descendant_id=$v2
                                AND d.ancestor_id=$last_inserted_checklistItem_UUID";
            if ($conn->query($sqlins3) === false) {
                trigger_error('Wrong SQL: ' . $sqlins3 . ' Error: ' . $conn->error, E_USER_ERROR);
                echo "there was a problem";
            } else {
             echo "CT".$affected_rows = $affected_rows + $conn -> affected_rows;

                echo $_GET['callback'] . '(' . "{'message' : 'Requested Step: $activeStepId was created successfully and linked to ChecklistItem: $last_inserted_checklistItem_UUID. This checklist item was then attached to Checklist: $activeChecklistUUID ! Affected Rows with Closure Table: $affected_rows}" . ')';
            }
        }
    }
}
