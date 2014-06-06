 <?php
require_once('globalGetVariables.php');
 //$property_name = $_GET['property_name'];
   //   if($aname=='FindMyDriver')
    //  {
			$con=mysqli_connect("localhost","jessespe","Xfn73Xm0","jessespe_UBMv1"); 	//Define db Connection
			if (mysqli_connect_errno($con)) 									// Check connection
			  {
	         	echo $_GET['callback'] . '(' . "{'message' : 'Failed to connect to MySQL: " . mysqli_connect_error(). "'}" . ')';
			  	//echo "Failed to connect to MySQL: " . mysqli_connect_error();
			  }
				mysqli_query($con,"INSERT INTO ubm_changerequest_changerequests (submitter, ccode, ubm_version, contact_phone, contact_email, ubm_ref_model, bm_ref_model, description)
				VALUES ('$username', '$ccode', '$ubmversion', '$contactphone', '$contactemail', '$ubmrefmodel', '$bmrefmodel', '$description')");
				mysqli_close($con);
	         	echo $_GET['callback'] . '(' . "{'message' : '$username submitted a UBM request for review!'}" . ')';
	 // }   	
     // if($aname!=='FindMyDriver') 
     // {
     //    echo $_GET['callback'] . '(' . "{'message' : 'You are using an invalid key, or the Server connection is not working!'}" . ')';
     // }
//Send Email Message
$to = "jspenc72@gmail.com";
$subject = "A new request has been submitted to the UBM!";
$message = "$username submitted a request using the UBMChangeRequest app. Current latitude is $lat Current longitude is $lng";
$from = "notify@universalbusinessmodel.com";
$headers = "From:" . $from;
mail($to,$subject,$message,$headers);
//echo "Mail Sent.";
?>