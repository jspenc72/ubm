<?php
require_once('globalGetVariables.php');
require_once('ubms_db_config.php');
require_once('DBConnect_UBMv1.php');		//Provides the variables used for UBMv1 database connection $conn

$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
// check connection
if ($conn -> connect_error) {
	trigger_error('Database connection failed: ' . $conn -> connect_error, E_USER_ERROR);
}
//INSERT

$v2 = "'" . $conn -> real_escape_string($activeModelId) . "'";
$v3 = "'" . $conn -> real_escape_string($activePositionId) . "'";
$v4 = "'" . $conn -> real_escape_string($activeJobDescriptionId) . "'";
$v5 = "'" . $conn -> real_escape_string($activePolicyId) . "'";
$v6 = "'" . $conn -> real_escape_string($activeProcedureId) . "'";
$v7 = "'" . $conn -> real_escape_string($activeStepId) . "'";
$v8 = "'" . $conn -> real_escape_string($activeTaskId) . "'";
/*  $sql="DELETE link
  FROM ubm_modelcreationsuite_heirarchy_object_closureTable p, ubm_modelcreationsuite_heirarchy_object_closureTable link, ubm_modelcreationsuite_heirarchy_object_closureTable c
 WHERE p.ancestor_id = link.ancestor_id and c.descendant_id = link.descendant_id
   AND p.descendant_id=$v2 
   AND c.ancestor_id=$v3";
//NOTE This is the short version of the Hierarchy Object Delete Function, it doesnt give user expected results and I do not fully understand it.		
   //1. Delete all links that connect the jobDescription to a model. */
 $sql="
 DELETE link
 FROM 	ubm_modelcreationsuite_heirarchy_object_closureTable a, 
  		ubm_modelcreationsuite_heirarchy_object_closureTable link, 
  		ubm_modelcreationsuite_heirarchy_object_closureTable d, 
  		ubm_modelcreationsuite_heirarchy_object_closureTable to_delete
 WHERE a.ancestor_id=link.ancestor_id
	AND d.descendant_id=link.descendant_id
	AND a.descendant_id=to_delete.ancestor_id AND d.ancestor_id=to_delete.descendant_id
	AND (to_delete.ancestor_id=$v7 OR to_delete.descendant_id=$v7)
	AND to_delete.path_length<2";
	//NOTE $v4 is the UUID of whatever needs to be deleted from the closureTable.
	//THIS WILL NOT REMOVE GRANDPARENT / GRANDCHILD Relationships that skip the UUID given. 
	//e.g. (if the parent of a grandchild is deleted, the child is still linked to the grandparent with a relationship of length 1.)
	//NOTE: Removing AND to_delete.path_length<2 will result in the self-link staying in the closure table.
 if($conn->query($sql) === false) {
 	trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
 } else {
 	$affected_rows = $conn->affected_rows;
			echo $_GET['callback'] . '(' . "{'message' : 'The number of affected rows is $affected_rows. the Model we attempted to modify was $v2'}" . ')';
 }
/*SELECT
 $sqlsel="SELECT * FROM ubm_mcs_app_resolutions WHERE openitemid=$openitemid";

 $rs=$conn->query($sqlsel);

 if($rs === false) {
 trigger_error('Wrong SQL: ' . $sqlsel . ' Error: ' . $conn->error, E_USER_ERROR);
 } else {
 $rows_returned = $rs->num_rows;
 }
 //UPDATE
 //$v1="'" . $conn->real_escape_string($disposition) . "'";
 $sql="UPDATE `ubm_mcs_app_openitems` SET number_resolutions=$rows_returned WHERE id=$openitemid";
 if($conn->query($sql) === false) {
 trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
 } else {
 $affected_rows = $conn->affected_rows;
 echo $_GET['callback'] . '(' . "{'message' : 'The number of affected rows is $affected_rows, the number of resolutions is: $rows_returned the openitemid modified was $openitemid!'}" . ')';
 }
 
//Send Email Message
$to = "$inviteEmail";
$subject = "$username added you to the following model #\"$activeModelId\"!";
$message = "You have been invited as a $memberRole user to participate in building a business model!";
$from = "notify@universalbusinessmodel.com";
$headers = "From:" . $from;
mail($to, $subject, $message, $headers);
//echo "Mail Sent.";
/*http://www.pontikis.net/blog/how-to-use-php-improved-mysqli-extension-and-why-you-should
 * SELECT
 $sql='SELECT col1, col2, col3 FROM table1 WHERE condition';

 $rs=$conn->query($sql);

 if($rs === false) {
 trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
 } else {
 $rows_returned = $rs->num_rows;
 }
 * Iterate over Recordset
 $rs->data_seek(0);
 while($row = $rs->fetch_assoc()){
 echo $row['col1'] . '<br>';
 }
 * 	Store all values to array
 $rs=$conn->query($sql);

 if($rs === false) {
 trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
 } else {
 $arr = $rs->fetch_all(MYSQLI_ASSOC);
 }
 foreach($arr as $row) {
 echo $row['co1'];
 }
 * 		Record count
 $rows_returned = $rs->num_rows;
 * Move inside recordset
 $rs->data_seek(10);
 *	Free memory

 $rs->free();
 *
 * INSERT
 $v1="'" . $conn->real_escape_string('col1_value') . "'";

 $sql="INSERT INTO tbl (col1_varchar, col2_number) VALUES ($v1,10)";

 if($conn->query($sql) === false) {
 trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
 } else {
 $last_inserted_id = $conn->insert_id;
 $affected_rows = $conn->affected_rows;
 }
 * UPDATE
 $v1="'" . $conn->real_escape_string('col1_value') . "'";

 $sql="UPDATE tbl SET col1_varchar=$v1, col2_number=1 WHERE id>10";

 if($conn->query($sql) === false) {
 trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
 } else {
 $affected_rows = $conn->affected_rows;
 }
 * DELETE
 $sql="DELETE FROM tbl WHERE id>10";

 if($conn->query($sql) === false) {
 trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
 } else {
 $affected_rows = $conn->affected_rows;
 }

 * */
?>