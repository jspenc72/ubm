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
$v3 = "'" . $conn->real_escape_string($username) . "'";
$v5 = "'" . $conn->real_escape_string($useremailpreference) . "'";
$v6 = "'" . $conn->real_escape_string($usersmspreference) . "'";

//SELECT
$all_items = array();
//1. Select all records for  items stored in ubm_model_alternative_has_pros for the current active alternative.
$update = "UPDATE `members` SET user_sms_preference=$v6, user_email_preference=$v5 WHERE username=$v3";
if ($conn->query($update) === false) {
    trigger_error('Wrong SQL: ' . $update . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
    $affected_rows = $conn->affected_rows;
    echo $_GET['callback'] . '(' . "{'message' : 'The number of affected rows is $affected_rows. If the affected rows was not zero the user was updated successfully.'}" . ')';
}