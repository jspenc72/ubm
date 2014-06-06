 <?php
 require_once('globalGetVariables.php');
 //$property_name = $_GET['property_name'];
   //   if($aname=='FindMyDriver')
    //  {
			$con=mysqli_connect("localhost","jessespe","Xfn73Xm0","jessespe_UBMv1"); 	//Define db Connection
			if (mysqli_connect_errno($con)) 									// Check connection
			  {
			  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
			  }
				mysqli_query($con,"INSERT INTO `ubm_changerequest_feedback` (reviewer_member_id, ubm_change_request_id, resolution, resolution_explanation)
				VALUES ('$usrname', '$ubmchangerequestid', '$resolution', '$resolutionexplanation')");
				mysqli_close($con);
	         	echo $_GET['callback'] . '(' . "{'message' : 'Feedback has been submitted for Review $ubmchangerequestid!'}" . ')';
	 // }   	
     // if($aname!=='FindMyDriver') 
     // {
     //    echo $_GET['callback'] . '(' . "{'message' : 'You are using an invalid key, or the Server connection is not working!'}" . ')';
     // }
//Send Email Message
$to = "jspenc72@gmail.com";
$subject = "New feedback has bee submitted for request# $ubmchangerequestid!";
$message = "$usrname submitted feedback using the UBMChangeRequest app. Current latitude is $lat Current longitude is $lng";
$from = "notify@universalbusinessmodel.com";
$headers = "From:" . $from;
mail($to,$subject,$message,$headers);
//echo "Mail Sent.";
?>