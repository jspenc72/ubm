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

//UPDATE
$v10 = "'" . $conn->real_escape_string($activeModelAlternativeId) . "'";
$v2 = "'" . $conn->real_escape_string($annualCostHigh) . "'";
$v3 = "'" . $conn->real_escape_string($annualCostLow) . "'";
$v4 = "'" . $conn->real_escape_string($annualBenefitHigh) . "'";
$v5 = "'" . $conn->real_escape_string($annualBenefitLow) . "'";
$v6 = "'" . $conn->real_escape_string($lowExpectedROI) . "'";
$v7 = "'" . $conn->real_escape_string($highExpectedROI) . "'";
$v8 = "'" . $conn->real_escape_string($decision) . "'";

$sql = "UPDATE `ubm_model_alternatives` SET annual_cost_high=$annualCostHigh, annual_cost_low=$annualCostLow, annual_benefit_high=$annualBenefitHigh, annual_benefit_low=$annualBenefitLow, high_annual_expected_roi=$highExpectedROI, low_annual_expected_roi=$lowExpectedROI, decision=$decision WHERE id=$activeModelAlternativeId";
if ($conn->query($sql) === false) {
    trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
    echo ("failure");
} else {
    $affected_rows = $conn->affected_rows;
    echo "string";
    echo $_GET['callback'] . '(' . "{'message' : 'The number of affected rows is $affected_rows, the alternative modified was $activeModelAlternativeId'}" . ')';
}
