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
$v2 = "'" . $conn->real_escape_string($fromTargetObject) . "'";
$v3 = "'" . $conn->real_escape_string($toTargetObject) . "'";
$v4 = "'" . $conn->real_escape_string($SelectedAction) . "'";

//1. Get column names from database.


//2. Compare the toTargetObject and the fromTargetObject
 $sqlsel="SELECT * FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID WHERE UUID=$v2 OR UUID=$v3";

 $rs=$conn->query($sqlsel);
 if($rs === false) {
 trigger_error('Wrong SQL: ' . $sqlsel . ' Error: ' . $conn->error, E_USER_ERROR);
 } else {
 $rows_returned = $rs->num_rows;
    if($rows_returned){
        while ($items = $rs->fetch_assoc()){











        }
    }else{
        echo "The target selection return 0 results.";
    }
 }
//2. Check that the selected action may be performed and is valid for the two objects.

if($v4=="'move'"){
// echo "From: " . $v2;
// echo "To: " . $v3;
//Removes a subtree from its current place in the tree
//This deletes paths that terminate within the subtree (descendants of D), but not paths that begin within the subtree (paths whose ancestor is D or any of descendants of D).
    $sqldel = "DELETE a 
                FROM ubm_modelcreationsuite_heirarchy_object_closureTable AS a
                JOIN ubm_modelcreationsuite_heirarchy_object_closureTable AS d ON a.descendant_id = d.descendant_id
                LEFT JOIN ubm_modelcreationsuite_heirarchy_object_closureTable AS x
                ON x.ancestor_id = d.ancestor_id AND x.descendant_id = a.ancestor_id
                WHERE d.ancestor_id = $v2 AND x.ancestor_id IS NULL;";
//Inserts appropriate links to all items in the subtree
    $sqlins = "INSERT INTO ubm_modelcreationsuite_heirarchy_object_closureTable (ancestor_id, descendant_id, path_length)
                SELECT supertree.ancestor_id, subtree.descendant_id,
                supertree.path_length+subtree.path_length+1
                FROM ubm_modelcreationsuite_heirarchy_object_closureTable AS supertree JOIN ubm_modelcreationsuite_heirarchy_object_closureTable AS subtree
                WHERE subtree.ancestor_id = $v2
                AND supertree.descendant_id = $v3;";
    if ($conn->query($sqldel) === false) {
        trigger_error('Wrong SQL: ' . $sqlins3 . ' Error: ' . $conn->error, E_USER_ERROR);
    } else {
       // echo "Delete worked!";
        $deleted_rows = $conn->affected_rows;
        if ($conn->query($sqlins) === false) {
            trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn->error, E_USER_ERROR);
        } else {
            $inserted_rows = $conn->affected_rows;
            echo $_GET['callback'] . '(' . "{'message' : 'Requested action deleted: $deleted_rows rows, action inserted rows: $inserted_rows ! From: $v2 and To: $v3 .'}" . ')';
        }
    }
}elseif ($v4=="'attach'"){
// echo "Attach From: " . $v2;
// echo "Attach To: " . $v3;
//3. Get the descendants of the fromTargetObject

//4. Get the ancestors of the toTargetObject

//5. INSERT a copy of all rows with fromTargetObject as the ancestor listing toTargetObject as the new ancestor.

//Inserts appropriate links to all items in the subtree
    $sqlins = "INSERT INTO ubm_modelcreationsuite_heirarchy_object_closureTable (ancestor_id, descendant_id, path_length)
                SELECT supertree.ancestor_id, subtree.descendant_id,
                supertree.path_length+subtree.path_length+1
                FROM ubm_modelcreationsuite_heirarchy_object_closureTable AS supertree JOIN ubm_modelcreationsuite_heirarchy_object_closureTable AS subtree
                WHERE subtree.ancestor_id = $v2
                AND supertree.descendant_id = $v3;";
    if ($conn->query($sqlins) === false) {
        trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn->error, E_USER_ERROR);
    } else {
        $inserted_rows = $conn->affected_rows;
        echo $_GET['callback'] . '(' . "{'message' : 'Requested action inserted rows: $inserted_rows ! From: $v2 and To: $v3 .'}" . ')';
    }
/*** /
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
            $sqlins3 =  "INSERT INTO ubm_modelcreationsuite_heirarchy_object_closureTable(ancestor_id, descendant_id, path_length)
                                     SELECT a.ancestor_id, d.descendant_id, a.path_length+d.path_length+1
                                       FROM ubm_modelcreationsuite_heirarchy_object_closureTable a, ubm_modelcreationsuite_heirarchy_object_closureTable d
                                      WHERE a.descendant_id=$v3 
                                        AND d.ancestor_id=$returnedDescendant";
            //4. select the record with path_length=1 so that you get the immediate parent.
            // $sqlsel2 = "SELECT c.*, u.* FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID u
            //                         JOIN ubm_modelcreationsuite_heirarchy_object_closureTable c
            //                         ON (u.UUID=c.descendant_id)
            //                         WHERE c.descendant_id=$returnedDescendant
            //                         AND c.path_length=1";
            if ($conn->query($sqlins3) === false) {
                trigger_error('Wrong SQL: ' . $sqlins3 . ' Error: ' . $conn->error, E_USER_ERROR);
                echo "there was a problem";
            } else {
                $affected_rows = $affected_rows + $conn->affected_rows;
            }
        }
            echo $_GET['callback'] . '(' . "{'message' : 'Requested action affected: $affected_rows rows! From: $v2 and To: $v3'}" . ')';
        $inserted_rows = $conn->affected_rows;
        echo $_GET['callback'] . '(' . "{'message' : 'Requested action inserted rows: $inserted_rows ! From: $v2 and To: $v3 .'}" . ')';
    }





/***/

}elseif ($v4=="'duplicate'"){
echo "From: " . $v2;
echo "To: " . $v3;

//3. Get the descendants of the fromTargetObject

//4. Get the ancestors of the toTargetObject

//5. Starting with the highest descendant, 
        //A. For each descendant of fromTargetObject get the specification id and insert a new UUID to link to it.
        //B. Attach the new UUID to the toTargetObject
        //C. If this descendant has any descendants, loop through them and add them to the new tree.

//6. INSERT a copy of all rows with fromTargetObject as the ancestor listing toTargetObject as the new ancestor.

//7. Delete the link to all descendants of fromTargetObject


}else {
    echo $v4;
    echo "From: " . $v2;
    echo "To: " . $v3;
}
