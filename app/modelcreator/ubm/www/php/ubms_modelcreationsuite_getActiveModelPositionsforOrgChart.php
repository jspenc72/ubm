 <?php
require_once ('globalGetVariables.php');
require_once ('ubms_db_config.php');
require_once ('DBConnect_UBMv1.php');
error_reporting(E_ALL);
ini_set('display_errors', '1');
//Provides the variables used for UBMv1 database connection $conn

$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);

// check connection
if ($conn->connect_error) {
    trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
}

//SELECT
$all_items = array();

//1. Get the longest path_length for the activeModelOwnersUUID position

//2. Begin a for loop to gather each of the positions that
$sqlsel1 = "SELECT * 
                FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID
                JOIN ubm_model_position_closure
                ON (ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.UUID=ubm_model_position_closure.descendant_UUID)
                JOIN ubm_model_positions
                ON ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.position_id=ubm_model_positions.id  
                LEFT JOIN ubm_modelCreationSuite_position_has_members
                ON ubm_modelCreationSuite_position_has_members.position_UUID=ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.UUID                   
                WHERE ubm_model_position_closure.ancestor_UUID=$activeModelOwnersUUID
                GROUP BY ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.UUID";

//NEED to add if statment that retrieves the record where the current
//descendant has a relationship with path length of 1 if the returned
//path_length is greater than 1.
//Select all
$rs1 = $conn->query($sqlsel1);
if ($rs1 === false) {
    trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
    if (mysqli_num_rows($rs1) > 0) {
        
        //2. Add the result set to the $all_items [] array
        while ($items = $rs1->fetch_assoc()) {
            $path_length = stripslashes($items['path_length']);
            $descendant_UUID = stripslashes($items['descendant_UUID']);
            if ($path_length < 2 && $path_length > 0) {
                $all_items[] = $items;
            } else {
                $sqlsel2 = "SELECT * FROM ubm_model_position_closure
                                JOIN ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID
                                ON (ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.UUID=ubm_model_position_closure.descendant_UUID)
                                JOIN ubm_model_positions
                                ON ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.position_id=ubm_model_positions.id
                                LEFT JOIN ubm_modelCreationSuite_position_has_members
                                ON ubm_modelCreationSuite_position_has_members.position_UUID=ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.UUID
                                WHERE ubm_model_position_closure.descendant_UUID=$descendant_UUID
                                AND ubm_model_position_closure.path_length=1
                                GROUP BY ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.UUID";
                
                //Select all
                $rs2 = $conn->query($sqlsel2);
                if ($rs2 === false) {
                    trigger_error('Wrong SQL: ' . $sqlsel2 . ' Error: ' . $conn->error, E_USER_ERROR);
                } else {
                    if (mysqli_num_rows($rs2) > 0) {
                        
                        //2. Add the result set to the $all_items [] array
                        while ($items2 = $rs2->fetch_assoc()) {
                           $all_items[] = $items2;
                        }
                    } else {
                    }
                    $num_rows2 = mysqli_num_rows($rs2);
                }
            }
        }
    } else {
    }
    $num_rows = mysqli_num_rows($rs1);
}

//6. JSONP packaged $all_items array
echo $_GET['callback'] . '(' . json_encode($all_items) . ')';

//Output $all_items array in json encoded format.
