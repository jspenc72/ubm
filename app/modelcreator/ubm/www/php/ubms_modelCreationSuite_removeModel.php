<?php
require_once ('globalGetVariables.php');
require_once ('ubms_db_config.php');
require_once ('DBConnect_UBMv1.php');

//Provides the variables used for UBMv1 database connection $conn
$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
echo $activeModelUUID;
// check connection
if ($conn->connect_error) {
    trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
}
$sqlsel = "SELECT model_id WHERE UUID=$activeModelUUID";
$rs1 = $conn->query($sqlsel);
if ($rs1 === false) {
    trigger_error('Wrong SQL: ' . $sqlsel . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
    $row = mysql_fetch_row($rs1);
    $modelId = $row[0];
}

$sql2 = "DELETE FROM ubm_model_has_members WHERE model_UUID=$activeModelUUID";

if ($conn->query($sql2) === false) {
    trigger_error('Wrong SQL: ' . $sql2 . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
    $affected_rows2 = $conn->affected_rows;
}

$sql = "UPDATE `ubm_model` SET Soft_DELETE='TRUE' WHERE username='$username' AND id=$modelId";
if ($conn->query($sql) === false) {
    trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
    $affected_rows = $conn->affected_rows;
    echo $_GET['callback'] . '(' . "{'message' : 'The UUID of the model removed was $activeModelUUID, the id of the model was $modelid. The number of affected rows was $affected_rows! $affected_rows2 shared this model and are now removed.'}" . ')';
}
