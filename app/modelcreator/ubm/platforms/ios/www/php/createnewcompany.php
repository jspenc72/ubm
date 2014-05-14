<?php
 $aname = $_GET['appname'];
 $RQType = $_GET['RQType'];
 $useremail = $_GET['useremail'];
 $userpasswd = $_GET['password']; 
 $username = $_GET['username']; 				//
 $invitename = $_GET['invitename']; 			
 $inviteemail = $_GET['inviteemail']; 
 $invitephone = $_GET['invitephone']; 			
 $companyname = $_GET['companyname']; 			//
 $companyurl = $_GET['companyurl']; 			//
 $streetaddress = $_GET['streetaddress']; 		//
 $cityaddress = $_GET['cityaddress']; 			//
 $stateaddress = $_GET['stateaddress']; 		//
 $zipaddress = $_GET['zipaddress']; 			//
 $time_in = $_GET['timein']; 
 $time_out = $_GET['timeout']; 
 $property_name = $_GET['property_name']; 
 $lat = $_GET['latitude']; 
 $lng = $_GET['longitude']; 
			$con=mysqli_connect("localhost","jessespe","Xfn73Xm0","jessespe_FindMyDriver"); 	//Define db Connection
			if (mysqli_connect_errno($con)) 									// Check connection
			  {
			  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
			  }
				mysqli_query($con,"INSERT INTO companies (companyname, companyurl, primarycontactname, primarycontactnumber, primarycontactemail, streetaddress, cityaddress, stateaddress, zipaddress)
				VALUES ('$companyname', '$companyurl', '$username', '$primarycontactnumber', '$primarycontactemail', '$streetaddress', '$cityaddress', '$stateaddress', '$zipaddress')");
				mysqli_close($con);
	         	echo $_GET['callback'] . '(' . "{'message' : 'Invite Sent Successfully!'}" . ')';
				
				//Send Admin Notification Email Message
				$to = "jspenc72@gmail.com";
				$subject = "Admin Invite Notify";
				$message = "A find my driver invite has been sent to, $inviteemail. The username who invited them was, $username";
				$from = "admin@findmydriver.com";
				$headers = "From:" . $from;
				mail($to,$subject,$message,$headers);
				//echo "Admin Mail Sent.";
				
				//Send Invite Email Message
				
				$to = $inviteemail;
				$subject = "Find My Driver invite for $inviteemail";
				$message = "Please visit, www.findmydriver.com to download the application and start using your account today. Please visit, universalbusinessmodel.com to enable all UBM compliant features of this app!";
				$from = "invite@findmydriver.com";
				$headers = "From:" . $from;
				mail($to,$subject,$message,$headers);
				//echo "Invite Mail Sent.";
