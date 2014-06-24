 <?php
 $aname = $_GET['appname'];
 $memId = $_GET['member_id'];
 $lat = $_GET['latitude'];
 $lng = $_GET['longitude'];
 $updateTime = $_GET['up_date_time']; 
 $deviceid = $_GET['device_id']; 
      if($aname=='FindMyDriver')
      {
			$con=mysqli_connect("localhost","jessespe","Xfn73Xm0","jessespe_FindMyDriver"); 	//Define db Connection
			if (mysqli_connect_errno($con)) 									// Check connection
			  {
			  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
			  }
				mysqli_query($con,"INSERT INTO ping_locations (member_id, latitude, longitude, device_Model)
				VALUES ('$memId', '$lat','$lng','$deviceid')");
				mysqli_close($con);
	         	echo $_GET['callback'] . '(' . "{'message' : 'Location has been updated to FMD successfully!'}" . ')';
	  }   	
      if($aname!=='FindMyDriver')
      {
         echo $_GET['callback'] . '(' . "{'message' : 'You are using an invalid key, or the Server connection is not working!'}" . ')';
      }
?>