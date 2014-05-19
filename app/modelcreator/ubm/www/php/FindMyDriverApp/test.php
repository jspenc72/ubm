 <?php
 $aname = $_GET['appname'];
 $RQType = $_GET['RQType'];
 $username = $_GET['username'];
 $usrpasswd = $_GET['password'];
			$sqllink = mysqli_connect("localhost","jessespe","Xfn73Xm0","jessespe_FindMyDriver"); 	//Define db Connection
			/* check connection */
			if (mysqli_connect_errno()) {
			    printf("Connect failed: %s\n", mysqli_connect_error());
			    exit();
			}
			
			$query = "SELECT * FROM `members`";
			$result = mysqli_query($sqllink, $query);
			if (!$result) { //there is a problem with the table
			
			}
			
			$all_members = array();
			while ($member = $result->fetch_assoc()) {
				$all_members[] = $member;
			}
			//echo $_GET['callback'] . '(' . "{'message' : ''}" . ')';							
			echo $_GET['callback'] . '(' . json_encode($all_members) . ')';
			
			mysqli_close($sqllink);
