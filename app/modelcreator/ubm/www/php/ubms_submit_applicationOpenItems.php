<?php
require_once('globalGetVariables.php');
require_once('ubms_db_config.php');
require_once('DBConnect_UBMv1.php');		//Provides the variables used for UBMv1 database connection $conn
$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
// check connection
if ($conn -> connect_error) {
	trigger_error('Database connection failed: ' . $conn -> connect_error, E_USER_ERROR);
}
// //INSERT
 $v2 = "'" . $conn -> real_escape_string($OpenItem_formref) . "'";
 $v3 = "'" . $conn -> real_escape_string($OpenItem_priority) . "'";
 $v4 = "'" . $conn -> real_escape_string($OpenItem_actionrequired) . "'";
 $v5 = "'" . $conn -> real_escape_string($OpenItem_assignedto) . "'";
 $v6 = "'" . $conn -> real_escape_string($username) . "'";
 $v7 = "'" . $conn -> real_escape_string($OpenItem_duedate) . "'";
 
 // $v5 = "'" . $conn -> real_escape_string($activeModelId) . "'";
$sqlins = "INSERT INTO ubm_mcs_app_openitems (form_ref, priority, opened_by, action_required, assigned_to, due_date)
				VALUES ('$OpenItem_formref', '$OpenItem_priority', '$username', $v4, '$OpenItem_assignedto', '$OpenItem_duedate')"; //Creates a New Feature record.
 if ($conn -> query($sqlins) === false) {
 	trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn -> error, E_USER_ERROR);
 } else {
	$last_inserted_id = $conn -> insert_id;
	$affected_rows = $conn -> affected_rows;
	echo $_GET['callback'] . '(' . "{'message' : 'Your Review Point or Open Item was created successfully and assigned to: $OpenItem_assignedto.'}" . ')';
 }

//Send Admin Notification Email Message
$to = "jspenc72@gmail.com";
$subject = "Admin Checklist Notify";
$message = "A new Checklist was created. The username responsible was, $username";
$from = "admin@universalbusinessmodel.com";
$headers = "From:" . $from;
//Send SMS Message
if ($OpenItem_assignedto == "Jesse Spencer") {
mail("8016086458@vtext.com", "", "$username: $OpenItem_actionrequired", "From: App <openitem@universalbusinessmodel.com>\r\n");
}
if ($OpenItem_assignedto == "Adam Gustafson") {
mail("4352302281@vtext.com", "", "$username: $OpenItem_actionrequired", "From: App <openitem@universalbusinessmodel.com>\r\n");
}
//echo "SMS was sent!";
