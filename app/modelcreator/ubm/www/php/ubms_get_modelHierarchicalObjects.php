<?php
require_once ('globalGetVariables.php');

//require_once ('ubms_db_config.php');
require_once ('DBConnect_UBMv1.php');

//Provides the variables used for UBMv1 database connection $conn
$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);

// check connection
if ($conn->connect_error) {
    trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
}

$v2 = "'" . $conn->real_escape_string($activeModelUUID) . "'";
$v3 = "'" . $conn->real_escape_string($activeModelOwnerUUID) . "'";

ini_set('display_errors', 1); 
error_reporting(E_ALL);
$positionUUID = array();
$all_items = array();
$sqlsel1 = "SELECT * FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID
                JOIN ubm_model
                ON (ubm_model.id=ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.model_id)
                WHERE ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.UUID=$v2";
$rs1 = $conn->query($sqlsel1);

//2. Set rs1 equal to the list of objects that is returned in the result set.
if ($rs1 === false) {
    trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
    while ($items1 = $rs1->fetch_assoc()) {
        $modelTitle = stripslashes($items1['title']);
        $legalEntity = stripslashes($items1['owner_legal_entity']);
    }
}
$sqlsel1 = "SELECT * 
                FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID
                JOIN ubm_model_position_closure
                ON ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.UUID=ubm_model_position_closure.descendant_UUID
                WHERE ubm_model_position_closure.ancestor_UUID=$v3";

$positionUUID[] = $activeModelOwnerUUID;
$rs1 = $conn->query($sqlsel1);
if ($rs1 === false) {
    trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
    if (mysqli_num_rows($rs1) > 0) {
        
        //2. Add the result set to the $all_items [] array
        while ($items = $rs1->fetch_assoc()) {
            $path_length = stripslashes($items['path_length']);
            $descendant_UUID = stripslashes($items['descendant_UUID']);
            if ($path_length < 2 && $path_length > 0) {
                $positionUUID[] = stripslashes($items['UUID']);
            } else {
                
                //Selects all information from the specified descendant_idZ
                $sqlsel2 = "SELECT * FROM ubm_model_position_closure
                                JOIN ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID
                                ON (ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.UUID=ubm_model_position_closure.descendant_UUID)
                                WHERE ubm_model_position_closure.descendant_UUID=$descendant_UUID
                                AND ubm_model_position_closure.path_length=1
                                GROUP BY ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.UUID";
                $rs2 = $conn->query($sqlsel2);
                if ($rs2 === false) {
                    trigger_error('Wrong SQL: ' . $sqlsel2 . ' Error: ' . $conn->error, E_USER_ERROR);
                } else {
                    if (mysqli_num_rows($rs2) > 0) {
                        
                        //2. Add the result set to the $all_items [] array
                        while ($items2 = $rs2->fetch_assoc()) {
                            $positionUUID[] = stripslashes($items2['UUID']);
                        }
                    } else {
                    }
                }
            }
        }
    } else {
    }
}

// $all_UUID array is a list of all the UUID's that were attatched to the given activeObjectUUID.
//4. Go through each UUID

//SELECT
//5.Get the id of the JD, PL, PR, ST, TA and return it
$psCounter = 1;
foreach ($positionUUID as $key => $activePositionUUID) {
    $sqlsel1 = "SELECT * FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID WHERE UUID=$activePositionUUID";
    $rs1 = $conn->query($sqlsel1);
    if ($rs1 === false) {
        trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
    } else {
        if (mysqli_num_rows($rs1) > 0) {
            
            //6. Select all of the information from the appropriate job description
            while ($items = $rs1->fetch_assoc()) {
                $positionId = $items['position_id'];
                if ($positionId >= 1) {
                    
                    $sqlsel6 = "SELECT * FROM ubm_model_positions WHERE id = $positionId";
                    $rs6 = $conn->query($sqlsel6);
                    if ($rs6 === false) {
                        trigger_error('Wrong SQL: ' . $sqlsel2 . ' Error: ' . $conn->error, E_USER_ERROR);
                    } else {
                        while ($items6 = $rs6->fetch_assoc()) {
                            $all_items[] = array('Position' => $items6['id']);
                            $jdCounter = 1;
                            $psCounter+= 1;
                            
                            $sqlsel7 = "SELECT * FROM ubm_modelcreationsuite_heirarchy_object_closureTable
                                    JOIN ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID
                                    ON ubm_modelcreationsuite_heirarchy_object_closureTable.descendant_id=ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.UUID
                                    JOIN ubm_model_jobDescriptions
                                    ON ubm_model_jobDescriptions.id=ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.jobDescription_id
                                    WHERE ancestor_id=$v3 AND path_length=1";
                            $rs7 = $conn->query($sqlsel7);
                            if ($rs7 === false) {
                                trigger_error('Wrong SQL: ' . $sqlsel3 . ' Error: ' . $conn->error, E_USER_ERROR);
                            } else {
                                while ($items7 = $rs7->fetch_assoc()) {
                                    $jobDescriptionUUID = $items7['UUID'];
                                    $all_items[] = array('Job Description' => $items7['id']);
                                    $plCounter = 1;
                                    $jdCounter+= 1;
                                    
                                    $sqlsel8 = "SELECT * FROM ubm_modelcreationsuite_heirarchy_object_closureTable
                                            JOIN ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID
                                            ON ubm_modelcreationsuite_heirarchy_object_closureTable.descendant_id=ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.UUID
                                            JOIN ubm_model_policies
                                            ON ubm_model_policies.id=ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.policy_id
                                            WHERE ubm_modelcreationsuite_heirarchy_object_closureTable.ancestor_id=$jobDescriptionUUID AND ubm_modelcreationsuite_heirarchy_object_closureTable.path_length=1";
                                    $rs8 = $conn->query($sqlsel8);
                                    if ($rs8 === false) {
                                        trigger_error('Wrong SQL: ' . $sqlsel8 . ' Error: ' . $conn->error, E_USER_ERROR);
                                    } else {
                                        while ($items8 = $rs8->fetch_assoc()) {
                                            $policyUUID = $items8['UUID'];
                                            $all_items[] = array('Policy' => $items8['id']);
                                            $prCounter = 1;
                                            $plCounter+= 1;
                                            
                                            $sqlsel9 = "SELECT * FROM ubm_modelcreationsuite_heirarchy_object_closureTable
                                                    JOIN ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID
                                                    ON ubm_modelcreationsuite_heirarchy_object_closureTable.descendant_id=ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.UUID
                                                    JOIN ubm_model_procedures
                                                    ON ubm_model_procedures.id=ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.procedure_id
                                                    WHERE ubm_modelcreationsuite_heirarchy_object_closureTable.ancestor_id=$policyUUID AND ubm_modelcreationsuite_heirarchy_object_closureTable.path_length=1";
                                            $rs9 = $conn->query($sqlsel9);
                                            if ($rs9 === false) {
                                                trigger_error('Wrong SQL: ' . $sqlsel9 . ' Error: ' . $conn->error, E_USER_ERROR);
                                            } else {
                                                while ($items9 = $rs9->fetch_assoc()) {
                                                    $procedureId = $items9['UUID'];
                                                    $all_items[] = array('Procedure' => $items9['id']);
                                                    
                                                    $sqlsel3 = "SELECT * FROM ubm_modelcreationsuite_heirarchy_object_closureTable
                                                            JOIN ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID
                                                            ON ubm_modelcreationsuite_heirarchy_object_closureTable.descendant_id=ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.UUID
                                                            JOIN ubm_model_stepUUID_has_stepnumber
                                                            ON ubm_model_stepUUID_has_stepnumber.step_UUID=ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.UUID
                                                            JOIN ubm_model_steps
                                                            ON ubm_model_steps.id=ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.step_id
                                                            WHERE ancestor_id=$procedureId AND path_length=1
                                                            ORDER BY ubm_model_stepUUID_has_stepnumber.step_number";
                                                    $rs3 = $conn->query($sqlsel3);
                                                    
                                                    if ($rs3 === false) {
                                                        trigger_error('Wrong SQL: ' . $sqlsel3 . ' Error: ' . $conn->error, E_USER_ERROR);
                                                    } else {
                                                        while ($items3 = $rs3->fetch_assoc()) {
                                                            $stepUUID = $items3['UUID'];
                                                            $all_items[] = array('Step' => $items3['id']);
                                                            
                                                            $sqlsel5 = "SELECT * FROM ubm_modelcreationsuite_heirarchy_object_closureTable
                                                                    JOIN ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID
                                                                    ON ubm_modelcreationsuite_heirarchy_object_closureTable.descendant_id=ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.UUID
                      
                                                                    JOIN ubm_model_taskUUID_has_tasknumber
                                                                    ON ubm_model_taskUUID_has_tasknumber.task_UUID=ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.UUID
                                                                    JOIN ubm_model_tasks
                                                                    ON ubm_model_tasks.id=ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.task_id
                                                                    WHERE ubm_modelcreationsuite_heirarchy_object_closureTable.ancestor_id=$stepUUID AND ubm_modelcreationsuite_heirarchy_object_closureTable.path_length=1
                                                                    ORDER BY ubm_model_taskUUID_has_tasknumber.task_number";
                                                            $rs5 = $conn->query($sqlsel5);
                                                            if ($rs5 === false) {
                                                                trigger_error('Wrong SQL: ' . $sqlsel3 . ' Error: ' . $conn->error, E_USER_ERROR);
                                                            } else {
                                                                if ($rs5->num_rows > 0) {
                                                                    while ($items5 = $rs5->fetch_assoc()) {
                                                                        $all_items[] = array('Task' => $items5['id']);
                                                                    }
                                                                } else {
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        } else {
        }
    }
}
echo $_GET['callback'] . '(' . json_encode($all_items) . ')';