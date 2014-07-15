<?php
require_once ('globalGetVariables.php');

require_once('ubms_db_config.php');
require_once ('DBConnect_UBMv1.php');

//Provides the variables used for UBMv1 database connection $conn
$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);

// check connection
if ($conn->connect_error) {
    trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
}
$v2 = "'" . $conn->real_escape_string($activeObjectUUID) . "'";

//SELECT
$all_items = array();

//1. Select all records with ancestor equal to the activeObjectUUID
$sqlsel1 = "SELECT c.descendant_id, c.ancestor_id, c.path_length FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID u
                        JOIN ubm_modelcreationsuite_heirarchy_object_closureTable c
                        ON (u.UUID=c.descendant_id)
                        WHERE c.ancestor_id=$v2
                        ORDER BY u.UUID";
$rs1 = $conn->query($sqlsel1);

//2. Set rs1 equal to the list of objects that is returned in the result set.
if ($rs1 === false) {
    trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
    while ($items1 = $rs1->fetch_assoc()) {
        //3. Loop through the result set and get the descendant_id and the ancestor_id
        $returnedDescendant = stripslashes($items1['descendant_id']);
        $returnedAncestor = stripslashes($items1['ancestor_id']);
        //4. select the record with path_length=1 so that you get the immediate parent.
        $sqlsel2 = "SELECT c.*, u.* FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID u
                        JOIN ubm_modelcreationsuite_heirarchy_object_closureTable c
                        ON (u.UUID=c.descendant_id)
                        WHERE c.descendant_id=$returnedDescendant
                        AND c.path_length=1";
        $rs2 = $conn->query($sqlsel2);
        if ($rs2 === false) {
            trigger_error('Wrong SQL: ' . $sqlsel2 . ' Error: ' . $conn->error, E_USER_ERROR);
        } else {
//Check to see if the item of interest has more than one ancestor.
            $numberOfRows = $rs2->num_rows;
            while ($items2 = $rs2->fetch_assoc()) {
                    $returnAncestor = stripslashes($items2['ancestor_id']);
                    $returnDescendant = stripslashes($items2['descendant_id']);
                if($numberOfRows>1){
//If the item has more than one ancestor check to see that both of its ancestors are indirect descendents of the parent of this subtree.                    
                        $all_items[] = $items2;
                }else{
                        $all_items[] = $items2;
                }
            }
        }
    }
}

//6. JSONP packaged $all_items array
echo $_GET['callback'] . '(' . json_encode($all_items) . ')';

//Output $all_items array in json encoded format.
