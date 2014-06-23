<?php
require_once ('globalGetVariables.php');
require_once ('ubms_db_config.php');
require_once ('DBConnect_UBMv1.php');

//Provides the variables used for database connection $conn
$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);

// check connection
if ($conn->connect_error) {
    trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
}

$v2 = "'" . $conn->real_escape_string($activeModelUUID) . "'";
$v3 = "'" . $conn->real_escape_string($activePositionId) . "'";
$v4 = "'" . $conn->real_escape_string($positionReportsTo) . "'";
$v5 = "'" . $conn->real_escape_string($username) . "'";

// INSERT
//2. Insert the activePositionId into UUID
$sqlins = "INSERT INTO ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID (legal_entity_id, model_id, position_id, jobDescription_id, policy_id, procedure_id, step_id, task_id, created_by) 
			VALUES ('0','0',$v3,'0','0','0','0','0',$v5)";
if ($conn->query($sqlins) === false) {
    trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
    
    //3. Insert a row in the hierarchy object closureTable so our position is tied to the current activeModel in the hierarchy object table.
    //4. Insert a row in the hierarchy object closureTable so the position is tied to itself in the hierarchy object table.
    $last_inserted_PS_UUID = $conn->insert_id;
    $sqlins2 = "INSERT INTO ubm_modelcreationsuite_heirarchy_object_closureTable ( ancestor_id, descendant_id, path_length, created_by ) 
				VALUES ( $last_inserted_PS_UUID, $last_inserted_PS_UUID, '0', $v5 )";
    if ($conn->query($sqlins2) === false) {
        trigger_error('Wrong SQL: ' . $sqlins2 . ' Error: ' . $conn->error, E_USER_ERROR);
    } else {
        
        //5. Now INSERT the links to all the ancestors of the PS_UUID into the Closure table so has a tie to all ojects above it.
        $sqlins3 = "INSERT INTO ubm_modelcreationsuite_heirarchy_object_closureTable(ancestor_id, descendant_id, path_length)
					 SELECT a.ancestor_id, d.descendant_id, a.path_length+d.path_length+1
					   FROM ubm_modelcreationsuite_heirarchy_object_closureTable a, ubm_modelcreationsuite_heirarchy_object_closureTable d
					  WHERE a.descendant_id=$activeModelUUID 
					  	AND d.ancestor_id=$last_inserted_PS_UUID";
        if ($conn->query($sqlins3) === false) {
            trigger_error('Wrong SQL: ' . $sqlins3 . ' Error: ' . $conn->error, E_USER_ERROR);
            echo "there was a problem";
        } else {
            
            //6. Insert a self link into the position closure table.
            $sqlins5 = "INSERT INTO ubm_model_position_closure ( ancestor_UUID, descendant_UUID, path_length, created_by ) 
				VALUES ( $last_inserted_PS_UUID, $last_inserted_PS_UUID, '0', $v5 )";
            if ($conn->query($sqlins5) === false) {
                trigger_error('Wrong SQL: ' . $sqlins5 . ' Error: ' . $conn->error, E_USER_ERROR);
            } else {
                $affected_rows = $affected_rows + $conn->affected_rows;
                
                //7. Insert a link that will tie the position to another position in the position closure table.
                $sqlins6 = "INSERT INTO ubm_model_position_closure(ancestor_UUID, descendant_UUID, path_length)
							 SELECT a.ancestor_UUID, d.descendant_UUID, a.path_length+d.path_length+1
							   FROM ubm_model_position_closure a, ubm_model_position_closure d
							  WHERE a.descendant_UUID=$v4
							  	AND d.ancestor_UUID=$last_inserted_PS_UUID";
                if ($conn->query($sqlins6) === false) {
                    trigger_error('Wrong SQL: ' . $sqlins6 . ' Error: ' . $conn->error, E_USER_ERROR);
                } else {
                    $affected_rows = $affected_rows + $conn->affected_rows;
                    echo $_GET['callback'] . '(' . "{'message' : 'Requested Position $v3 was added to my model and given UUID: $last_inserted_PS_UUID successfully and currently reports to position: $v4 !'}" . ')';
                }
            }
        }
    }
}
