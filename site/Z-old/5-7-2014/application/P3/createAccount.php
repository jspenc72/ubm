<?php
$aname = $_GET['appname'];
$RQType = $_GET['RQType'];
//Put your json request variables here

$accountType = $_GET['accountType'];
$accountNumber = $_GET['accountNumber'];
$activeModelUUID = $_GET['activeModelUUID'];
$username = $_GET['username'];

//End JSON Request Variables
$lat = $_GET['lat'];
$lng = $_GET['lng'];
require_once('config.php');
$conn = new mysqli($config['db_host'],$config['db_user'],$config['db_password'],$config['db_name']);
// check connection
if ($conn -> connect_error) {
	trigger_error('Database connection failed: ' . $conn -> connect_error, E_USER_ERROR);
}
//INSERT
$v2 = "'" . $conn -> real_escape_string($accountNumber) . "'";
$v3 = "'" . $conn -> real_escape_string($activeModelUUID) . "'";
$v4 = "'" . $conn -> real_escape_string($username) . "'";
if($accountType=="100"){
$sqlins = "INSERT INTO ubm_model_projected_financial_statement_balance_sheet_debits (account_id, model_UUID, created_by) VALUES ( $v2, $v3, $v4 )"; //Creates a New Core Value record.
}else{
	if($accountType=="200"){
		$sqlins = "INSERT INTO ubm_model_projected_financial_statement_balance_sheet_credits (account_id, model_UUID, created_by) VALUES ( $v2, $v3, $v4 )"; //Creates a New Core Value record.
	}else{
		if($accountType=="400"){
			$sqlins = "INSERT INTO ubm_model_projected_financial_statement_income_statement_credits (account_id, model_UUID, created_by) VALUES ( $v2, $v3, $v4 )"; //Creates a New Core Value record.															
		}else{
			if($accountType=="500"){
				$sqlins = "INSERT INTO ubm_model_projected_financial_statement_income_statement_debits (account_id, model_UUID, created_by) VALUES ( $v2, $v3, $v4 )"; //Creates a New Core Value record.								
			}else{				
			}
		}
	}
}
//$sqlins = "INSERT INTO ubm_model_projected_financial_statement_balance_sheet_credits (account_id, model_UUID, created_by) VALUES ( $v2, $v3, $v4 )"; //Creates a New Core Value record.
if ($conn -> query($sqlins) === false) {
	trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn -> error, E_USER_ERROR);
} else {
	$last_inserted_id = $conn -> insert_id;
}
echo $_GET['callback'] . '(' . "{'message' : 'Account $accountNumber created successfully, $last_inserted_id!'}" . ')';

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