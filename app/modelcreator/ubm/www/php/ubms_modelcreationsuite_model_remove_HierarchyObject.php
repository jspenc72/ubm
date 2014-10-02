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
//INSERT
$v2 = "'" . $conn->real_escape_string($activeModelUUID) . "'";
$v9 = "'" . $conn->real_escape_string($activeAncestorUUID) . "'";
$v10 = "'" . $conn->real_escape_string($activeDescendantUUID) . "'";
//1. Get the position that is directly above the Object we are removing so we can remove it from the Hierarchy Object closure table.
$sqlsel1 = "
            SELECT * 
            FROM ubm_modelcreationsuite_heirarchy_object_closureTable
            WHERE descendant_id=$v10
            AND path_length=1";
    $rs1 = $conn->query($sqlsel1);
    //2. Set rs1 equal to the list of objects that is returned in the result set.
    if ($rs1 === false) {
        trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
    } else {
      $rows_returned = $rs1->num_rows;
      if($rows_returned>0){
        while ($items1 = $rs1->fetch_assoc()) {
            $ancestorUUID = stripslashes($items1['ancestor_id']);
        } 
          //1. Delete all links that connect the descendant to the ancestor.
          // Third Attempt at deletion - This will remove everything but the self links.
          $sql = "
          DELETE link 
          FROM  ubm_modelcreationsuite_heirarchy_object_closureTable a, 
                ubm_modelcreationsuite_heirarchy_object_closureTable link, 
                ubm_modelcreationsuite_heirarchy_object_closureTable d, 
                ubm_modelcreationsuite_heirarchy_object_closureTable to_delete 
          WHERE a.ancestor_id=link.ancestor_id 
           AND d.descendant_id=link.descendant_id 
           AND to_delete.path_length>0
           AND a.descendant_id=to_delete.ancestor_id 
           AND d.ancestor_id=to_delete.descendant_id 
           AND (to_delete.ancestor_id=$ancestorUUID 
               AND to_delete.descendant_id=$v10)
               ";
          //NOTE $v10 is the UUID of whatever needs to be deleted from the closureTable.
          //THIS WILL NOT REMOVE GRANDPARENT / GRANDCHILD Relationships that skip the UUID given.
          //e.g. (if the parent of a grandchild is deleted, the child is still linked to the grandparent with a relationship of length 1.)
          //NOTE: Removing AND to_delete.path_length<2 will result in the self-link staying in the closure table.

          if ($conn->query($sql) === false) {
              trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
          } else {
              $affected_rows = $conn->affected_rows;
              echo $_GET['callback'] . '(' . "{'message' : 'The number of affected rows is $affected_rows. the Model we attempted to modify was $v2'}" . ')';
          }
      }else{
        echo $_GET['callback'] . '(' . "{'message' : 'The objects relationship to its parent no longer exists. Or has already been removed.'}" . ')';
      }
    }