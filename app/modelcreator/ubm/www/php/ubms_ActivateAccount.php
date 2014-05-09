<?php
require_once ('ubms_db_config.php');
$usremail = $_GET['email'];
$hash = md5( rand(0,1000) );
$conn = new mysqli("localhost","jessespe","Xfn73Xm0","jessespe_FindMyDriver");
// check connection
if ($conn->connect_error) {
  trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
}

$v9 = "'" . $conn -> real_escape_string($hash) . "'";
$v8 = "'" . $conn -> real_escape_string($usremail) . "'";

$sqlins = "UPDATE members SET activation_code=$v9 WHERE email=$v8";
if (!$conn -> query($sqlins)) {
	$theError = $conn -> error;
	echo $_GET['callback'] . '(' . "{'message' : 'Unable to Process your request: $theError'}" . ')';
} else {
	$last_inserted_id = $conn -> insert_id;
	//$affected_rows = $conn -> affected_rows;
				echo $_GET['callback'] . '(' . "{'message' : 'Email Sent Successfully!'}" . ')';
}

$to      = $usremail; // Send email to our user
$subject = 'Please Verify Your Account'; // Give the email a subject 
$message = '
 
 
Please click this link to activate your account:
http://api.universalbusinessmodel.com/verify.php?callback=?&email='.$usremail.'&activationCode='.$hash.'
 
'; 
                     
$headers = 'From:notify@universalbusinessmodel.com' . "\r\n"; // Set from headers
mail($to, $subject, $message, $headers); // Send our email

