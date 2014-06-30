<?php
require_once ('../config/tcpdf_config.php');
require_once ('../tcpdf.php');
include ('../../../DBConnect_UBMv1.php');

//Provides the variables used for UBMv1 database connection $conn
require_once ('../../../globalGetVariables.php');
$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);

// check connection
if ($conn->connect_error) {
    trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
}
$v2 = "'" . $conn->real_escape_string($activeObjectUUID) . "'";
error_reporting(E_ALL);
ini_set('display_errors', '1');

//SELECT
//1. Select all records with ancestor equal to the activeObjectUUID
$sqlsel1 = "SELECT c.descendant_id, c.ancestor_id, c.path_length FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID u
                        JOIN ubm_modelcreationsuite_heirarchy_object_closureTable c
                        ON (u.UUID=c.descendant_id)
                        WHERE c.ancestor_id=$v2
                        ORDER BY u.UUID";
$rs1 = $conn->query($sqlsel1);

//2. Set rs1 equal to the list of objects that is returned in the result set.
if ($rs1 === false) {
    trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
    while ($items1 = $rs1->fetch_assoc()) {
        
        //3. Loop through the result set and get the descendant_id and the ancestor_id
        $returnedDescendant = stripslashes($items1['descendant_id']);
        $returnedAncestor = stripslashes($items1['ancestor_id']);
        
        //4. select the record with path_length=1 so that you get the immediate parent.
        
        $sqlsel2 = "SELECT c.*, u.* FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID u
                                JOIN ubm_modelcreationsuite_heirarchy_object_closureTable c
                                ON (u.UUID=c.descendant_id)
                                WHERE c.descendant_id=$returnedDescendant
                                AND c.path_length=1";
        $rs2 = $conn->query($sqlsel2);
        if ($rs1 === false) {
            trigger_error('Wrong SQL: ' . $sqlsel2 . ' Error: ' . $conn->error, E_USER_ERROR);
        } else {
            
            //3. Get all the UUID's from the returned array
            while ($items2 = $rs2->fetch_assoc()) {
                $all_UUID[] = stripslashes($items2['UUID']);
            }
        }
    }
}
// $all_UUID array is a list of all the UUID's that were attatched to the given activeObjectUUID.
//4. Go through each UUID
foreach ($all_UUID as $object => $value) {
    
    //SELECT
    $all_items = array();
    
    //5.Get the id of the JD, PL, PR, ST, TA and return it
    $sqlsel1 = "SELECT * FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID WHERE UUID=$value";
    $rs1 = $conn->query($sqlsel1);
    if ($rs1 === false) {
        trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
    } else {
        if (mysqli_num_rows($rs1) > 0) {
            
            //6. Select all of the information from the appropriate job description
            while ($items = $rs1->fetch_assoc()) {
                $positionId = stripslashes($items['position_id']);
                $jobDescriptionId = stripslashes($items['jobDescription_id']);
                $policyId = stripslashes($items['policy_id']);
                $procedureId = stripslashes($items['procedure_id']);
                $stepId = stripslashes($items['step_id']);
                $taskId = stripslashes($items['task_id']);
                
                if ($positionId >= 1) {
                    $sqlsel2 = "SELECT * FROM ubm_model_positions WHERE id=$positionId";
                    $rs2 = $conn->query($sqlsel2);
                    if ($rs2 === false) {
                        trigger_error('Wrong SQL: ' . $sqlsel2 . ' Error: ' . $conn->error, E_USER_ERROR);
                    } else {
                        while ($items2 = $rs2->fetch_assoc()) {
                            $all_items[] = $items2;
                        }
                    }
                }

                if ($jobDescriptionId >= 1) {
                    $sqlsel2 = "SELECT * FROM ubm_model_jobDescriptions WHERE id=$jobDescriptionId";
                    $rs2 = $conn->query($sqlsel2);
                    if ($rs2 === false) {
                        trigger_error('Wrong SQL: ' . $sqlsel2 . ' Error: ' . $conn->error, E_USER_ERROR);
                    } else {
                        while ($items2 = $rs2->fetch_assoc()) {
                            $all_items[] = $items2;
                        }
                    }
                }
                
                if ($policyId >= 1) {
                    $sqlsel2 = "SELECT * FROM ubm_model_policies WHERE id=$policyId";
                    $rs2 = $conn->query($sqlsel2);
                    if ($rs2 === false) {
                        trigger_error('Wrong SQL: ' . $sqlsel2 . ' Error: ' . $conn->error, E_USER_ERROR);
                    } else {
                        while ($items2 = $rs2->fetch_assoc()) {
                            $all_items[] = $items2;
                        }
                    }
                }
                
                if ($procedureId >= 1) {
                    $sqlsel2 = "SELECT * FROM ubm_model_procedures WHERE id=$procedureId";
                    $rs2 = $conn->query($sqlsel2);
                    if ($rs2 === false) {
                        trigger_error('Wrong SQL: ' . $sqlsel2 . ' Error: ' . $conn->error, E_USER_ERROR);
                    } else {
                        while ($items2 = $rs2->fetch_assoc()) {
                            $all_items[] = $items2;
                        }
                    }
                }
                
                if ($stepId >= 1) {
                    $sqlsel2 = "SELECT * FROM ubm_model_procedures WHERE id=$stepId";
                    $rs2 = $conn->query($sqlsel2);
                    if ($rs2 === false) {
                        trigger_error('Wrong SQL: ' . $sqlsel2 . ' Error: ' . $conn->error, E_USER_ERROR);
                    } else {
                        while ($items2 = $rs2->fetch_assoc()) {
                            $all_items[] = $items2;
                        }
                    }
                }
                
                if ($taskId >= 1) {
                    $sqlsel2 = "SELECT * FROM ubm_model_procedures WHERE id=$taskId";
                    $rs2 = $conn->query($sqlsel2);
                    if ($rs2 === false) {
                        trigger_error('Wrong SQL: ' . $sqlsel2 . ' Error: ' . $conn->error, E_USER_ERROR);
                    } else {
                        while ($items2 = $rs2->fetch_assoc()) {
                            $all_items[] = $items2;
                        }
                    }
                }
            }
            
            // 7. Print out every job description that is a part of this position
            echo $_GET['callback'] . '(' . json_encode($all_items) . ')';
            
            // tcpd stuff
            
            //Output $all_items array in json encoded format.
            
            
        } else {
        }
    }
}

//8. Do the same for PL, PR, ST, TA
