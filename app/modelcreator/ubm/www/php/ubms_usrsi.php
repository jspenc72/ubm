 <?php
 $aname = $_GET['appname'];
 $RQType = $_GET['RQType'];
 $username = $_GET['username'];
 $usrpasswd = $_GET['password'];
  require_once('ubms_db_config.php');
			$sqllink = mysqli_connect("localhost","jessespe","Xfn73Xm0","jessespe_FindMyDriver"); 	//Define db Connection
			/* check connection */
			if (mysqli_connect_errno()) {
			    printf("Connect failed: %s\n", mysqli_connect_error());
			    exit();
			}
			$query = "SELECT * FROM `members` WHERE `username`='$username'";
//			$query = "SELECT * FROM `members`";
			//$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
			$result = mysqli_query($sqllink, $query);
			// GOING THROUGH THE DATA
				if($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						$returnuserpassword = stripslashes($row['password']);
						$returnPasswordStatus = stripslashes($row['password_status']);
						$returnActivationStatus = stripslashes($row['email_activation_status']);
						$accounttype = stripslashes($row['account_type']);
						$walkthrough = stripslashes($row['first_time_login']);
						$termsOfService = stripslashes($row['agree_to_terms_of_service']);
						$licenseAgreement = stripslashes($row['agree_to_license_agreement']);
						if($returnuserpassword==md5($usrpasswd)){
				         	echo $_GET['callback'] . '(' . "{'message' : 'Login successful for user $username $returnPasswordStatus','validation' : 'TRUE','accounttype' : '$accounttype', 'passwordStatus' : '$returnPasswordStatus', 'activationStatus' : '$returnActivationStatus', 'walkthrough' : '$walkthrough', 'licenseAgreement' : '$licenseAgreement', 'termsOfService' : '$termsOfService'}" . ')';
//				         	echo $_GET['callback'] . '(' . "{'message' : 'Password Validated'}" . ')';
						}else{
				         	echo $_GET['callback'] . '(' . "{'message' : 'Login unsuccessful','validation' : 'FALSE'}" . ')';							
						}
//						echo stripslashes($row['username']);
//						echo "</br>";	
					}
				}
				else {
				       echo $_GET['callback'] . '(' . "{'message' : 'Login unsuccessful, The Username you entered does not exist:','validation' : 'FALSE'}" . ')';							
				}
			/* close connection */
			mysqli_close($sqllink);

  