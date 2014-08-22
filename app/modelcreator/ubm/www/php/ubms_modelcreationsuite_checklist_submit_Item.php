<?php
require_once ('globalGetVariables.php');
require_once ('ubms_db_config.php');
require_once ('DBConnect_UBMv1.php');
error_reporting(E_ALL);
ini_set('display_errors', '1');

$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
$activeChecklistUUID = $_GET['activeChecklistUUID'];
$activeChecklistItemUUID = $_GET['activeChecklistItemUUID'];
$activeChecklistItemTextInput = $_GET['activeChecklistItemTextInput'];
$activeChecklistItemYN = $_GET['activeChecklistItemYN'];
$activeSubmitEventId = $_GET['activeSubmitEventId'];

$username = $_GET['username'];
// check connection 
if ($conn->connect_error) {
    trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
}
$v2 = "'" . $conn -> real_escape_string($username) . "'";
$v3 = "'" . $conn -> real_escape_string($activeChecklistUUID) . "'";
$v4 = "'" . $conn -> real_escape_string($activeChecklistItemUUID) . "'";
$v5 = "'" . $conn -> real_escape_string($activeChecklistItemTextInput) . "'";
$v6 = "'" . $conn -> real_escape_string($activeChecklistItemYN) . "'";
$v7 = "'" . $conn -> real_escape_string($activeSubmitEventId) . "'";
$sqlsel = "SELECT * FROM ubm_model_checklist_submissions WHERE submitEvent_id=$v7 AND checklistItem_UUID=$v4";
$rs=$conn->query($sqlsel);
if($rs===false){
    echo "There was a problem";
    trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn -> error, E_USER_ERROR);
}else{
    $num_rows = mysqli_num_rows($rs);
    if($num_rows>0){
        $callbackMessage = "Checklist Submission was updated!";
        while ($items = $rs->fetch_assoc()) {
             $returnId = stripslashes($items['id']);
        }
        $sql = "UPDATE ubm_model_checklist_submissions SET checklist_UUID=$v3, checklistItem_UUID=$v4, textInput=$v5, YN=$v6, submitEvent_id=$v7, created_by=$v2
                   WHERE id=$returnId";
    }else{
        $callbackMessage = "Checklist Submission was created: ";
        $sql = "INSERT INTO ubm_model_checklist_submissions (checklist_UUID, checklistItem_UUID, textInput, YN, submitEvent_id, created_by)
                    VALUES ($v3,$v4,$v5,$v6,$v7,$v2)";
    }
}
if ($conn -> query($sql) === false) {
    trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn -> error, E_USER_ERROR);
} else {
	$last_inserted_id = $conn -> insert_id;
	$affected_rows = $conn -> affected_rows;
	echo $_GET['callback'] . '(' . "[{'message' : '$callbackMessage $last_inserted_id'}]" . ')';
}

