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
error_reporting(E_ALL);
ini_set('display_errors', '1');
//INSERT
$v2 = "'" . $conn->real_escape_string($activeModelUUID) . "'";
$v3 = "'" . $conn->real_escape_string($activePositionId) . "'";
$v4 = "'" . $conn->real_escape_string($activeJobDescriptionId) . "'";
$v5 = "'" . $conn->real_escape_string($activePolicyId) . "'";
$v6 = "'" . $conn->real_escape_string($activeProcedureUUID) . "'";
$v7 = "'" . $conn->real_escape_string($activeStepId) . "'";
$v8 = "'" . $conn->real_escape_string($activeTaskId) . "'";
$v9 = "'" . $conn->real_escape_string($username) . "'";

//2. Insert the activeStepId into UUID
$sqlins = "INSERT INTO ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID (legal_entity_id, model_id, position_id, jobDescription_id, policy_id, procedure_id, step_id, task_id, created_by) VALUES ('0','0','0','0','0','0',$v7,'0',$v9)";

if ($conn->query($sqlins) === false) {
    trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
    
    //3. Insert a row in the hierarchy object closureTable so our position is tied to the current activeModel in the hierarchy object table.
    //4. Insert a row in the hierarchy object closureTable so the position is tied to itself in the hierarchy object table.
    $last_inserted_step_uuid = $conn->insert_id;
    $sqlins2 = "INSERT INTO ubm_modelcreationsuite_heirarchy_object_closureTable ( ancestor_id, descendant_id, path_length, created_by ) 
						VALUES ( $last_inserted_step_uuid, $last_inserted_step_uuid, '0', $v9 )";
    if ($conn->query($sqlins2) === false) {
        trigger_error('Wrong SQL: ' . $sqlins2 . ' Error: ' . $conn->error, E_USER_ERROR);
    } else {
        
        //5. Now INSERT the links to all the ancestors of the ST_UUID into the Closure table so has a tie to all ojects above it.
        $sqlins3 = "INSERT INTO ubm_modelcreationsuite_heirarchy_object_closureTable(ancestor_id, descendant_id, path_length)
						 SELECT a.ancestor_id, d.descendant_id, a.path_length+d.path_length+1
						   FROM ubm_modelcreationsuite_heirarchy_object_closureTable a, ubm_modelcreationsuite_heirarchy_object_closureTable d
						  WHERE a.descendant_id=$v6 
						  	AND d.ancestor_id=$last_inserted_step_uuid";
        if ($conn->query($sqlins3) === false) {
            trigger_error('Wrong SQL: ' . $sqlins3 . ' Error: ' . $conn->error, E_USER_ERROR);
            echo "there was a problem";
        } else {
            $sqlsel1="SELECT *                  
            FROM ubm_modelcreationsuite_heirarchy_object_closureTable
            JOIN ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID
            ON ubm_modelcreationsuite_heirarchy_object_closureTable.descendant_id=ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.UUID
            JOIN ubm_model_stepUUID_has_stepnumber
            ON ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.UUID=ubm_model_stepUUID_has_stepnumber.step_UUID
            JOIN ubm_model_steps
            ON ubm_model_steps.id=ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.step_id
            WHERE ubm_modelcreationsuite_heirarchy_object_closureTable.ancestor_id= $activeProcedureUUID
            AND ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.step_id>0
            ORDER BY step_number";
            $rs1=$conn->query($sqlsel1);
            if($rs1 === false) {
              trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
            } else {
                $rows_returned = $rs1->num_rows +1;
            }
            $sqlins4 = "INSERT INTO ubm_model_stepUUID_has_stepnumber (step_UUID, step_number, created_by) 
                        VALUES ( $last_inserted_step_uuid, $rows_returned, '$username')";
            if ($conn->query($sqlins4) === false) {
            trigger_error('Wrong SQL: ' . $sqlins4 . ' Error: ' . $conn->error, E_USER_ERROR);
            echo "there was a problem";
            } else {
                echo $_GET['callback'] . '(' . "{'message' : 'Requested Step $v7 was created successfully and added to ProcedureId $v6 !'}" . ')';
            }
        }
    }
}
