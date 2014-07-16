<?php
require_once ('globalGetVariables.php');

//require_once('ubms_db_config.php');
require_once ('DBConnect_UBMv1.php');
 //Provides the variables used for UBMv1 database connection $conn
$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);

// check connection
if ($conn->connect_error) {
    trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
}
$v2 = "'" . $conn->real_escape_string($activeUUID) . "'";

//SELECT
$all_items = array();

//1. Select all records for checklist items stored in model_creation_suite, Count the number of items in the checklist.
$sqlsel1 = "SELECT * FROM ubm_modelcreationsuite_identification_setup WHERE model_UUID=$v2";
$rs1 = $conn->query($sqlsel1);
if ($rs1 === false) {
    trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
    if (mysqli_num_rows($rs1) > 0) {
        
        //2. Add the result set to the $all_items [] array
        while ($items = $rs1->fetch_assoc()) {
            $modelUUID = stripslashes($items['model_UUID']);
            $legalEntity = stripslashes($items['legal_entity']);
            $ccode = stripslashes($items['ccode']);
            $contactName = stripslashes($items['contact_name']);
            $phone = stripslashes($items['phone']);
            $modeltitle = stripslashes($items['model_title']);
            $compatibleWith = stripslashes($items['compatible_with']);
            $subType = stripslashes($items['sub_type']);
            $hardware = stripslashes($items['hardware']);
            $os = stripslashes($items['os']);
            $ubmServicesRequired = stripslashes($items['ubm_services_required']);
            $description = stripslashes($items['description']);
            $goal = stripslashes($items['goal']);
            $scope = stripslashes($items['scope']);
            $features = stripslashes($items['features']);
            $desiredResults = stripslashes($items['desired_results']);
            $createdBy = stripslashes($items['created_by']);
            $creationDate = stripslashes($items['creation_date']);
        }
        
        //6. JSONP packaged $all_items array
        echo $_GET['callback'] . '(' . json_encode($all_items) . ')';
         //Output $all_items array in json encoded format.
        
    } else {
    }
}
