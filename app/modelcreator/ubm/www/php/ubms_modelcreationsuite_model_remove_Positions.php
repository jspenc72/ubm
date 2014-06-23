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

//INSERT

$v2 = "'" . $conn->real_escape_string($activeModelUUID) . "'";
$v3 = "'" . $conn->real_escape_string($activePositionId) . "'";
$v4 = "'" . $conn->real_escape_string($activeJobDescriptionId) . "'";
$v5 = "'" . $conn->real_escape_string($activePolicyId) . "'";
$v6 = "'" . $conn->real_escape_string($activeProcedureId) . "'";
$v7 = "'" . $conn->real_escape_string($activeStepId) . "'";
$v8 = "'" . $conn->real_escape_string($activeTaskId) . "'";
		
   //1. Delete all links that connect the Position to a model. */

$sql = "
 DELETE link
 FROM 	ubm_modelcreationsuite_heirarchy_object_closureTable a, 
  		ubm_modelcreationsuite_heirarchy_object_closureTable link, 
  		ubm_modelcreationsuite_heirarchy_object_closureTable d, 
  		ubm_modelcreationsuite_heirarchy_object_closureTable to_delete
 WHERE a.ancestor_id=link.ancestor_id
	AND d.descendant_id=link.descendant_id
	AND a.descendant_id=to_delete.ancestor_id AND d.ancestor_id=to_delete.descendant_id
	AND (to_delete.ancestor_id=$v3 OR to_delete.descendant_id=$v3)
	AND to_delete.path_length<2";

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
