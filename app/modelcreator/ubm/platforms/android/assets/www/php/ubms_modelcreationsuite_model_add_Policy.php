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
$v4 = "'" . $conn -> real_escape_string($activeJobDescriptionUUID) . "'";
$v5 = "'" . $conn -> real_escape_string($activePolicyId) . "'";
$v6 = "'" . $conn -> real_escape_string($activeProcedureId) . "'";
$v7 = "'" . $conn -> real_escape_string($activeStepId) . "'";
$v8 = "'" . $conn -> real_escape_string($activeTaskId) . "'";
$v9 = "'" . $conn -> real_escape_string($username) . "'";

//SELECT
//1. Find the current active model UUID based on the id of the specification. THIS will return a list of all instances of a specification.
// $activeJobDescriptionUUID = 1;
	// $sqlsel1="SELECT * FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID WHERE jobDescription_id=$v4";		//Select all 
	// $rs1=$conn->query($sqlsel1);
	// if($rs1 === false) {
	  // trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
	// } else{
		// while ($items1 = $rs1->fetch_assoc()) {
			// $activeJobDescriptionUUID = stripslashes($items1['UUID']);
		// }
	// }
// INSERT
//2. Insert the activePolicyId into the UUID table, creating a new instance of the Policy specification.
$sqlins = "INSERT INTO ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID (legal_entity_id, model_id, position_id, jobDescription_id, policy_id, procedure_id, step_id, task_id, created_by) VALUES ('0','0','0','0',$v5,'0','0','0',$v9)";
if ($conn -> query($sqlins) === false) {
	trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn -> error, E_USER_ERROR);
} else {
//3. Insert a row in the hierarchy object closureTable so the policy is tied to itself in the hierarchy object table.
	$last_inserted_policy_uuid = $conn -> insert_id;	
	$sqlins2 = "INSERT INTO ubm_modelcreationsuite_heirarchy_object_closureTable ( ancestor_id, descendant_id, path_length, created_by ) 
						VALUES ( $last_inserted_policy_uuid, $last_inserted_policy_uuid, '0', $v9 )";
	if ($conn -> query($sqlins2) === false) {
		trigger_error('Wrong SQL: ' . $sqlins2 . ' Error: ' . $conn -> error, E_USER_ERROR);
	} else {
//5. Now INSERT the links to all the ancestors of the PL_UUID into the Closure table so has a tie to all ojects above it.
			$sqlins3 =  "INSERT INTO ubm_modelcreationsuite_heirarchy_object_closureTable(ancestor_id, descendant_id, path_length)
						 SELECT a.ancestor_id, d.descendant_id, a.path_length+d.path_length+1
						   FROM ubm_modelcreationsuite_heirarchy_object_closureTable a, ubm_modelcreationsuite_heirarchy_object_closureTable d
						  WHERE a.descendant_id=$v4 
						  	AND d.ancestor_id=$last_inserted_policy_uuid";
			if ($conn -> query($sqlins3) === false) {
				trigger_error('Wrong SQL: ' . $sqlins3 . ' Error: ' . $conn -> error, E_USER_ERROR);
				echo "there was a problem";
			} else {
				$affected_rows = $conn->affected_rows;
				$last_inserted = $conn -> insert_id;
				echo $_GET['callback'] . '(' . "{'message' : 'Requested Policy $v5 was created successfully and added to jobDescriptionId $v4, the number of affected rows is: $affected_rows the relationship in the closure table is $last_inserted!'}" . ')';
			}		
	}
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