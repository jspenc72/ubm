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

//INSERT
$v2 = "'" . $conn->real_escape_string($activeOwnerUUID) . "'";
$v3 = "'" . $conn->real_escape_string($percentOwned) . "'";
$v4 = "'" . $conn->real_escape_string($ownerName) . "'";
$v5 = "'" . $conn->real_escape_string($username) . "'";

$query = "SELECT * FROM ubm_modelCreationSuite_orgChart_ownerName WHERE owner_id=$activeOwnerUUID";
$result = mysqli_query($conn, $query);
if (!$result) { //there is a problem with the table

}
$returnedPercentOwned = array();
while ($items = $result->fetch_assoc()) {
	$returnedPercentOwned[] = $items['percent_owned'];					
}

$totalPercentOwned = null;
foreach ($returnedPercentOwned as $key => $value) {
	$totalPercentOwned += $value;
}

$totalPercentOwned += $percentOwned;

if ($totalPercentOwned < 100) {
	$sqlins = "INSERT INTO ubm_modelCreationSuite_orgChart_ownerName (name, owner_id, percent_owned, created_by) VALUES ( $v4, $v2, $v3, $v5 )";
	if ($conn->query($sqlins) === false) {
	    trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn->error, E_USER_ERROR);
	} else {
	}

	echo $_GET['callback'] . '(' . "{'message' : 'Owner $ownerName created successfully!'}" . ')';
} else {
	echo $_GET['callback'] . '(' . "{'message' : 'Total cannot be higher than 100 percent!'}" . ')';
}
