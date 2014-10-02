 <?php
require_once ('globalGetVariables.php');
require_once ('ubms_db_config.php');
require_once ('DBConnect_UBMv1.php');
require_once('ubms_modelcreationsuite_model_objectToolsGeneral.php');
echo "<center>Legal Entity: <strong>Business Model Consulting LLC</strong></center>";
echo "</br><center>Application Title: <strong>BMCL Model Creator API V1.0.4 Alpha</strong></center>";
echo "</br><center>User Summary</center>";
 //Provides the variables used for UBMv1 database connection $conn
$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
// check connection
if ($conn->connect_error) {
    trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
}
//SELECT
$all_items = array();
//1. Select all records in the ubm_model_positions table that have an instance created in the ubm_model_has_positions table.
$sqlsel1 = "SELECT * FROM members";
//Select all
$rs1 = $conn->query($sqlsel1);
if ($rs1 === false) {
    trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
    if (mysqli_num_rows($rs1) > 0) {
        //2. Add the result set to the $all_items [] array
		echo "Total App Users#: " . $totalNumberOfMembers = mysqli_num_rows($rs1) . "</br>";
        while ($items = $rs1->fetch_assoc()) {
			$creatorId = $items['username'];
			$displayName = $items['display_name'];
						$sqlsel3 = "SELECT * FROM ubm_model WHERE creator_id='$creatorId'";
			$sqlsel2 = "SELECT * FROM ubm_model 
								 JOIN ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID
								 ON ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.model_id=ubm_model.id
								 WHERE ubm_model.creator_id='$creatorId'";
			$rs2 = $conn->query($sqlsel2);
			if ($rs2 === false) {
			    trigger_error('Wrong SQL: ' . $sqlsel2 . ' Error: ' . $conn->error, E_USER_ERROR);
			} else {
				$numUsersModels = mysqli_num_rows($rs2);
				echo "</br></br></br><strong>( $numUsersModels ) Models Created By $displayName - $creatorId :</strong></br></br>";
				require_once("ubms_setup_getUsersProfile.php");
				echo "</br>".json_encode(getUsersProfile($creatorId, $DBServer, $DBUser, $DBPass, $DBName))."</br>";
			     
		        while ($items2 = $rs2->fetch_assoc()) {
					if($items2['Soft_DELETE']=="TRUE"){
						$modelUUID = $items2['UUID'];
			        	echo "Model Title: $ModelTitle - Model UUID: $modelUUID (DELETED)</br>";
					}else{
						$modelUUID = $items2['UUID'];
						$ModelTitle = $items2['title'];
			        	echo "</br>Model Title: $ModelTitle - Model UUID: $modelUUID </br>";
						$OUUID = "'".$conn->real_escape_string($modelUUID)."'";
						$attributeContainer[$modelUUID]["attributes"]["object_type"]                       = getObjectType($modelUUID, $DBServer, $DBUser, $DBPass, $DBName); // call function to get Object Type.
						$attributeContainer[$modelUUID]["attributes"]["number_of_ancestors"]               = getNumberofAncestors($modelUUID, $DBServer, $DBUser, $DBPass, $DBName); // call function to get Object Type.
						$attributeContainer[$modelUUID]["attributes"]["number_of_descendants"]             = getNumberofDescendants($modelUUID, $DBServer, $DBUser, $DBPass, $DBName); // call function to get Object Type.
						$attributeContainer[$modelUUID]["attributes"]["number_of_immediate_ancestors"]     = getNumberofImmediateAncestors($modelUUID, $DBServer, $DBUser, $DBPass, $DBName); // call function to get Object Type.
						$attributeContainer[$modelUUID]["attributes"]["number_of_immediate_descendants"]   = getNumberofImmediateDescendants($modelUUID, $DBServer, $DBUser, $DBPass, $DBName); // call function to get Object Type.
						$attributeContainer[$modelUUID]["attributes"]["number_of_instances"]               = getNumberofInstances($modelUUID, $DBServer, $DBUser, $DBPass, $DBName); // call function to get Object Type.
						echo "</br>".$_GET['callback'] . '(' . json_encode($attributeContainer) . ')</br></br>';
						unset($attributeContainer);
						resetAttributeContainer();
					}
		        }
				echo "#Users Models: " . $numberOfModelsforMember = mysqli_num_rows($rs2);
			}
        }
        //echo mysqli_num_rows($rs2);
    } else {
        $num_rows = mysqli_num_rows($rs1);        
        //echo "no results" . $num_rows;
    }
    //echo "the total number of rows: $num_rows </br>";    
}
//6. JSONP packaged $all_items array
// echo $_GET['callback'] . '(' . json_encode($all_items) . ')';
 //Output $all_items array in json encoded format.