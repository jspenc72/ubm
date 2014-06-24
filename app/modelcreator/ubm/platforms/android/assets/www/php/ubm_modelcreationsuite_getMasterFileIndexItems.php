 <?php
 require_once('globalGetVariables.php'); 

$DBServer = 'localhost'; // e.g 'localhost' or '192.168.1.100'
$DBUser   = 'jessespe';
$DBPass   = 'Xfn73Xm0';
$DBName   = 'jessespe_UBMv1';			
	$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);

	// check connection
	if ($conn->connect_error) {
	  trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
	}

//SELECT
$all_items = array();
			$sqlsel1="SELECT * FROM ubm_mfi_volume";		//Select all 
			$rs1=$conn->query($sqlsel1);
			if($rs1 === false) {
			  trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
			} else {
					if($rs1 === false) {												//If something is wrong...
					  trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
					}else{
						while ($items = $rs1->fetch_assoc()) {
							$all_items[] = $items;		
						}
							$num_rows = mysqli_num_rows($rs1);
						//echo "the total number of rows: $num_rows </br>";						
						}								
					}


				
			

			//echo "The row is: $x <br>";
			//echo $_GET['callback'] . '(' . json_encode($all_items) . ')';				//Output $all_items array in json encoded format.
  
//6. JSONP packaged $all_items array
			echo $_GET['callback'] . '(' . json_encode($all_items) . ')';				//Output $all_items array in json encoded format.
	 