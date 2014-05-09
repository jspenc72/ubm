 <?php
require_once('globalGetVariables.php');
require_once('ubms_db_config.php');
require_once('DBConnect_UBMv1.php');		//Provides the variables used for UBMv1 database connection $conn

	$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
	// check connection
	if ($conn->connect_error) {
	  trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
	}
//SELECT
$all_items = array();
//1. Get the longest path_length for the activeModelOwnersUUID position

//2. Begin a for loop to gather each of the positions that 
			
			$sqlsel1="SELECT * 					
			FROM ubm_model_position_closure
			JOIN ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID
			ON ubm_model_position_closure.descendant_UUID=ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.UUID
			JOIN ubm_model_positions
			ON ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.position_id=ubm_model_positions.id
			WHERE ubm_model_position_closure.ancestor_UUID=$activeModelOwnersUUID
			AND ubm_model_position_closure.path_length>0"; //Long version of what is shown below.
			$sqlsel1="SELECT * FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID c 
						JOIN ubm_model_position_closure t 
							ON	(c.UUID=t.descendant_UUID)
						JOIN ubm_model_positions
						ON c.position_id=ubm_model_positions.id							
						WHERE t.ancestor_UUID=$activeModelOwnersUUID
						ORDER BY t.path_length";//NEED to add if statment that retrieves the record where the current 
												//descendant has a relationship with path length of 1 if the returned 
												//path_length is greater than 1.
			//Select all 
			$rs1=$conn->query($sqlsel1);
			if($rs1 === false) {
			  trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
			} else {			
				if(mysqli_num_rows($rs1)>0){
//2. Add the result set to the $all_items [] array	
					while ($items = $rs1->fetch_assoc()) {
						$path_length = stripslashes($items['path_length']);
						$descendant_UUID = stripslashes($items['descendant_UUID']);
						if($path_length<2 && $path_length>0){
							$all_items [] = $items;
						}else{
							$sqlsel2="SELECT * FROM ubm_model_position_closure c
										JOIN ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID s 
											ON	(s.UUID=c.descendant_UUID)
										JOIN ubm_model_positions
											ON s.position_id=ubm_model_positions.id	
										WHERE c.descendant_UUID=$descendant_UUID
										AND c.path_length=1";
							//Select all 
							$rs2=$conn->query($sqlsel2);
							if($rs2 === false) {
							  trigger_error('Wrong SQL: ' . $sqlsel2 . ' Error: ' . $conn->error, E_USER_ERROR);
							} else {			
								if(mysqli_num_rows($rs2)>0){
				//2. Add the result set to the $all_items [] array	
									while ($items2 = $rs2->fetch_assoc()) {
										$all_items [] = $items2;
									}				
										//echo mysqli_num_rows($rs2);				
								}else{
//									echo "this is a test 1";
								}
										$num_rows2 = mysqli_num_rows($rs2);
										//echo "the total number of rows: $num_rows </br>";									
							}
						}
					}				
						//echo mysqli_num_rows($rs2);				
				}else{
	//				echo "this is a test 2";
				}
						$num_rows = mysqli_num_rows($rs1);
						//echo "the total number of rows: $num_rows </br>";									
			}

//6. JSONP packaged $all_items array
			echo $_GET['callback'] . '(' . json_encode($all_items) . ')';				//Output $all_items array in json encoded format.
	 