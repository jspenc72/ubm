<?php
require_once ('globalGetVariables.php');
//require_once ('ubms_db_config.php');
require_once ('DBConnect_UBMv1.php');
error_reporting(E_ALL);
ini_set('display_errors', '1');

$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
$username = $_GET['username'];
$activeChecklistItemUUID = $_GET['activeChecklistItemUUID'];
$allowableInput = $_GET['allowableInput'];
$inputType = $_GET['inputType'];

// check connection 
if ($conn->connect_error) {
    trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
}
$v2 = "'" . $conn -> real_escape_string($username) . "'";
$v4 = "'" . $conn -> real_escape_string($activeChecklistItemUUID) . "'";
$v5 = "'" . $conn -> real_escape_string($allowableInput) . "'";
$v6 = "'" . $conn -> real_escape_string($inputType) . "'";

$sqlsel = "SELECT * FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID WHERE UUID=$activeChecklistItemUUID";
$rs = $conn -> query($sqlsel);
if ($rs === false) {
    trigger_error('Wrong SQL: ' . $sqlsel . ' Error Is: ' . $conn -> error, E_USER_ERROR);
} else {
    while ($items = $rs->fetch_assoc()) {
        $returnItemId = stripslashes($items['checklistItem_id']);
    }
}
switch ($inputType) {
    case "fileInput":
        $sql = "UPDATE ubm_model_checklistItems SET item_type_fileInput=$v5 WHERE id=$returnItemId";
        $callbackMessage = "Checklist Item $activeChecklistItemUUID Type File was modified.";
        break;
    case "textInput":
        $sql = "UPDATE ubm_model_checklistItems SET item_type_textInput=$v5 WHERE id=$returnItemId";
        $callbackMessage = "Checklist Item $activeChecklistItemUUID Type textInput was modified.";
        break;
    case "CheckboxCompletion":
        $sql = "UPDATE ubm_model_checklistItems SET item_type_YN=$v5 WHERE id=$returnItemId";
        $callbackMessage = "Checklist Item $activeChecklistItemUUID Type Yes/No was modified.";
        break;
    default:
     echo "No Case Matched";
}
if ($conn -> query($sql) === false) {
    trigger_error('Wrong SQL: ' . $sql . ' Error Is: ' . $conn -> error, E_USER_ERROR);
} else {
	$affected_rows = $conn -> affected_rows;
	echo $_GET['callback'] . '(' . "[{'message' : '$callbackMessage $affected_rows'}]" . ')';
}
