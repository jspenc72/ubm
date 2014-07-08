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

//1. Delete all links that connect the descendant to the ancestor.
//First Attempt at deletion # removes everything
$sql = "
 DELETE link
 FROM ubm_modelcreationsuite_heirarchy_object_closureTable a, 
  		ubm_modelcreationsuite_heirarchy_object_closureTable link, 
  		ubm_modelcreationsuite_heirarchy_object_closureTable d, 
  		ubm_modelcreationsuite_heirarchy_object_closureTable to_delete
 WHERE a.ancestor_id=link.ancestor_id
	AND d.descendant_id=link.descendant_id
	AND a.descendant_id=to_delete.ancestor_id AND d.ancestor_id=to_delete.descendant_id
	AND (to_delete.ancestor_id=$v9 OR to_delete.descendant_id=$v10)
	AND to_delete.path_length=1";

//Second Attempt at deletion #1093 - You can't specify target table 'ubm_modelcreationsuite_heirarchy_object_closureTable' for update in FROM clause 
$sql = "
DELETE FROM ubm_modelcreationsuite_heirarchy_object_closureTable
WHERE descendant_id IN
(SELECT descendant_id 
  FROM ubm_modelcreationsuite_heirarchy_object_closureTable
  WHERE ancestor_id=$v9)
";

/*
IMPORTANT NOTES ON THIS TYPE OF DELETION: 
This will delete an object but not its descendants. 
Which means that an object that is the grandchild of the activeAncestorUUID 
will retain its link to the grandparent, (activeAncestorUUID) 
even if its relationship to the immediate parent is deleted.
*/
$sql = "
DELETE FROM ubm_modelcreationsuite_heirarchy_object_closureTable 
WHERE descendant_id=$v10
AND ancestor_id=$v9
AND path_length!=0";
//This removes an entire subtree under the ancestor.
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
 AND (to_delete.ancestor_id=$v9 
     OR to_delete.descendant_id=$v10)
     ";

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
 AND (to_delete.ancestor_id=$v9 
     AND to_delete.descendant_id=$v10)
     ";
//NOTE $v4 is the UUID of whatever needs to be deleted from the closureTable.
//THIS WILL NOT REMOVE GRANDPARENT / GRANDCHILD Relationships that skip the UUID given.
//e.g. (if the parent of a grandchild is deleted, the child is still linked to the grandparent with a relationship of length 1.)
//NOTE: Removing AND to_delete.path_length<2 will result in the self-link staying in the closure table.
if ($conn->query($sql) === false) {
    trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
    $affected_rows = $conn->affected_rows;
    echo $_GET['callback'] . '(' . "{'message' : 'The number of affected rows is $affected_rows. the Model we attempted to modify was $v2'}" . ')';
}
