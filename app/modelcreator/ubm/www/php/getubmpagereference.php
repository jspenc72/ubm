 <?php
 require_once('ubms_db_config.php');
 require_once('globalGetVariables.php');
 	       echo $_GET['callback'] . '(' . "{'message' : 'Here is the page id from the server: $pageid'}" . ')';							
			$sqllink = mysqli_connect("localhost","jessespe","Xfn73Xm0","jessespe_FindMyDriver"); 	//Define db Connection
			/* check connection */
			if (mysqli_connect_errno()) {
			    printf("Connect failed: %s\n", mysqli_connect_error());
			    exit();
			}
			$query = "SELECT * FROM `app_pages` WHERE `js_id`='$pageid'";
//			$query = "SELECT * FROM `app_pages`";
			$result = mysqli_query($sqllink, $query);
			// GOING THROUGH THE DATA
				if($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						$returnpageid = stripslashes($row['js_id']);
						if($returnpageid==$pageid){
				         	echo $_GET['callback'] . '(' . "{'message' : 'We found a page in the UBM db with this id!'}" . ')';
						}else{
				         	echo $_GET['callback'] . '(' . "{'message' : 'We did not find a page in the UBM database with this id!'}" . ')';
						}
//						echo stripslashes($row['username']);
//						echo "</br>";	
					}
				}
				else {
				   //    echo $_GET['callback'] . '(' . "{'message' : 'Something went horribly wrong!'}" . ')';							
				}
			/* close connection */
			mysqli_close($sqllink);  