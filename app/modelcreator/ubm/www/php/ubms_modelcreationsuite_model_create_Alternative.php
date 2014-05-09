 <?php
require_once('globalGetVariables.php');
require_once('ubms_db_config.php');
require_once('DBConnect_UBMv1.php');		//Provides the variables used for UBMv1 database connection $conn

	$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
	// check connection
	if ($conn->connect_error) {
	  trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
	}
//INSERT
$v2 = "'" . $conn -> real_escape_string($activeModelUUID) . "'";
$v3 = "'" . $conn -> real_escape_string($alternativeDescription) . "'";
$v4 = "'" . $conn -> real_escape_string($alternativeDecision) . "'";
$v5 = "'" . $conn -> real_escape_string($username) . "'";

$sqlins = "INSERT INTO ubm_model_alternatives (model_UUID, description, decision, created_by) VALUES ( $v2, $v3, $v4, $v5 )"; //Creates a New Alternative record.
if ($conn -> query($sqlins) === false) {
	trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn -> error, E_USER_ERROR);
} else {
	$last_inserted_id = $conn -> insert_id;
	//$affected_rows = $conn -> affected_rows;
	$sqlins2 = "INSERT INTO ubm_model_has_alternatives (model_UUID, alternative_id) VALUES ( $v2, $last_inserted_id )";
	if ($conn -> query($sqlins2) === false) {
		trigger_error('Wrong SQL: ' . $sqlins2 . ' Error: ' . $conn -> error, E_USER_ERROR);
	} else {
		echo $_GET['callback'] . '(' . "{'message' : 'Requested Alternative $alternativeDescription was created successfully and added to model id: $activeModelUUID !'}" . ')';
	}
}
