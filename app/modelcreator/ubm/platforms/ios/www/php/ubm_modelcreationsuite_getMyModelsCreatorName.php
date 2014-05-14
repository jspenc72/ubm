 <?php
 require_once('globalGetVariables.php'); 

			$sqllink = mysqli_connect("localhost","jessespe","Xfn73Xm0","jessespe_FindMyDriver"); 	//Define db Connection
			/* check connection */
			if (mysqli_connect_errno()) {
			    printf("Connect failed: %s\n", mysqli_connect_error());
			    exit();
			}
			$query = "SELECT first_name, last_name FROM `members` WHERE `creator_id`='$username'";
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