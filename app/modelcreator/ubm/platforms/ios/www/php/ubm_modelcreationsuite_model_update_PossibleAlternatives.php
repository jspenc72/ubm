<?php
$aname = $_GET['appname'];
$RQType = $_GET['RQType'];
$usrname = $_GET['username'];

$alternativeId = $_GET['alternativeId'];
$decision = $_GET['decision'];
$annualCostHigh = $_GET['annualCostHigh'];
$annualCostLow = $_GET['annualCostLow'];
$annualBenefitHigh = $_GET['annualBenefitHigh'];
$annualBenefitLow = $_GET['annualBenefitLow'];
$lowExpectedROI = $_GET['lowExpectedROI'];
$highExpectedROI = $_GET['highExpectedROI'];

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
$v2 = "'" . $conn -> real_escape_string($annualCostHigh) . "'";
$v3 = "'" . $conn -> real_escape_string($annualCostLow) . "'";
$v4 = "'" . $conn -> real_escape_string($annualBenefitHigh) . "'";
$v5 = "'" . $conn -> real_escape_string($annualBenefitLow) . "'";
$v6 = "'" . $conn -> real_escape_string($lowExpectedROI) . "'";
$v7 = "'" . $conn -> real_escape_string($highExpectedROI) . "'";
$v8 = "'" . $conn -> real_escape_string($decision) . "'";

$sql = "UPDATE `ubm_model_alternatives` SET annual_cost_high='$annualCostHigh', annual_cost_low='$annualCostLow', annual_benefit_high='$annualBenefitHigh', annual_benefit_low='$annualBenefitLow', high_annual_expected_roi='$highExpectedROI', low_annual_expected_roi='$lowExpectedROI', decision='$decision' WHERE id='alternativeId'";
if ($conn -> query($sql) === false) {
	trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn -> error, E_USER_ERROR);
	echo("failure");
} else {
	$affected_rows = $conn -> affected_rows;
	echo "string";
	echo $_GET['callback'] . '(' . "{'message' : 'The number of affected rows is $affected_rows, the alternative modified was alternativeId'}" . ')';
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