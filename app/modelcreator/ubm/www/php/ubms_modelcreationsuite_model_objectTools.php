<?php
//error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once ('globalGetVariables.php');
require_once('ubms_db_config.php');
require_once ('DBConnect_UBMv1.php');
//Provides the variables used for UBMv1 database connection $conn
$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);

// check connection
if ($conn->connect_error) {
    trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
}
$v2 = "'" . $conn->real_escape_string($fromTargetObject) . "'";
$v3 = "'" . $conn->real_escape_string($toTargetObject) . "'";
$v4 = "'" . $conn->real_escape_string($SelectedAction) . "'";

//1. Get column names from database.
$OUUID = $v2;
//2. Compare the toTargetObject and the fromTargetObject
//Create attribute array to hold attributes of each item
    $attributeContainer = array(
        $v2 => array(
             "attributes" => array(
                 "object_type" => "foo",
                 "number_of_descendants" => 0,
                 "number_of_ancestors" => 0,
                 "number_of_immediate_ancestors" => 0,
                 "number_of_immediate_descendants" => 0,
                 "number_of_instances" => 0
             )
        )       
    );
function getObjectType($OUUID, $DBServer, $DBUser, $DBPass, $DBName) {
    $conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
    if ($conn->connect_error) {
        trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
    }
    //Get the object type.
    $sqlsel="SELECT * FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID WHERE UUID=$OUUID";
    $rs=$conn->query($sqlsel);
    if($rs === false) {
    trigger_error('Wrong SQL: ' . $sqlsel . ' Error: ' . $conn->error, E_USER_ERROR);
    } else { /***/
        $rows_returned = $rs->num_rows;
        if($rows_returned>0){ /***/
            while ($items = $rs->fetch_assoc()){
                /***/
                $UUID               = stripslashes($items['UUID']);
                $created_by         = stripslashes($items['created_by']);
                $creation_date      = stripslashes($items['creation_date']);
                $ubm_mfi_id         = stripslashes($items['ubm_mfi_id']);
                $volume_id          = stripslashes($items['volume_id']);
                $bm_mfi_id          = stripslashes($items['bm_mfi_id']);
                $book_id            = stripslashes($items['book_id']);
                $section_id         = stripslashes($items['section_id']);
                $chapter_id         = stripslashes($items['chapter_id']);
                $legal_entity_id    = stripslashes($items['legal_entity_id']);
                $model_id           = stripslashes($items['model_id']);
                $position_id        = stripslashes($items['position_id']);
                $jobDescription_id  = stripslashes($items['jobDescription_id']);
                $policy_id          = stripslashes($items['policy_id']);
                $procedure_id       = stripslashes($items['procedure_id']);
                $step_id            = stripslashes($items['step_id']);
                $task_id            = stripslashes($items['task_id']);
                $event_id           = stripslashes($items['event_id']);
                $product_id         = stripslashes($items['product_id']);
                /***/
                if($product_id>0){
                    $objectType = "PD";
                    return $objectType;
                }elseif($event_id>0){
                    $objectType = "EV";
                    return $objectType;
                }elseif($task_id>0){
                    $objectType = "TK";
                    return $objectType;
                }elseif($step_id>0){
                    $objectType = "ST";
                    return $objectType;
                }elseif($procedure_id>0){
                    $objectType = "PR";
                    return $objectType;
                }elseif($policy_id>0){
                    $objectType = "PL";
                    return $objectType;
                }elseif($jobDescription_id>0){
                    $objectType = "JD";
                    return $objectType;
                }elseif($position_id>0){
                    $objectType = "PS";
                    return $objectType;                    
                }elseif($model_id>0){
                    $objectType = "MD";
                    return $objectType;
                }elseif($legal_entity_id>0){
                    $objectType = "LE";
                    return $objectType;
                }elseif($chapter_id>0){
                    $objectType = "CH";
                    return $objectType;
                }elseif($book_id>0){
                    $objectType = "BK";
                    return $objectType;
                }elseif($bm_mfi_id>0){
                    $objectType = "BMMF";
                    return $objectType;
                }elseif($volume_id>0){
                    $objectType = "VL";
                    return $objectType;
                }elseif($ubm_mfi_id>0){
                    $objectType = "UBMMF";
                    return $objectType;
                }/***/
            }
        }else{
                    $objectType = "No Type";
                    return $objectType;
        }/***/
    }
}
/***/
function getNumberofDescendants($OUUID, $DBServer, $DBUser, $DBPass, $DBName){
    $conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);

    if ($conn->connect_error) {
        trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
    }
    //Get the object type.
    $sqlsel="SELECT * FROM ubm_modelcreationsuite_heirarchy_object_closureTable WHERE ancestor_id=$OUUID";
    $rs=$conn->query($sqlsel);
    if($rs === false) {
        trigger_error('Wrong SQL: ' . $sqlsel . ' Error: ' . $conn->error, E_USER_ERROR);
    } else {
        $rows_returned = $rs->num_rows;
        return $rows_returned;
    }    
}/***/
function getNumberofImmediateDescendants($OUUID, $DBServer, $DBUser, $DBPass, $DBName){
    $conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);

    if ($conn->connect_error) {
        trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
    }
    //Get the object type.
    $sqlsel="SELECT * FROM ubm_modelcreationsuite_heirarchy_object_closureTable WHERE ancestor_id=$OUUID AND path_length=1";
    $rs=$conn->query($sqlsel);
    if($rs === false) {
        trigger_error('Wrong SQL: ' . $sqlsel . ' Error: ' . $conn->error, E_USER_ERROR);
    } else {
        $rows_returned = $rs->num_rows;
        return $rows_returned;
    }      
}/***/
function getNumberofAncestors($OUUID, $DBServer, $DBUser, $DBPass, $DBName){
    $conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);

    if ($conn->connect_error) {
        trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
    }
    //Get the object type.
    $sqlsel="SELECT * FROM ubm_modelcreationsuite_heirarchy_object_closureTable WHERE descendant_id=$OUUID";
    $rs=$conn->query($sqlsel);
    if($rs === false) {
        trigger_error('Wrong SQL: ' . $sqlsel . ' Error: ' . $conn->error, E_USER_ERROR);
    } else {
        $rows_returned = $rs->num_rows;
        return $rows_returned;
    }     
}/***/
function getNumberofImmediateAncestors($OUUID, $DBServer, $DBUser, $DBPass, $DBName){
    $conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);

    if ($conn->connect_error) {
        trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
    }
    //Get the object type.
    $sqlsel="SELECT * FROM ubm_modelcreationsuite_heirarchy_object_closureTable WHERE descendant_id=$OUUID AND path_length=1";
    $rs=$conn->query($sqlsel);
    if($rs === false) {
        trigger_error('Wrong SQL: ' . $sqlsel . ' Error: ' . $conn->error, E_USER_ERROR);
    } else {
        $rows_returned = $rs->num_rows;
        return $rows_returned;
    }       
}/***/
function getNumberofInstances($OUUID, $DBServer, $DBUser, $DBPass, $DBName){
    $conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);

    if ($conn->connect_error) {
        trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
    }
    //Get the object type.
    //Get the id of the given $OUUID
    $sqlsel="SELECT * FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID WHERE UUID=$OUUID";
    $rs=$conn->query($sqlsel);
    if($rs === false) {
    trigger_error('Wrong SQL: ' . $sqlsel . ' Error: ' . $conn->error, E_USER_ERROR);
    } else {
        $rows_returned = $rs->num_rows;
        if($rows_returned>0){
            while ($items = $rs->fetch_assoc()){
                $UUID               = stripslashes($items['UUID']);
                $created_by         = stripslashes($items['created_by']);
                $creation_date      = stripslashes($items['creation_date']);
                $ubm_mfi_id         = stripslashes($items['ubm_mfi_id']);
                $volume_id          = stripslashes($items['volume_id']);
                $bm_mfi_id          = stripslashes($items['bm_mfi_id']);
                $book_id            = stripslashes($items['book_id']);
                $section_id         = stripslashes($items['section_id']);
                $chapter_id         = stripslashes($items['chapter_id']);
                $legal_entity_id    = stripslashes($items['legal_entity_id']);
                $model_id           = stripslashes($items['model_id']);
                $position_id        = stripslashes($items['position_id']);
                $jobDescription_id  = stripslashes($items['jobDescription_id']);
                $policy_id          = stripslashes($items['policy_id']);
                $procedure_id       = stripslashes($items['procedure_id']);
                $step_id            = stripslashes($items['step_id']);
                $task_id            = stripslashes($items['task_id']);
                $event_id           = stripslashes($items['event_id']);
                $product_id         = stripslashes($items['product_id']);
                if($product_id>0){
                    $columnName = "product_id";
                    $objectId = $product_id;       
                }elseif($event_id>0){
                    $columnName = "event_id";
                    $objectId = $event_id;         
                }elseif($task_id>0){
                    $columnName = "task_id";
                    $objectId = $task_id;          
                }elseif($step_id>0){
                    $columnName = "step_id";
                    $objectId = $step_id;          
                }elseif($procedure_id>0){
                    $columnName = "procedure_id";
                    $objectId = $procedure_id;    
                }elseif($policy_id>0){
                    $columnName = "policy_id";
                    $objectId = $policy_id;        
                }elseif($jobDescription_id>0){
                    $columnName = "jobDescription_id";
                    $objectId = $jobDescription_id;
                }elseif($position_id>0){
                    $columnName = "position_id";
                    $objectId = $position_id;
                }elseif($model_id>0){
                    $columnName = "model_id";
                    $objectId = $model_id;         
                }elseif($legal_entity_id>0){
                    $columnName = "legal_entity_id";
                    $objectId = $legal_entity_id;  
                }elseif($chapter_id>0){
                    $columnName = "chapter_id";
                    $objectId = $chapter_id;       
                }elseif($section_id>0){
                    $columnName = "section_id";
                    $objectId = $section_id;          
                }elseif($book_id>0){
                    $columnName = "book_id";
                    $objectId = $book_id;        
                }elseif($bm_mfi_id>0){
                    $columnName = "bm_mfi_id";
                    $objectId = $bm_mfi_id;        
                }elseif($volume_id>0){
                    $columnName = "volume_id";
                    $objectId = $volume_id;
                }elseif($ubm_mfi_id>0){
                    $columnName = "ubm_mfi_id";
                    $objectId = $ubm_mfi_id;
                }else{
                    return "There was an error! Item type is unknown.";
                }
            }
        }else{
            return $objectType = "There was an error! Result Set was empty!";
        }
    }
//
    $sqlsel1 = "SELECT *
                FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID 
                WHERE $columnName=$objectId";
    $rs1=$conn->query($sqlsel1);
    if($rs1 === false) {
        trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
    } else {
        return $rows_returned = $rs1->num_rows;
    }
}/***/
function getColumnNames($columnName){
    $conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);

    if ($conn->connect_error) {
        trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
    }
    //Get the object type.
    //1. Get column names in the UUID table
    $selColumnNames = "SELECT COLUMN_NAME 
                    FROM INFORMATION_SCHEMA.COLUMNS 
                    WHERE TABLE_SCHEMA='jessespe_UBMv1' 
                    AND TABLE_NAME='ubm_modelcreationsuite_identification_setup'"; 
    $rsColumnNames=$conn->query($selColumnNames);
    if($rsColumnNames === false) {
        trigger_error('Wrong SQL: ' . $selColumnNames . ' Error: ' . $conn->error, E_USER_ERROR);
    } else {
        $rows_returned = $rsColumnNames->num_rows;
        return $listOfNames = $rsColumnNames->fetch_assoc();
    }
}
function updateUUIDLog($OUUID, $DBServer, $DBUser, $DBPass, $DBName, $attributeContainer,$username){
                  $object_type =  $attributeContainer[$OUUID]["attributes"]["object_type"]; 
                  $number_of_ancestors = $attributeContainer[$OUUID]["attributes"]["number_of_ancestors"];
                  $number_of_descendants = $attributeContainer[$OUUID]["attributes"]["number_of_descendants"];
                  $number_of_immediate_ancestors = $attributeContainer[$OUUID]["attributes"]["number_of_immediate_ancestors"];
                  $number_of_immediate_descendants = $attributeContainer[$OUUID]["attributes"]["number_of_immediate_descendants"];
                  $number_of_instances = $attributeContainer[$OUUID]["attributes"]["number_of_instances"];
    $conn = new mysqli($DBServer, $DBUser, $DBPass, "jessespe_UBMv1_dataLog");
    // check connection
    if ($conn->connect_error) {
        trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
    }
    $sqlins = "INSERT INTO 
                UUID_attribute_history (
                        UUID, 
                        object_type, 
                        number_of_ancestors, 
                        number_of_descendants, 
                        number_of_immediate_ancestors, 
                        number_of_immediate_descendants, 
                        number_of_instances, 
                        created_by
                )
                VALUES (
                    $OUUID,
                    '$object_type', 
                    '$number_of_ancestors', 
                    '$number_of_descendants', 
                    '$number_of_immediate_ancestors', 
                    '$number_of_immediate_descendants', 
                    '$number_of_instances', 'UBM')";
    $rs=$conn->query($sqlins);
    if($rs === false) {
        trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn->error, E_USER_ERROR);
    }else {
     $last_inserted_id = $conn->insert_id;
     $affected_rows = $conn->affected_rows;
    }
}
for ($i = $fromTargetObject-10; $i <= $fromTargetObject; $i++) {
    //NOTE An object is likely to be attached to other objects whos UUID is in close proximity to theirs. 
    //Collecting 10 items below the given UUID allows us to collect more snapshots of objects that are actively being modified or created.
    // $attributeContainer[$i]["attributes"]["object_type"]                       = getObjectType($i, $DBServer, $DBUser, $DBPass, $DBName); // call function to get Object Type.
    // $attributeContainer[$i]["attributes"]["number_of_ancestors"]               = getNumberofAncestors($i, $DBServer, $DBUser, $DBPass, $DBName); // call function to get Object Type.
    // $attributeContainer[$i]["attributes"]["number_of_descendants"]             = getNumberofDescendants($i, $DBServer, $DBUser, $DBPass, $DBName); // call function to get Object Type.
    // $attributeContainer[$i]["attributes"]["number_of_immediate_ancestors"]     = getNumberofImmediateAncestors($i, $DBServer, $DBUser, $DBPass, $DBName); // call function to get Object Type.
    // $attributeContainer[$i]["attributes"]["number_of_immediate_descendants"]   = getNumberofImmediateDescendants($i, $DBServer, $DBUser, $DBPass, $DBName); // call function to get Object Type.
    // $attributeContainer[$i]["attributes"]["number_of_instances"]               = getNumberofInstances($i, $DBServer, $DBUser, $DBPass, $DBName); // call function to get Object Type.
    updateUUIDLog($i, $DBServer, $DBUser, $DBPass, $DBName, $attributeContainer, $username);
}
$attributeContainer[$v2]["attributes"]["object_type"]                       = getObjectType($v2, $DBServer, $DBUser, $DBPass, $DBName); // call function to get Object Type.
$attributeContainer[$v2]["attributes"]["number_of_ancestors"]               = getNumberofAncestors($v2, $DBServer, $DBUser, $DBPass, $DBName); // call function to get Object Type.
$attributeContainer[$v2]["attributes"]["number_of_descendants"]             = getNumberofDescendants($v2, $DBServer, $DBUser, $DBPass, $DBName); // call function to get Object Type.
$attributeContainer[$v2]["attributes"]["number_of_immediate_ancestors"]     = getNumberofImmediateAncestors($v2, $DBServer, $DBUser, $DBPass, $DBName); // call function to get Object Type.
$attributeContainer[$v2]["attributes"]["number_of_immediate_descendants"]   = getNumberofImmediateDescendants($v2, $DBServer, $DBUser, $DBPass, $DBName); // call function to get Object Type.
$attributeContainer[$v2]["attributes"]["number_of_instances"]               = getNumberofInstances($v2, $DBServer, $DBUser, $DBPass, $DBName); // call function to get Object Type.
echo $_GET['callback'] . '(' . json_encode($attributeContainer) . ')';


