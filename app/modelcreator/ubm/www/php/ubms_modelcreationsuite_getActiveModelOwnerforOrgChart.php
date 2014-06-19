 <?php
require_once ('globalGetVariables.php');
require_once ('ubms_db_config.php');
require_once ('DBConnect_UBMv1.php');

//Provides the variables used for UBMv1 database connection $conn

$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);

// check connection
if ($conn->connect_error) {
    trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
}

//SELECT
$all_items = array();

//1. Select all records in the ubm_model_positions table that have an instance created in the ubm_model_has_positions table.
$sqlsel1 = "SELECT * 					
			FROM ubm_modelcreationsuite_heirarchy_object_closureTable
			JOIN ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID
			ON ubm_modelcreationsuite_heirarchy_object_closureTable.descendant_id=ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.UUID
			JOIN ubm_model_positions
			ON ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.position_id=ubm_model_positions.id
			WHERE ubm_modelcreationsuite_heirarchy_object_closureTable.ancestor_id=$activeModelUUID
			AND ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.position_id>0";

//Select all
$rs1 = $conn->query($sqlsel1);
if ($rs1 === false) {
    trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
    
    if (mysqli_num_rows($rs1) > 0) {
        
        //2. Add the result set to the $all_items [] array
        while ($items = $rs1->fetch_assoc()) {
            
            //						$returnFinalReviewer = stripslashes($items['final_reviewer_username']);
            //						$row_items ['final_reviewer_username'] = $returnFinalReviewer;
            $all_items[] = $items;
        }
        
        //echo mysqli_num_rows($rs2);
        
        
    } else {
    }
    $num_rows = mysqli_num_rows($rs1);
    
    //echo "the total number of rows: $num_rows </br>";
    
    
}

//6. JSONP packaged $all_items array
echo $_GET['callback'] . '(' . json_encode($all_items) . ')';

//Output $all_items array in json encoded format.
