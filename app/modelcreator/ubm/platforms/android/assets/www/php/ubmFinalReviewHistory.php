 <?php
 $app_id = $_GET['app_id'];
 $approval = $_GET['approval'];
 $prapared_by_id = $GET['prepared_by_id'];
 $reviewer_username = $GET['reviewer_username'];
			$con=mysqli_connect("localhost","jessespe","Xfn73Xm0","jessespe_UBMv1"); 	//Define db Connection
			if (mysqli_connect_errno($con)) 									// Check connection
			  {
			  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
			  }
				mysqli_query($con,"INSERT INTO review_history (app_id, approval, prepared_by_id, reviwer_username)
				VALUES ('$app_id', '$approval','$prepared_by_id','$reviewer_username')");
				mysqli_close($con);
	         	echo $_GET['callback'] . '(' . "{'message' : 'Line submitted!'}" . ')';  	
         echo $_GET['callback'] . '(' . "{'message' : 'You are using an invalid key, or the Server connection is not working!'}" . ')';
