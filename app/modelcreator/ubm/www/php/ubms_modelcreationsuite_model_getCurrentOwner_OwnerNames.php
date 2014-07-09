<?php
require_once('globalGetVariables.php');
//require_once('ubms_db_config.php');
require_once('DBConnect_UBMv1.php');		//Provides the variables used for UBMv1 database connection $conn

$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
// check connection
	if ($conn->connect_error) {
	  trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
	}
			$query = "SELECT * FROM ubm_modelCreationSuite_orgChart_ownerName WHERE owner_id=$activeOwnerUUID";
			$result = mysqli_query($conn, $query);
			if (!$result) { //there is a problem with the table
			}
			$all_items = array();
			$percentOwned = array();
			while ($items = $result->fetch_assoc()) {
				$percentOwned[] = $items['percent_owned'];					
				$all_items[] = $items;
			}
			echo $_GET['callback'] . '(' . json_encode($all_items) . ')';
