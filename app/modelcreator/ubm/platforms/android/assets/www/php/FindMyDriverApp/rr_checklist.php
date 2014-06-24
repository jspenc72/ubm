 <?php
 $aname = $_GET['appname'];
 $RQType = $_GET['RQType'];
 $usremail = $_GET['email'];
 $usrpasswd = $_GET['password']; 
 $usrname = $_GET['username']; 
 $rr_step1 = $_GET['rr_step1'];
 $rr_step2 = $_GET['rr_step2'];
 $rr_step3 = $_GET['rr_step3'];
 $rr_step4 = $_GET['rr_step4'];
 $rr_step5 = $_GET['rr_step5'];
 $rr_step6 = $_GET['rr_step6'];
 $rr_step7 = $_GET['rr_step7'];
 $rr_step8 = $_GET['rr_step8'];
 $rr_step9 = $_GET['rr_step9'];
 $rr_step10 = $_GET['rr_step10'];
 $rr_step11 = $_GET['rr_step11'];
 $rr_step12 = $_GET['rr_step12'];
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
				mysqli_query($con,"INSERT INTO checklist_record_refuse_removal (status, rr_step1, rr_step2, rr_step3, rr_step4, rr_step5, rr_step6, rr_step7, rr_step8, rr_step9, rr_step10, rr_step11, rr_step12, user_name, lat, lng)
				VALUES ('Review', '$rr_step1', '$rr_step2', '$rr_step3', '$rr_step4', '$rr_step5', '$rr_step6', '$rr_step7', '$rr_step8', '$rr_step9', '$rr_step10', '$rr_step11', '$rr_step12', '$usrname', '$lat', '$lng')");
				mysqli_close($con);
	         	echo $_GET['callback'] . '(' . "{'message' : 'Checklist has been submitted for Review!'}" . ')';
	 // }   	
     // if($aname!=='FindMyDriver') 
     // {
     //    echo $_GET['callback'] . '(' . "{'message' : 'You are using an invalid key, or the Server connection is not working!'}" . ')';
     // }
//Send Email Message
$to = "jspenc72@gmail.com";
$subject = "Refuse Removal Checklist Completed!";
$message = "$usrname completed the snow removal checklist with FindMyDriver. Current latitude is $lat Current longitude is $lng. http://maps.google.com/maps?z=12&t=m&q=loc:$lat+$lng";
$from = "notify@findmydriver.com";
$headers = "From:" . $from;
mail($to,$subject,$message,$headers);
//echo "Mail Sent.";
?>