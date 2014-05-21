<?php
require_once('globalGetVariables.php');
require_once('ubms_db_config.php');
require_once('DBConnect_UBMv1.php');		//Provides the variables used for UBMv1 database connection $conn
if ($username == 'adamg') {
	$admin = "Adam Gustafson";
} else {
	$admin = "Jesse Spencer";
}
$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
// check connection
	if ($conn->connect_error) {
	  trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
	}
			$query = "SELECT * FROM `ubm_mcs_app_openitems` WHERE status='open' AND assigned_to='$admin'";
			$result = mysqli_query($conn, $query);
			if (!$result) { //there is a problem with the table
			}
			$all_items = array();
			while ($items = $result->fetch_assoc()) {					
				$all_items[] = $items;
			}
			echo $_GET['callback'] . '(' . json_encode($all_items) . ')';