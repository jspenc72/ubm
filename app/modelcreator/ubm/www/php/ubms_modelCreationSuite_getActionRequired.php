<?php
require_once ('globalGetVariables.php');

//require_once ('ubms_db_config.php');
require_once ('DBConnect_UBMv1.php');

//Provides the variables used for UBMv1 database connection $conn

$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);

// check connection
if ($conn->connect_error) {
    trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
}

//SELECT
$sqlsel = "SELECT * FROM model_creation_suite_has_prepared_by_records WHERE task_id='$taskId' AND model_UUID='$activeModelUUID'";
$rs = $conn->query($sqlsel);
if ($rs === false) {
    trigger_error('Wrong SQL: ' . $sqlsel . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
    if (mysqli_num_rows($rs) > 0) {
        while ($items = $rs->fetch_assoc()) {
            $actionRequired = stripslashes($items['action_required']);
        }
    }
}
echo $_GET['callback'] . '(' . "{'actionRequired' : '$actionRequired'}" . ')';
