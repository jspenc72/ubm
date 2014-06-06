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
//1. Select all records in the ubm_model_positions table that have an instance created in the ubm_model_has_positions table.
			$sqlsel1="SELECT * FROM ubm_model_has_positions WHERE model_id='$activeModelId'";
			$sqlsel1="SELECT * 
			FROM ubm_model_has_positions  
			JOIN ubm_model_positions 
			ON ubm_model_has_positions.position_id=ubm_model_positions.id
			WHERE ubm_model_has_positions.model_id='$activeModelId'
			ORDER BY ubm_model_has_positions.model_position_reports_to_id";		
			//Select all 
			$rs1=$conn->query($sqlsel1);
			if($rs1 === false) {
			  trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
			} else {
				if(mysqli_num_rows($rs1)>0){
//2. Add the result set to the $all_items [] array	
					while ($items = $rs1->fetch_assoc()) {
//						$returnFinalReviewer = stripslashes($items['final_reviewer_username']);
//						$row_items ['final_reviewer_username'] = $returnFinalReviewer;
						$all_items [] = $items;
					}				
						//echo mysqli_num_rows($rs2);				
				}else{
				
				}
						$num_rows = mysqli_num_rows($rs1);
						//echo "the total number of rows: $num_rows </br>";									
			}

//6. JSONP packaged $all_items array
			echo $_GET['callback'] . '(' . json_encode($all_items) . ')';				//Output $all_items array in json encoded format.
	 