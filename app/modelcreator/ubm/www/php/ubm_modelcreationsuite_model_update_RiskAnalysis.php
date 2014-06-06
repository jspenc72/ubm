<?php
$aname = $_GET['appname'];
$RQType = $_GET['RQType'];
$usrname = $_GET['username'];

$alternativeId = $_GET['alternativeId'];
$riskId = $_GET['riskId'];
$probability = $_GET['probability'];
$impact = $_GET['impact'];
$retainFullRisk = $_GET['retainFullRisk'];
$amount = $_GET['amount'];
$reference = $_GET['reference'];
$preventativeMeasuresExplanation = $_GET['preventativeMeasuresExplanation'];
$risk = $_GET['risk'];

$lat = $_GET['lat'];
$lng = $_GET['lng'];
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

//UPDATE
$v10 = "'" . $conn -> real_escape_string($alternativeId) . "'";
$v2 = "'" . $conn -> real_escape_string($riskId) . "'";
$v3 = "'" . $conn -> real_escape_string($probability) . "'";
$v4 = "'" . $conn -> real_escape_string($impact) . "'";
$v5 = "'" . $conn -> real_escape_string($retainFullRisk) . "'";
$v6 = "'" . $conn -> real_escape_string($amount) . "'";
$v7 = "'" . $conn -> real_escape_string($reference) . "'";
$v8 = "'" . $conn -> real_escape_string($preventativeMeasuresExplanation) . "'";
$v9 = "'" . $conn -> real_escape_string($risk) . "'";

$sql = "UPDATE `ubm_model_alternative_has_risks` SET probability='$probability', impact='$impact', retain_full_risk='$retainFullRisk', amount='$amount', reference='$reference', preventative_measures_explanation='$preventativeMeasuresExplanation', risk='$risk' WHERE risk_id='$riskId' AND alternative_id='$alternativeId'";
if ($conn -> query($sql) === false) {
	trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn -> error, E_USER_ERROR);
	echo("failure");
} else {
	$affected_rows = $conn -> affected_rows;
	echo "string";
	echo $_GET['callback'] . '(' . "{'message' : 'The number of affected rows is $affected_rows, the risk modified was risk $riskId from alternative $alternativeId '}" . ')';
}
//Send Email Message
/*
 $to = "jspenc72@gmail.com";
 $subject = "New feedback has bee submitted for request# $ubmchangerequestid!";
 $message = "$usrname submitted feedback using the UBMChangeRequest app. Current latitude is $lat Current longitude is $lng";
 $from = "notify@universalbusinessmodel.com";
 $headers = "From:" . $from;
 mail($to,$subject,$message,$headers);
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