 <?php
 $aname = $_GET['appname'];
 $RQType = $_GET['RQType'];
 $username = $_GET['username'];
 $usrpasswd = $_GET['password'];
 //Put your json request variables here

$activeModelId = $_GET['activeModelId'];

//End JSON Request Variables
//Start Device Position Variables
$lat = $_GET['lat'];
$lng = $_GET['lng'];
//End Device Position Variables
$DBServer = 'localhost'; // e.g 'localhost' or '192.168.1.100'
$DBUser   = 'jessespe';
$DBPass   = 'Xfn73Xm0';
$DBName   = 'jessespe_UBMv1';			
	$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
	// check connection
	if ($conn->connect_error) {
	  trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
	}
$v3 = "'" . $conn -> real_escape_string($activeModelId) . "'";

//SELECT
$all_items = array();
//1. Select all records for checklist items stored in model_creation_suite, Count the number of items in the checklist.
			$sqlsel1="SELECT * FROM ubm_model WHERE id=$v3";		//Select all 
			$rs1=$conn->query($sqlsel1);
			if($rs1 === false) {
			  trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
			} else{
				while ($items1 = $rs1->fetch_assoc()) {
							$all_items [] = $items1;								
				}
			}

//6. JSONP packaged $all_items array
			echo $_GET['callback'] . '(' . json_encode($all_items) . ')';				//Output $all_items array in json encoded format.
	 