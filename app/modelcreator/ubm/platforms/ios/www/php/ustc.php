 <?php
 $aname = $_GET['appname'];
 $RQType = $_GET['RQType'];
 $usremail = $_GET['email'];
 $usrpasswd = $_GET['password']; 
 $usrname = $_GET['username']; 
 $time_in = $_GET['timein']; 
 $time_out = $_GET['timeout']; 
 $property_name = $_GET['propertyname']; 
 $lat = $_GET['latitude']; 
 $lng = $_GET['longitude']; 
 $entryMethod = $_GET['entryMethod'];
//      if($aname=='FindMyDriver')
 //     {
			$con=mysqli_connect("localhost","jessespe","Xfn73Xm0","jessespe_FindMyDriver"); 	//Define db Connection
			if (mysqli_connect_errno($con)) 									// Check connection
			  {
			  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
			  }
				mysqli_query($con,"INSERT INTO driver_timecard (username, time_in, time_out, property_name, latitude, longitude, entryMethod)
				VALUES ('$usrname', '$time_in', '$time_out','$property_name', '$lat', '$lng', '$entryMethod')");
				mysqli_close($con);
	         	echo $_GET['callback'] . '(' . "{'message' : 'Time was submitted successfully!'}" . ')';
//	  }   	
//      if($aname!=='FindMyDriver')
//      {
//         echo $_GET['callback'] . '(' . "{'message' : 'You are using an invalid key, or the Server connection is not working!'}" . ')';
//      }
 ?>