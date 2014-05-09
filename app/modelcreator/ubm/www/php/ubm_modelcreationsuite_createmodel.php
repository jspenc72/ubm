<?php
require_once('globalGetVariables.php');
require_once('ubms_db_config.php');

//$property_name = $_GET['property_name'];
//   if($aname=='FindMyDriver')
//  {
//$con=mysqli_connect("localhost","jessespe","Xfn73Xm0","jessespe_UBMv1"); 	//Define db Connection
$DBServer = 'localhost';
// e.g 'localhost' or '192.168.1.100'
$DBUser = 'jessespe';
$DBPass = 'Xfn73Xm0';
$DBName = 'jessespe_UBMv1';
$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
// check connection
if ($conn -> connect_error) {
	trigger_error('Database connection failed: ' . $conn -> connect_error, E_USER_ERROR);
}
//INSERT
$v2 = "'" . $conn -> real_escape_string($reference) . "'";
$v3 = "'" . $conn -> real_escape_string($title) . "'";
$v4 = "'" . $conn -> real_escape_string($descritpion) . "'";
$v5 = "'" . $conn -> real_escape_string($creator_id) . "'";
$v6 = "'" . $conn -> real_escape_string($username) . "'";
//1. Create the model in the ubm_model table.

$sqlins = "INSERT INTO ubm_model (reference, title, description, creator_id) VALUES ($v2, $v3, $v4, $v5)";
if ($conn -> query($sqlins) === false) {
	trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn -> error, E_USER_ERROR);
} else {
	$last_inserted_model_id = $conn -> insert_id;
echo "$last_inserted_model_id";
//2. Generate a UUID for the Model.
	$sqlins2 = "INSERT INTO ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID (created_by, model_id) VALUES ( $v6, $last_inserted_model_id )";
	if ($conn -> query($sqlins2) === false) {
		trigger_error('Wrong SQL: ' . $sqlins2 . ' Error: ' . $conn -> error, E_USER_ERROR);
	} else {
		$last_inserted_model_UUID = $conn -> insert_id;
echo "$last_inserted_model_UUID";
//3. Insert the self-link into the heirarchy object closure table so things can be attached to it.
		$sqlins3 = "INSERT INTO ubm_modelcreationsuite_heirarchy_object_closureTable (ancestor_id, descendant_id, path_length, created_by) VALUES ( $last_inserted_model_UUID, $last_inserted_model_UUID, '0', $v6 )";
		if ($conn -> query($sqlins3) === false) {
			trigger_error('Wrong SQL: ' . $sqlins3 . ' Error: ' . $conn -> error, E_USER_ERROR);
		} else {
echo "closure inserted";
//4. Add the owners position to the model.
			$sqlins4 = "INSERT INTO ubm_model_has_positions (model_id, model_position_reports_to_id, position_id) VALUES ($last_inserted_model_id, '1', '1')";
			if ($conn -> query($sqlins4) === false) {
				trigger_error('Wrong SQL: ' . $sqlins4 . ' Error: ' . $conn -> error, E_USER_ERROR);
			} else {
echo "position inserted";

				echo $_GET['callback'] . '(' . "{'message' : 'The number of affected rows is $affected_rows, the id of the new model is: $last_inserted_model_id , the UUID of the model is: $last_inserted_model_UUID.'}" . ')';
			}
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
 */
//Send Email Message
$to = "jspenc72@gmail.com";
$subject = "New feedback has bee submitted for request# $ubmchangerequestid!";
$message = "$usrname submitted feedback using the UBMChangeRequest app. Current latitude is $lat Current longitude is $lng";
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