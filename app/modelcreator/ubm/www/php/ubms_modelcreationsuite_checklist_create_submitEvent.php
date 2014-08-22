<?php
require_once ('globalGetVariables.php');
require_once ('ubms_db_config.php');
require_once ('DBConnect_UBMv1.php');
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
function generateRandomString($length = 60) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
$uniqueEventString = generateRandomString();
$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
$activeChecklistUUID = $_GET['activeChecklistUUID'];
$username = $_GET['username'];
// check connection 
if ($conn->connect_error) {
    trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
}
//INSERT

$v2 = "'" . $conn -> real_escape_string($username) . "'";
$v3 = "'" . $conn -> real_escape_string($activeChecklistUUID) . "'";

$sqlins = "INSERT INTO ubm_model_checklist_submitEvents (eventString, created_by, checklist_UUID)
            VALUES ('$uniqueEventString',$v2,$v3)";
 
if ($conn -> query($sqlins) === false) {
    echo "test";
    //trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn -> error, E_USER_ERROR);
} else {
	$last_inserted_id = $conn -> insert_id;
	$affected_rows = $conn -> affected_rows;
	echo $_GET['callback'] . '(' . "[{'message' : 'Submit Event: $last_inserted_id created successfully!','eventString' : '".$uniqueEventString."','eventId' : $last_inserted_id }]" . ')';
}

