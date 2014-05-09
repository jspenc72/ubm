<?php
require_once('globalGetVariables.php');
//require_once('ubms_db_config.php');
require_once('DBConnect_UBMv1.php');		//Provides the variables used for UBMv1 database connection $conn

$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
// check connection
if ($conn->connect_error) {
  trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
}
	
//INSERT
$v2 = "'" . $conn -> real_escape_string($activeModelAlternativeId) . "'";
$v3 = "'" . $conn -> real_escape_string($description) . "'";
$v4 = "'" . $conn -> real_escape_string($title) . "'";
$v5 = "'" . $conn -> real_escape_string($type) . "'";
$v6 = "'" . $conn -> real_escape_string($username) . "'";

$sqlins = "INSERT INTO ubm_model_investments (description, title, type, created_by) VALUES ( $v3, $v4, $v5. $v6 )"; 
if ($conn -> query($sqlins) === false) {
	trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn -> error, E_USER_ERROR);
} else {
	$last_inserted_id = $conn -> insert_id;
	//$affected_rows = $conn -> affected_rows;
	$sqlins2 = "INSERT INTO ubm_model_alternative_has_investments (alternative_id, investment_id, created_by) VALUES ( $v5, $last_inserted_id, $v6 )";
	if ($conn -> query($sqlins2) === false) {
		trigger_error('Wrong SQL: ' . $sqlins2 . ' Error: ' . $conn -> error, E_USER_ERROR);
	} else {
		echo $_GET['callback'] . '(' . "{'message' : 'The Investment $title was created successfully and added to alternative id: $activeModelAlternativeId !'}" . ')';
	}
}
