<?php
require_once ('globalGetVariables.php');
require_once ('ubms_db_config.php');
require_once ('DBConnect_UBMv1.php');

//Provides the variables used for UBMv1 database connection $conn
error_reporting(E_ALL);
ini_set('display_errors', '1');
$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);

// check connection
if ($conn->connect_error) {
    trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
}

//INSERT
$v2 = "'" . $conn->real_escape_string($activeModelUUID) . "'";
$v3 = "'" . $conn->real_escape_string($activePositionUUID) . "'";
$v9 = "'" . $conn->real_escape_string($activeAncestorUUID) . "'";
$v10 = "'" . $conn->real_escape_string($activeDescendantUUID) . "'";
//1. Get the position that is directly above the position we are removing so we can remove it from the position closure table.
$sqlsel1 = "
            SELECT * 
            FROM ubm_model_position_closure
            WHERE descendant_UUID=$v10
            AND path_length=1";
    $rs1 = $conn->query($sqlsel1);

    //2. Set rs1 equal to the list of objects that is returned in the result set.
    if ($rs1 === false) {
        trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
    } else {
        while ($items1 = $rs1->fetch_assoc()) {
            $ancestorPositionUUID = stripslashes($items1['ancestor_UUID']);
        }
    }
//2. Remove Position from the position closure table.

$sql = "
DELETE link
 FROM ubm_model_position_closure a, 
      ubm_model_position_closure link, 
      ubm_model_position_closure d, 
      ubm_model_position_closure to_delete
 WHERE a.ancestor_UUID=link.ancestor_UUID
  AND d.descendant_UUID=link.descendant_UUID
  AND a.descendant_UUID=to_delete.ancestor_UUID AND d.ancestor_UUID=to_delete.descendant_UUID
  AND (to_delete.ancestor_UUID=$ancestorPositionUUID 
         AND to_delete.descendant_UUID=$v10)
  AND to_delete.path_length<2";

//2. Remove Position from the model in the hiearachical closure table.

$sql2 = "
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
 AND (to_delete.ancestor_id=$v9 
     AND to_delete.descendant_id=$v10)
     ";
if ($conn->query($sql) === false) {
    trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
      $affected_rows = $conn->affected_rows;   
      if ($conn->query($sql2) === false) {
          trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
      } else {
          $affected_rows = $conn->affected_rows + $affected_rows;   
          echo $_GET['callback'] . '(' . "{'message' : 'The number of affected rows is $affected_rows. the Model we attempted to modify was $v9 , We removed position:  $v10 from position: $ancestorPositionUUID'}" . ')';
      }
}
