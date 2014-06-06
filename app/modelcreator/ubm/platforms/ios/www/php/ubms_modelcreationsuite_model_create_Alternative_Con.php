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
$v3 = "'" . $conn -> real_escape_string($activeModelAlternativeId) . "'";
$v4 = "'" . $conn -> real_escape_string($alternativeConDescription) . "'";
$v5 = "'" . $conn -> real_escape_string($alternativeConROIRef) . "'";
$v6 = "'" . $conn -> real_escape_string($alternativeConHighCost) . "'";
$v7 = "'" . $conn -> real_escape_string($alternativeConLowCost) . "'";
$v8 = "'" . $conn -> real_escape_string($username) . "'";

$sqlins = "INSERT INTO ubm_model_alternative_cons (model_UUID, alternative_id, description, roi_ref, cost_low, cost_high, created_by) VALUES ( $v2, $v3, $v4, $v5, $v6, $v7, $v8 )"; //Creates a New Core Value record.
if ($conn -> query($sqlins) === false) {
	trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn -> error, E_USER_ERROR);
} else {
	$last_inserted_id = $conn -> insert_id;
	//$affected_rows = $conn -> affected_rows;
	$sqlins2 = "INSERT INTO ubm_model_alternative_has_cons (alternative_id, con_id) VALUES ( $v3, $last_inserted_id )";
	if ($conn -> query($sqlins2) === false) {
		trigger_error('Wrong SQL: ' . $sqlins2 . ' Error: ' . $conn -> error, E_USER_ERROR);
	} else {
		$sqlsel = "SELECT SUM(cost_high) AS cost_high_sum FROM ubm_model_alternative_cons WHERE alternative_id=$v3";
		$rs=$conn->query($sqlsel);
		if($rs === false) {
		  trigger_error('Wrong SQL: ' . $sqlsel . ' Error: ' . $conn->error, E_USER_ERROR);
		} else {
			while ($items = $rs->fetch_assoc()) {
				$sumHigh = $items['cost_high_sum'];
				$sqlsel2 = "SELECT SUM(cost_low) AS cost_low_sum FROM ubm_model_alternative_cons WHERE alternative_id=$v3";
				$rs2=$conn->query($sqlsel2);
				if($rs2 === false) {
				  trigger_error('Wrong SQL: ' . $sqlsel2 . ' Error: ' . $conn->error, E_USER_ERROR);
				} else {
					while ($items2 = $rs2->fetch_assoc()) {
						$sumLow = $items2['cost_low_sum'];

						 $sqlupd="UPDATE ubm_model_alternatives SET annual_cost_high=$sumHigh, annual_cost_low=$sumLow WHERE id=$v3";
						
						 if($conn->query($sqlupd) === false) {
						 trigger_error('Wrong SQL: ' . $sqlupd . ' Error: ' . $conn->error, E_USER_ERROR);
						 } else {
							 $affected_rows = $conn->affected_rows;
							echo $_GET['callback'] . '(' . "{'message' : 'Requested Alternative Con $alternativeConDescription was created successfully, the new sum of low cost estimate is $sumLow and sum of high cost estimate is $sumHigh added to model id: $activeModelUUID affected rows: $affected_rows!'}" . ')';						 
						 }				
					}
				}		
			}
		}
	}
}
