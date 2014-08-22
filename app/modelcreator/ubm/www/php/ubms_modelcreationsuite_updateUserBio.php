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
$v2 = "'" . $conn->real_escape_string($userbio) . "'";
$v3 = "'" . $conn->real_escape_string($username) . "'";
$v4 = "'" . $conn->real_escape_string($userfirstname) . "'";
$v5 = "'" . $conn->real_escape_string($userlastname) . "'";
$v6 = "'" . $conn->real_escape_string($useremployer) . "'";

//SELECT
$all_items = array();
//1. Select all records for  items stored in ubm_model_alternative_has_pros for the current active alternative.
$update = "UPDATE `members` SET bio=$v2, first_name=$v4, last_name=$v5, employer=$v6 WHERE username=$v3";
if ($conn->query($update) === false) {
    trigger_error('Wrong SQL: ' . $update . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
    $affected_rows = $conn->affected_rows;
    echo $_GET['callback'] . '(' . "{'message' : 'The number of affected rows is $affected_rows. If the affected rows was not zero the user was updated successfully.'}" . ')';
}