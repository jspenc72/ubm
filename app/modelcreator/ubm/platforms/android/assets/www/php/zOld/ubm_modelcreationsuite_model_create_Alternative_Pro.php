<?php
$aname = $_GET['appname'];
$RQType = $_GET['RQType'];
$username = $_GET['username'];
//Put your json request variables here

$activeModelId = $_GET['activeModelId'];
$activeModelAlternativeId = $_GET['activeModelAlternativeId'];
$alternativeProDescription = $_GET['alternativeProDescription'];
$alternativeProROIRef = $_GET['alternativeProROIRef'];
$alternativeProHighBenefit = $_GET['alternativeProHighBenefit'];
$alternativeProLowBenefit = $_GET['alternativeProLowBenefit'];

//End JSON Request Variables
$lat = $_GET['lat'];
$lng = $_GET['lng'];
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
$v2 = "'" . $conn -> real_escape_string($activeModelId) . "'";
$v3 = "'" . $conn -> real_escape_string($activeModelAlternativeId) . "'";
$v4 = "'" . $conn -> real_escape_string($alternativeProDescription) . "'";
$v5 = "'" . $conn -> real_escape_string($alternativeProROIRef) . "'";
$v6 = "'" . $conn -> real_escape_string($alternativeProHighBenefit) . "'";
$v7 = "'" . $conn -> real_escape_string($alternativeProLowBenefit) . "'";
$v8 = "'" . $conn -> real_escape_string($username) . "'";

$sqlins = "INSERT INTO ubm_model_alternative_pros (model_id, alternative_id, description, roi_ref, benefit_high, benefit_low, created_by) VALUES ( $v2, $v3, $v4, $v5, $v6, $v7, $v8 )"; //Creates a New Core Value record.
if ($conn -> query($sqlins) === false) {
	trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn -> error, E_USER_ERROR);
} else {
	$last_inserted_id = $conn -> insert_id;
	//$affected_rows = $conn -> affected_rows;
	$sqlins2 = "INSERT INTO ubm_model_alternative_has_pros (alternative_id, pro_id) VALUES ( $v3, $last_inserted_id )";
	if ($conn -> query($sqlins2) === false) {
		trigger_error('Wrong SQL: ' . $sqlins2 . ' Error: ' . $conn -> error, E_USER_ERROR);
	} else {
		$sqlsel = "SELECT SUM(benefit_high) AS benefit_high_sum FROM ubm_model_alternative_pros WHERE alternative_id=$v3";
		$rs=$conn->query($sqlsel);
		if($rs === false) {
		  trigger_error('Wrong SQL: ' . $sqlsel . ' Error: ' . $conn->error, E_USER_ERROR);
		} else {
			while ($items = $rs->fetch_assoc()) {
				$sumHigh = $items['benefit_high_sum'];
				$sqlsel2 = "SELECT SUM(benefit_low) AS benefit_low_sum FROM ubm_model_alternative_pros WHERE alternative_id=$v3";
				$rs2=$conn->query($sqlsel2);
				if($rs2 === false) {
				  trigger_error('Wrong SQL: ' . $sqlsel2 . ' Error: ' . $conn->error, E_USER_ERROR);
				} else {
					while ($items2 = $rs2->fetch_assoc()) {
						$sumLow = $items2['benefit_low_sum'];
						 $sqlupd="UPDATE ubm_model_alternatives SET annual_benefit_high=$sumHigh, annual_benefit_low=$sumLow WHERE id=$v3";
						 if($conn->query($sqlupd) === false) {
						 trigger_error('Wrong SQL: ' . $sqlupd . ' Error: ' . $conn->error, E_USER_ERROR);
						 } else {
							 $affected_rows = $conn->affected_rows;
							echo $_GET['callback'] . '(' . "{'message' : 'Requested Alternative Con $alternativeProDescription was created successfully, the new sum of low cost estimate is $sumLow and sum of high cost estimate is $sumHigh added to model id: $activeModelId affected rows: $affected_rows!'}" . ')';						 
						 }				
					}
				}		
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