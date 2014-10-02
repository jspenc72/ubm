<?php
require_once('globalGetVariables.php');
require_once('ubms_db_config.php');
require_once('DBConnect_UBMv1.php');		//Provides the variables used for UBMv1 database connection $conn
error_reporting(E_ALL);
ini_set('display_errors', '1');
$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
// check connection
if ($conn -> connect_error) {
	trigger_error('Database connection failed: ' . $conn -> connect_error, E_USER_ERROR);
}
$v5 = "'" . $conn -> real_escape_string($username) . "'";
$all_items = array();
$sqlsel1="SELECT * FROM ubm_model_checklists cl 
			JOIN ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID u
			ON (cl.id=u.checklist_id) 
			WHERE cl.created_by=$v5
			AND cl.Soft_DELETE='FALSE'
			ORDER BY cl.title";
$rs1=$conn->query($sqlsel1);
if($rs1 === false) {
  trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
	if(mysqli_num_rows($rs1)>0){
		while ($items = $rs1->fetch_assoc()) {					
			$all_items[] = $items;
		}
	}
}
echo $_GET['callback'] . '(' . json_encode($all_items) . ')';
