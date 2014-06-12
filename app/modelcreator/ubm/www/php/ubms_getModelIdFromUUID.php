<?php

//1. Select all records for checklist items stored in model_creation_suite, Count the number of items in the checklist.
$modelsel = "SELECT *
FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID
WHERE UUID= $activeModelUUID";
$modelRs = $conn->query($modelsel);
if ($modelRs === false) {
    trigger_error('Wrong SQL: ' . $modelsel . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
    if (mysqli_num_rows($modelRs) > 0) {
        
        //2. Add the result set to the $all_items [] array
        while ($modelItems = $modelRs->fetch_assoc()) {
            $modelId = stripslashes($modelItems['model_id']);
        }
    }
}
