 <?php
 $aname = $_GET['appname'];
 $RQType = $_GET['RQType'];
 $usremail = $_GET['email'];
 $usrpasswd = $_GET['password']; 
 $usrname = $_GET['username']; 
 $sr_step1 = $_GET['sr_step1'];
 $sr_step2 = $_GET['sr_step2'];
 $sr_step3 = $_GET['sr_step3'];
 $sr_step4 = $_GET['sr_step4'];
 $sr_step5 = $_GET['sr_step5'];
 $sr_step6 = $_GET['sr_step6'];
 $sr_step7 = $_GET['sr_step7'];
 $sr_step8 = $_GET['sr_step8'];
 $sr_step9 = $_GET['sr_step9'];
 $sr_step10 = $_GET['sr_step10'];
 $sr_step11 = $_GET['sr_step11'];
 $sr_step12 = $_GET['sr_step12'];
 $lat = $_GET['lat'];
 $lng = $_GET['lng'];
 //$property_name = $_GET['property_name'];
   //   if($aname=='FindMyDriver')
    //  {
			$con=mysqli_connect("localhost","jessespe","Xfn73Xm0","jessespe_FindMyDriver"); 	//Define db Connection
			if (mysqli_connect_errno($con)) 									// Check connection
			  {
			  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
			  }
				mysqli_query($con,"INSERT INTO checklist_record_snow_removal (status, sr_step1, sr_step2, sr_step3, sr_step4, sr_step5, sr_step6, sr_step7, sr_step8, sr_step9, sr_step10, sr_step11, sr_step12, user_name, lat, lng)
				VALUES ('Review', '$sr_step1', '$sr_step2', '$sr_step3', '$sr_step4', '$sr_step5', '$sr_step6', '$sr_step7', '$sr_step8', '$sr_step9', '$sr_step10', '$sr_step11', '$sr_step12', '$usrname', '$lat', '$lng')");
				mysqli_close($con);
	         	echo $_GET['callback'] . '(' . "{'message' : 'Checklist has been submitted for Review!'}" . ')';
	 // }   	
     // if($aname!=='FindMyDriver') 
     // {
     //    echo $_GET['callback'] . '(' . "{'message' : 'You are using an invalid key, or the Server connection is not working!'}" . ')';
     // }
//Send Email Message
$to = "jspenc72@gmail.com";
$subject = "Snow Removal Checklist Completed!";
$message = "$usrname completed the snow removal checklist with FindMyDriver. Current latitude is $lat Current longitude is $lng. http://maps.google.com/maps?z=12&t=m&q=loc:$lat+$lng";
$from = "notify@findmydriver.com";
$headers = "From:" . $from;
mail($to,$subject,$message,$headers);
//echo "Mail Sent.";
?>