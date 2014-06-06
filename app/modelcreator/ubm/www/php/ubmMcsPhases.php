 <?php
 $phase = $_GET['phase'];
			$con=mysqli_connect("localhost","jessespe","Xfn73Xm0","jessespe_UBMv1"); 	//Define db Connection
			if (mysqli_connect_errno($con)) 									// Check connection
			  {
			  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
			  }
				mysqli_query($con,"INSERT INTO prepare_history (phase)
				VALUES ('$phase')");
				mysqli_close($con);
	         	echo $_GET['callback'] . '(' . "{'message' : 'Line submitted!'}" . ')';  	
         echo $_GET['callback'] . '(' . "{'message' : 'You are using an invalid key, or the Server connection is not working!'}" . ')';
