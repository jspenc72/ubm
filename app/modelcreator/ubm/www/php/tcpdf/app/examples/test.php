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

//SELECT
$all_items = array();

//1. Select all records for checklist items stored in model_creation_suite, Count the number of items in the checklist.
$sqlsel1 = "SELECT c.* FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID u
                        JOIN ubm_modelcreationsuite_heirarchy_object_closureTable c
                        ON (u.UUID=c.descendant_id)
                        WHERE c.ancestor_id=$v2
                        ORDER BY u.UUID";

$rs1 = $conn->query($sqlsel1);
if ($rs1 === false) {
    trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
    while ($items1 = $rs1->fetch_assoc()) {
        $returnedDescendant = stripslashes($items1['descendant_id']);
        $returnedAncestor = stripslashes($items1['ancestor_id']);
        
        //2. select the record with path_length=1 so that you get the immediate parent.
        $sqlsel2 = "SELECT * FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID u
                                JOIN ubm_modelcreationsuite_heirarchy_object_closureTable c
                                ON (u.UUID=c.descendant_id)
                                WHERE c.descendant_id=$returnedDescendant
                                AND c.path_length=1";
        $rs2 = $conn->query($sqlsel2);
        if ($rs1 === false) {
            trigger_error('Wrong SQL: ' . $sqlsel2 . ' Error: ' . $conn->error, E_USER_ERROR);
        } else {
            while ($items2 = $rs2->fetch_assoc()) {
                $all_UUID[] = stripslashes($items2['UUID']);
            }
        }
    }
}

foreach ($all_UUID as $position => $value) {
    
    //SELECT
    $all_items = array();
    
    //1. Select all records for checklist items stored in model_creation_suite, Count the number of items in the checklist.
    $sqlsel1 = "SELECT * FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID WHERE UUID=$value";
    $rs1 = $conn->query($sqlsel1);
    if ($rs1 === false) {
        trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
    } else {
        if (mysqli_num_rows($rs1) > 0) {
            //2. Add the result set to the $all_items [] array
            while ($items = $rs1->fetch_assoc()) {
                $jobDescriptionId = stripslashes($items['jobDescription_id']);
                if ($jobDescriptionId >= 1) {
                    $objectType = "JD";
                    $sqlsel2 = "SELECT * FROM ubm_model_jobDescriptions WHERE id=$jobDescriptionId";
                    $rs2 = $conn->query($sqlsel2);
                }
                if ($rs2 === false) {
                    trigger_error('Wrong SQL: ' . $sqlsel2 . ' Error: ' . $conn->error, E_USER_ERROR);
                } else {
                    while ($items2 = $rs2->fetch_assoc()) {
                        $items2['object_type'] = $objectType;
                        $all_items[] = $items2;
                    }
                }
            }
            //6. JSONP packaged $all_items array
            echo $_GET['callback'] . '(' . json_encode($all_items) . ')';
            //Output $all_items array in json encoded format.
        } else {
        }
    }
}
