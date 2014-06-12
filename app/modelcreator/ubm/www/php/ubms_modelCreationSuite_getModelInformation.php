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

//SELECT

$all_items = array();

//1. Select all records for  items stored in ubm_model_alternative_has_pros for the current active alternative.
require_once ('ubms_getModelIdFromUUID.php');
$sqlsel1 = "SELECT * FROM ubm_model WHERE id=$modelId";

//Select all
$rs1 = $conn->query($sqlsel1);
if ($rs1 === false) {
    trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
    while ($items1 = $rs1->fetch_assoc()) {
        $modelTitle = stripslashes($items1['title']);
        $modelReference = stripslashes($items1['reference']);
        $modelDescription = stripslashes($items1['description']);
    }
}
echo $_GET['callback'] . '(' . "{'modelTitle' : '$modelTitle', 'modelReference' : '$modelReference', 'modelDescription' : '$modelDescription'}" . ')';
