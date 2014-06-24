<?php
$aname = $_GET['appname'];
$RQType = $_GET['RQType'];
$username = $_GET['username'];
//Put your json request variables here

$activeModelId = $_GET['activeModelId'];
$objective = $_GET['objective'];
$title = $_GET['title'];
$dutiesAndResponsibilities = $_GET['dutiesAndResponsibilities'];
$positionId = $_GET['positionId'];
$qualifications = $_GET['qualifications'];
$ageRequirement = $_GET['ageRequirement'];
$educationRequirement = $_GET['educationRequirement'];
$physicalDemand = $_GET['physicalDemand'];
$workEnvironment = $_GET['workEnviroment'];

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
$v3 = "'" . $conn -> real_escape_string($objective) . "'";
$v4 = "'" . $conn -> real_escape_string($title) . "'";
$v5 = "'" . $conn -> real_escape_string($username) . "'";
$v6 = "'" . $conn -> real_escape_string($dutiesAndResponsibilities) . "'";
$v7 = "'" . $conn -> real_escape_string($positionId) . "'";
$v8 = "'" . $conn -> real_escape_string($qualifications) . "'";
$v9 = "'" . $conn -> real_escape_string($ageRequirement) . "'";
$v10 = "'" . $conn -> real_escape_string($educationRequirement) . "'";
$v11 = "'" . $conn -> real_escape_string($physicalDemand) . "'";
$v12 = "'" . $conn -> real_escape_string($workEnvironment) . "'";

$sqlins = "INSERT INTO ubm_model_jobDescriptions (objective, title, created_by, essential_duties_and_responsibilities, qualifications, age_requirement, education_requirements, physical_demand, work_environment ) VALUES ( $v3, $v4, $v5, $v6, $v8, $v9, $v10, $v11, $v12)"; //Creates a New Core Value record.
if ($conn -> query($sqlins) === false) {
	trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn -> error, E_USER_ERROR);
} else {
	$last_inserted_id = $conn -> insert_id;
	//$affected_rows = $conn -> affected_rows;
	$sqlins2 = "INSERT INTO ubm_model_has_jobDescriptions (model_id, jobdescription_id) VALUES ( $v2, $last_inserted_id )";
	if ($conn -> query($sqlins2) === false) {
		trigger_error('Wrong SQL: ' . $sqlins2 . ' Error: ' . $conn -> error, E_USER_ERROR);
	} else {
			$sqlins3 = "INSERT INTO ubm_model_position_has_jobDescriptions (position_id, jobdescription_id) VALUES ( $v7, $last_inserted_id )";		//Create relationship between the task and its parent in the hierarchy, which is the Step.
			if ($conn -> query($sqlins3) === false) {
				trigger_error('Wrong SQL: ' . $sqlins3 . ' Error: ' . $conn -> error, E_USER_ERROR);
			} else {
				echo $_GET['callback'] . '(' . "{'message' : 'Requested Job Description $title was created successfully and added to model id: $activeModelId !'}" . ')';
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