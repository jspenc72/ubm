<?php
 $aname = $_GET['appname'];
 $RQType = $_GET['RQType'];
 $usremail = $_GET['email'];
 $usrpasswd = $_GET['password']; 
 $usrname = $_GET['username']; 
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

//Send Email Message
$to = "jspenc72@gmail.com";
$subject = "Test mail";
$message = "Hello! This is a simple email message.";
$from = "someonelse@gmail.com";
$headers = "From:" . $from;
mail($to,$subject,$message,$headers);
echo "Mail Sent.";
?>