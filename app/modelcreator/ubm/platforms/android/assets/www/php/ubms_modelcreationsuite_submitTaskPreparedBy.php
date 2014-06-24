<?php
require_once ('globalGetVariables.php');
require_once ('ubms_db_config.php');
require_once ('DBConnect_UBMv1.php');

//Provides the variables used for UBMv1 database connection $conn
$numberofresolutions = 2;
$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);

// check connection
if ($conn->connect_error) {
    trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
}

//INSERT
$v2 = "'" . $conn->real_escape_string($activeModelUUID) . "'";
$v3 = "'" . $conn->real_escape_string($username) . "'";
$v4 = "'" . $conn->real_escape_string($taskId) . "'";
$v5 = "'" . $conn->real_escape_string($startTime) . "'";

$sqlsel = "SELECT * FROM model_creation_suite_has_prepared_by_records WHERE model_UUID=$v2 AND task_id=$v4";
$rs = $conn->query($sqlsel);
if ($rs === false) {
    trigger_error('Wrong SQL: ' . $sqlsel . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
    if (mysqli_num_rows($rs) > 0) {
        $sql = "UPDATE `model_creation_suite_has_prepared_by_records` SET status='TRUE', preparer_username=$v3 WHERE model_UUID=$v2 AND task_id=$v4";
        if ($conn->query($sql) === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
        } else {
            $last_inserted_id = $conn->insert_id;
            $affected_rows = $conn->affected_rows;
        }
        echo $_GET['callback'] . '(' . "{'message' : 'The number of affected rows is $affected_rows.'}" . ')';
    } else {
        $sqlins = "INSERT INTO model_creation_suite_has_prepared_by_records (model_UUID, preparer_username, task_id, start_time) VALUES ($v2, $v3, $v4, $v5)";
        
        if ($conn->query($sqlins) === false) {
            trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn->error, E_USER_ERROR);
        } else {
            $last_inserted_id = $conn->insert_id;
            $affected_rows = $conn->affected_rows;
        }
        echo $_GET['callback'] . '(' . "{'message' : 'The number of affected rows is $affected_rows.'}" . ')';
    }
}

