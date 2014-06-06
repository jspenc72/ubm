<?php
require_once('globalGetVariables.php');
require_once('ubms_db_config.php');
require_once('DBConnect_UBMv1.php');		//Provides the variables used for UBMv1 database connection $conn

$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
// check connection
if ($conn->connect_error) {
  trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
}

//INSERT
$v2 = "'" . $conn -> real_escape_string($activeInvestmentId) . "'";
$v3 = "'" . $conn -> real_escape_string($incomePerUnit) . "'";
$v4 = "'" . $conn -> real_escape_string($description) . "'";
$v5 = "'" . $conn -> real_escape_string($numberOfUnits) . "'";
$v6 = "'" . $conn -> real_escape_string($totalIncome) . "'";
$v7 = "'" . $conn -> real_escape_string($username) . "'";

$sqlins = "INSERT INTO ubm_model_investment_income_drivers (income_per_unit, description, number_of_units, total_income, created_by) VALUES ( $v3, $v4, $v5, $v6, $v7 )"; //Creates a New Core Value record.
if ($conn -> query($sqlins) === false) {
	trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn -> error, E_USER_ERROR);
} else {
	$last_inserted_id = $conn -> insert_id;
	//$affected_rows = $conn -> affected_rows;
	$sqlins2 = "INSERT INTO ubm_model_investment_has_income_drivers (investment_id, created_by, income_driver_id) VALUES ( $v2, $v7, $last_inserted_id )";
	if ($conn -> query($sqlins2) === false) {
		trigger_error('Wrong SQL: ' . $sqlins2 . ' Error: ' . $conn -> error, E_USER_ERROR);
	} else {
		echo $_GET['callback'] . '(' . "{'message' : 'Requested Income Driver $description was created successfully and added to Investment id: $activeInvestmentId !'}" . ')';
	}
}
