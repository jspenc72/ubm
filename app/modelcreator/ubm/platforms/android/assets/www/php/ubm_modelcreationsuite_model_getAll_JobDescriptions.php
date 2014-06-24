 <?php
 $aname = $_GET['appname'];
 $RQType = $_GET['RQType'];
 $username = $_GET['username'];
 $usrpasswd = $_GET['password'];
 $activeModelId = $_GET['activeModelId'];
			$sqllink = mysqli_connect("localhost","jessespe","Xfn73Xm0","jessespe_UBMv1"); 	//Define db Connection
			/* check connection */
			if (mysqli_connect_errno()) {
			    printf("Connect failed: %s\n", mysqli_connect_error());
			    exit();
			}
			$query = "SELECT * FROM `ubm_model_jobDescriptions`";
			$result = mysqli_query($sqllink, $query);
			if (!$result) { //there is a problem with the table
			}
			$all_items = array();
			while ($items = $result->fetch_assoc()) {					
				$all_items[] = $items;
			}
			//echo $_GET['callback'] . '(' . "{'message' : ''}" . ')';							
			echo $_GET['callback'] . '(' . json_encode($all_items) . ')';
			mysqli_close($sqllink);
?>