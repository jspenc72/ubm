<?php
require_once('globalGetVariables.php');
require_once('ubms_db_config.php');
require_once('DBConnect_UBMv1.php');		
function rand_string( $length ) {
	$chars = "abcdefghjkmnopqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ123456789";
	return substr(str_shuffle($chars),0,$length);
}
$tempPass = rand_string(8);
$securePassword = md5($tempPass);
$conn = new mysqli("localhost","jessespe","Xfn73Xm0","jessespe_FindMyDriver");
// check connection
if ($conn->connect_error) {
	trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
}

$sql="UPDATE `members` SET password='$securePassword', password_status='0' WHERE email='$email'";
if($conn->query($sql) === false) {
	trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
	$affected_rows = $conn->affected_rows;
	if ($affected_rows > 0) {
		echo $_GET['callback'] . '(' . "{'message' : 'The password has been successfully changed for $email!'}" . ')';

		$to      = $email; // Send email to our user
		$subject = 'Password has been reset'; // Give the email a subject 
		$message = '
		 
		Your password has been reset.
		 
		------------------------
		Password: '.$tempPass.' 
		------------------------
		 
		'; 
		                     
		$headers = 'From:notify@universalbusinessmodel.com' . "\r\n"; // Set from headers
		mail($to, $subject, $message, $headers); // Send our email

	} else {
		echo $_GET['callback'] . '(' . "{'message' : '$email was not found! affected rows: $affected_rows'}" . ')';
	}
}