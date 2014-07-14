<?php
$ip = $_SERVER['REMOTE_ADDR'];
$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
$DBSServer = 'localhost'; // e.g 'localhost' or '192.168.1.100'
$DBSUser   = 'jessespe';
$DBSPass   = 'Xfn73Xm0';
$DBSName   = 'jessespe_ubm_applications';	
	$sconn = new mysqli($DBSServer, $DBSUser, $DBSPass, $DBSName);
	$v101="'" . $sconn -> real_escape_string($_GET['key']) . "'";
	$v102="'" . $sconn -> real_escape_string($_SERVER['REMOTE_ADDR']) . "'";
	$v103="'" . $sconn -> real_escape_string($_SERVER['HTTP_X_FORWARDED_FOR']) . "'";
	$v104="'" . $sconn -> real_escape_string($details->hostname) . "'";
	$v105="'" . $sconn -> real_escape_string($details->city) . "'";
	$v106="'" . $sconn -> real_escape_string($details->region) . "'";
	$v107="'" . $sconn -> real_escape_string($details->country) . "'";
	$v108="'" . $sconn -> real_escape_string($details->loc) . "'";
	$v109="'" . $sconn -> real_escape_string($details->org) . "'";
	$v110="'" . $sconn -> real_escape_string(basename($_SERVER['SCRIPT_NAME'])) . "'";
	$v111="'" . $sconn -> real_escape_string($_GET['username']) . "'";
	if($sconn->connect_error){
	  trigger_error('Database connection failed: '  . $sconn->connect_error, E_USER_ERROR);
	}
		$ssqlsel="SELECT * FROM applications WHERE application_key=$v101";
		$srs=$sconn->query($ssqlsel);
		if(mysqli_num_rows($srs)>0){
			while ($items = $srs->fetch_assoc()) {
				$returnApplicationKeyId = stripslashes($items['application_key']);
//				echo $returnApplicationKeyId;
				 $sql="INSERT INTO connection_log (app_key, remote_ip, proxy_ip, hostname, city, region, country, loc, org, pagename, username) 
				 		VALUES ( $v101, $v102, $v103, $v104, $v105, $v106, $v107, $v108, $v109, $v110, $v111 )";
				 if($sconn->query($sql) === false) {
				 trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $sconn->error, E_USER_ERROR);
				 } else {
					 $last_inserted_id = $conn->insert_id;
					echo $affected_rows = $conn->affected_rows;
				 }
			}
		}else {
			echo $_GET['callback'] . '(' . "{'message' : 'The Universal Business Model is a collaborative project. However, our financiers insist we reserve access to this resource for UBM developers only. If you are not a robot, visit our website at www.universalbusinessmodel.com to sign up for a developer account and get access to this as well as our many other extensive APIs. If you are having trouble accessing an application email us at support@universalbusinessmodel.com'}" . ')';
			die();
		}	
	
error_reporting(E_ALL);
ini_set('display_errors', '1');