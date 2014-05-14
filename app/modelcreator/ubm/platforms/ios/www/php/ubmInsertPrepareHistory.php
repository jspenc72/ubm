 <?php
 $app_id = $_GET['app_id'];
 $checklist_id = $_GET['checklist_id'];
 $preparer = $_GET['preparer'];

 echo $_GET['app_id'];
 echo $_GET['checklist_id'];
 echo $_GET['rowid'];
 echo $_GET['preparer'];
 echo $_GET['hrs'];

 			$con=mysqli_connect("localhost","jessespe","Xfn73Xm0","jessespe_UBMv1"); 	//Define db Connection
			if (mysqli_connect_errno($con)) 									// Check connection
			  {
			  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
			  }
				mysqli_query($con,"INSERT INTO prepare_history (app_id, checklist_id, row_id, preparer_username, actual_hours)
				VALUES ('$app_id', '$checklist_id', '$rowid', '$preparer', '$actualhours')");
				mysqli_close($con);
	         	echo $_GET['callback'] . '(' . "{'message' : 'Line submitted!'}" . ')';  	

       //  echo $_GET['callback'] . '(' . "{'message' : 'You are using an invalid key, or the Server connection is not working!'}" . ')';
