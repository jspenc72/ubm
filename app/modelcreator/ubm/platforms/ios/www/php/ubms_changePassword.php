<?php
require_once('globalGetVariables.php');
//require_once('ubms_db_config.php');
$securePassword = md5($newPassword);

$conn = mysqli_connect("localhost", "jessespe", "Xfn73Xm0", "jessespe_FindMyDriver");
// check connection
if ($conn -> connect_error) {
	trigger_error('Database connection failed: ' . $conn -> connect_error, E_USER_ERROR);
}
//UPDATE
		$sql="UPDATE `members` SET password='$securePassword', password_status='1' WHERE username='$username'";
		if($conn->query($sql) === false) {
		  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
		} else {
		  $affected_rows = $conn->affected_rows;
		  echo $_GET['callback'] . '(' . "{'message' : 'The number of affected rows is $affected_rows, the password has been successfully changed'}" . ')';
		}
