<?php
require_once ('globalGetVariables.php');

//require_once ('ubms_db_config.php');
require_once ('DBConnect_UBMv1.php');
error_reporting(E_ALL);
ini_set('display_errors', '1');

//Provides the variables used for UBMv1 database connection $conn
$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);

// check connection

//1. Pass in Model UUID

//2. Retrieve the Model id based on the UUID in the Anti Solipsism table
if ($conn->connect_error) {
    trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
}
$sqlsel = "SELECT * FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID WHERE UUID='$activeModelUUID'";
$rs1 = $conn->query($sqlsel);
if ($rs1 === false) {
    trigger_error('Wrong SQL: ' . $sqlsel . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
    if (mysqli_num_rows($rs1) > 0) {
        while ($items = $rs1->fetch_assoc()) {
           $modelId = stripslashes($items['model_id']);
        }
    }
}

//3. Mark the model with the appropriate id as "Soft Delete = TRUE" in the ubm_models table.

$sql2 = "DELETE FROM ubm_model_has_members WHERE model_UUID=$modelId";

if ($conn->query($sql2) === false) {
    trigger_error('Wrong SQL: ' . $sql2 . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
    $affected_rows2 = $conn->affected_rows;
}


//4. Check that the current user was the creator of the model being removed.
$sqlsel = "SELECT * FROM ubm_model WHERE id=$modelId";
$rs1 = $conn->query($sqlsel);
if ($rs1 === false) {
    trigger_error('Wrong SQL: ' . $sqlsel . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
    if (mysqli_num_rows($rs1) > 0) {
        while ($items = $rs1->fetch_assoc()) {
           $creatorId = stripslashes($items['creator_id']);
           if($creatorId==$username){
            //5. If the user is not the creator of the model, set model soft deleted.
                $sql = "UPDATE ubm_model SET Soft_DELETE='TRUE' WHERE creator_id='adamg' AND id=$modelId";
                if ($conn->query($sql) === false) {
                    trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
                } else {
                    $affected_rows = $conn->affected_rows;
                    echo $_GET['callback'] . '(' . "{'message' : 'The UUID of the model removed was $activeModelUUID, the id of the model was $modelId. The number of models that were removed: $affected_rows! $affected_rows2 people were a part of this model and are now removed.'}" . ')';
                }
           }else{
                    echo $_GET['callback'] . '(' . "{'message' : 'Only the creator of a model can perform this action.'}" . ')';
           }
        }
    }
}






