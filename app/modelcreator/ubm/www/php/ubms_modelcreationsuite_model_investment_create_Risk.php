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

//INSERT
$v2 = "'" . $conn->real_escape_string($riskDescription) . "'";
$v3 = "'" . $conn->real_escape_string($riskCategory) . "'";
$v4 = "'" . $conn->real_escape_string($username) . "'";
$v5 = "'" . $conn->real_escape_string($activeModelInvestmentId) . "'";

$sqlins = "INSERT INTO ubm_model_risks (description, category, created_by) VALUES ( $v2, $v3, $v4 )";
if ($conn->query($sqlins) === false) {
    trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
    $last_inserted_id = $conn->insert_id;
    
    //$affected_rows = $conn -> affected_rows;
    $sqlins2 = "INSERT INTO ubm_model_investment_has_risks (investment_id, risk_id, created_by) VALUES ( $v5, $last_inserted_id, $v4 )";
    if ($conn->query($sqlins2) === false) {
        trigger_error('Wrong SQL: ' . $sqlins2 . ' Error: ' . $conn->error, E_USER_ERROR);
    } else {
        echo $_GET['callback'] . '(' . "{'message' : 'The Risk $riskDescription was created successfully and added to investment id: $activeModelInvestmentId !'}" . ')';
    }
}
