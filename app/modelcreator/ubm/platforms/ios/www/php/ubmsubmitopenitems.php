<?php
 $aname = $_GET['appname'];
 $RQType = $_GET['RQType'];
 $useremail = $_GET['useremail'];
 $userpasswd = $_GET['password']; 
 $username = $_GET['username']; 
 $time_in = $_GET['timein']; 
 $time_out = $_GET['timeout']; 
 $lat = $_GET['latitude']; 
 $lng = $_GET['longitude']; 
 $formref = $_GET['formref'];
 $priority = $_GET['priority'];
 $actionrequired = $_GET['actionrequired'];
 $assignedto = $_GET['assignedto'];
 $duedate = $_GET['duedate'];

			$con=mysqli_connect("localhost","jessespe","Xfn73Xm0","jessespe_UBMv1"); 	//Define db Connection
			if (mysqli_connect_errno($con)) 									// Check connection
			  {
			  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
			  }
				mysqli_query($con,"INSERT INTO ubm_mcs_app_openitems (form_ref, priority, opened_by, action_required, assigned_to, due_date)
				VALUES ('$formref', '$priority', '$username', '$actionrequired', '$assignedto', '$duedate')");
				mysqli_close($con);
	         	echo $_GET['callback'] . '(' . "{'message' : 'Your Review Point or Open Item was created successfully and assigned to: $assignedto. Notification was sent to $useremail and to the assignee phone number on file: 8016086458 '}" . ')';

//Send Admin Notification Email Message
$to = "jspenc72@gmail.com";
$subject = "Admin Checklist Notify";
$message = "A new Checklist was created. The username responsible was, $username";
$from = "admin@universalbusinessmodel.com";
$headers = "From:" . $from;
//mail($to,$subject,$message,$headers);
//echo "Admin Mail Sent.";

//Send Invite Email Message
$to = $useremail;
$subject = "New Find My Driver Checklist, $checklistname";
$message = "You successfully created a new Checklist titled $checklistname, on find my driver! This makes you the owner of this checklist.";
$from = "app@universalbusinessmodel.com";
$headers = "From:" . $from;
//mail($to,$subject,$message,$headers);
//echo "Invite Mail Sent.";

//Send SMS Message

mail("8016086458@vtext.com", "", "$username gave your app has a new open item!", "From: App <openitem@universalbusinessmodel.com>\r\n");
mail("4352302281@vtext.com", "", "$username added an open point!", "From: App <openitem@universalbusinessmodel.com>\r\n");
//echo "SMS was sent!";
