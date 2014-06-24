<?php
 $aname = $_GET['appname'];
 $RQType = $_GET['RQType'];
 $useremail = $_GET['useremail'];
 $userpasswd = $_GET['password']; 
 $username = $_GET['username']; 
 $invitename = $_GET['invitename']; 
 $inviteemail = $_GET['inviteemail']; 
 $checklistname = $_GET['checklistname']; 
 $checklistcategory = $_GET['checklistcategory']; 
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
				mysqli_query($con,"INSERT INTO checklist_library (name, category, created_by)
				VALUES ('$checklistname', '$checklistcategory', '$username')");
				mysqli_close($con);
	         	echo $_GET['callback'] . '(' . "{'message' : 'The new Checklist, $checklistname was created successfully!'}" . ')';
				
				
				
				
				
//Send Admin Notification Email Message
$to = "jspenc72@gmail.com";
$subject = "Admin Checklist Notify";
$message = "A new Checklist was created. The username responsible was, $username";
$from = "admin@findmydriver.com";
$headers = "From:" . $from;
mail($to,$subject,$message,$headers);
//echo "Admin Mail Sent.";

//Send Invite Email Message
$to = $useremail;
$subject = "New Find My Driver Checklist, $checklistname";
$message = "You successfully created a new Checklist titled $checklistname, on find my driver! This makes you the owner of this checklist.";
$from = "app@findmydriver.com";
$headers = "From:" . $from;
mail($to,$subject,$message,$headers);
//echo "Invite Mail Sent.";

//Send SMS Message

mail("8016086458@vtext.com", "", "A new Checklist was created!", "From: App <app@findmydriver.com>\r\n");
//echo "SMS was sent!";
