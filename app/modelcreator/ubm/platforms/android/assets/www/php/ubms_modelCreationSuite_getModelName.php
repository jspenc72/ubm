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
$v2="'" . $conn->real_escape_string($activeModelUUID) . "'";
//SELECT
$all_items = array();
$sqlsel1 = "SELECT * FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID
JOIN ubm_model
ON ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.model_id=ubm_model.id
WHERE UUID=$v2";
//Select all
$rs1 = $conn->query($sqlsel1);
if ($rs1 === false) {
    trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
    
    if (mysqli_num_rows($rs1) > 0) {
        
        while ($items = $rs1->fetch_assoc()) {
            $title = stripslashes($items['title']);
        }
    } else {
        $num_rows = mysqli_num_rows($rs1);
        }
}
//6. JSONP packaged $all_items array
echo $_GET['callback'] . '(' . json_encode($title) . ')';
//Output $all_items array in json encoded format.