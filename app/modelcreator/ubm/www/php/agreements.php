<?php
require_once('globalGetVariables.php');
require_once('ubms_db_config.php');
require_once('DBConnect_UBMv1.php');		

$conn = new mysqli("localhost","jessespe","Xfn73Xm0","jessespe_FindMyDriver");
$conn2 = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
// check connection
if ($conn->connect_error) {
	trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
}

$memberId = mysqli_query($conn,"SELECT id FROM 'members' WHERE username='$username'");
if ($licenseAgreementSetup) {
	$sqlins = "INSERT INTO agreements (member_id, model_UUID, license_agreement_setup) VALUES ($memberId, $activeModelUUID, $licenseAgreementSetup)";
	if ($conn2 -> query($sqlins) === false) {
		trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn2 -> error, E_USER_ERROR);
	} else {
		echo $_GET['callback'] . '(' . "{'message' : 'You have agreed to license agreement setup $licenseAgreementSetup'}" . ')';
	}
} elseif ($termsOfService) {
	$sqlins = "INSERT INTO agreements (member_id, model_UUID, terms_of_service) VALUES ($memberId, $activeModelUUID, $termsOfService)";
	if ($conn2 -> query($sqlins) === false) {
		trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn2 -> error, E_USER_ERROR);
	} else {
		echo $_GET['callback'] . '(' . "{'message' : 'You have agreed to terms of service $termsOfService'}" . ')';
	}		
} elseif ($licenseAgreementSignIn) {
	$sqlins = "INSERT INTO agreements (member_id, model_UUID, license_agreement_sign_in) VALUES ($memberId, $activeModelUUID, $licenseAgreementSignIn)";
	if ($conn2 -> query($sqlins) === false) {
		trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn2 -> error, E_USER_ERROR);
	} else {
		echo $_GET['callback'] . '(' . "{'message' : 'You have agreed to license agreement sign in $licenseAgreementSignIn'}" . ')';
	}
}
echo "string";



