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

//1. Map the UUID of the Model to the Model ID in the ubm_model table
$sqlsel2="
SELECT * FROM ubm_model 
	JOIN ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID
		ON ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.model_id=ubm_model.id
WHERE ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.UUID='$activeModelUUID'
LIMIT 1";		//Select all information for each model that was in the first result set...
$rs2=$conn->query($sqlsel2);
if($rs2 === false) {
  trigger_error('Wrong SQL: ' . $sqlsel2 . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
	while ($items2 = $rs2->fetch_assoc()) {
		$returnedModelId = $items2['model_id'];
	}	
}	
//1. Check to see if the user is the creator of the currently active model..
			$sqlsel1="SELECT * FROM ubm_model WHERE id='$returnedModelId'";		//Select all 
			$rs1=$conn->query($sqlsel1);
			if($rs1 === false) {
			  trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
			} else {		
				while ($items = $rs1->fetch_assoc()) {
							$returnModelCreatorId = stripslashes($items['creator_id']);
					if($returnModelCreatorId==$username){
//2. If user is the creator of the model, remove the selected user permission from model_has_members
						$sql="DELETE FROM ubm_model_has_members WHERE id='$selectedUser'";
						if($conn->query($sql) === false) {
						  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
						} else {
							$affected_rows = $conn->affected_rows;
							//echo $affected_rows;
					       	echo $_GET['callback'] . '(' . "{'message' : 'User was successfully removed from this model. The number of affected rows is: $affected_rows.','validation' : 'TRUE'}" . ')';							
						}							
					}else{
				       echo $_GET['callback'] . '(' . "{'message' : 'Only the creator of this model can modify users who have access.','validation' : 'FALSE'}" . ')';							
					}
				}								
						$num_rows = mysqli_num_rows($rs1);
//						echo "the total number of rows: $num_rows </br>";						
			}
 
//6. JSONP packaged $all_items array
//			echo $_GET['callback'] . '(' . json_encode($all_items) . ')';				//Output $all_items array in json encoded format.
				 