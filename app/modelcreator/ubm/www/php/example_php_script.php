<?php
require_once('globalGetVariables.php');
require_once('example_ubms_db_config.php');
require_once('DBConnect_UBMv1.php');		//Provides the variables used for UBMv1 database connection $conn

$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
	if ($conn->connect_error) {
	  trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
	}
$all_items = array();
$sqlsel1="SELECT * 					
FROM example_list";
$rs1=$conn->query($sqlsel1);
if($rs1 === false) {
	trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
	
	if(mysqli_num_rows($rs1)>0){
		while ($items2 = $rs1->fetch_assoc()) {				
			$all_items [] = $items2;
		}
		echo $_GET['callback'] . '(' . json_encode($all_items) . ')';				//Output $all_items array in json encoded format.		
	}								
}
