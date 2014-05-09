 <?php
 $aname = $_GET['appname'];
 $RQType = $_GET['RQType'];
 $username = $_GET['username']; 
//Put your json request variables here
 $activeModelId = $_GET['activeModelId']; 
 $conceptualDefinition = $_GET['conceptualDefinition']; 
 $missionStatement = $_GET['missionStatement']; 
 $visionStatement = $_GET['visionStatement']; 

 //End JSON Request Variables
 $lat = $_GET['lat'];
 $lng = $_GET['lng'];
$DBServer = 'localhost'; // e.g 'localhost' or '192.168.1.100'
$DBUser   = 'jessespe';
$DBPass   = 'Xfn73Xm0';
$DBName   = 'jessespe_UBMv1';			
	$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
	// check connection
	if ($conn->connect_error) {
	  trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
	}
//UPDATE
			$v0="'" . $conn->real_escape_string($activeModelId) . "'";
			$v1="'" . $conn->real_escape_string($taskId) . "'";
			$v2="'" . $conn->real_escape_string($startTime) . "'";
			$v3="'" . $conn->real_escape_string($conceptualDefinition) . "'";
			$v4="'" . $conn->real_escape_string($missionStatement) . "'";
			$v5="'" . $conn->real_escape_string($visionStatement) . "'";
			$sqlsel="SELECT * FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID WHERE UUID=$activeModelUUID";																							//Select the category from the database
				$rs=$conn->query($sqlsel);
				if($rs === false) {
				  trigger_error('Wrong SQL: ' . $sqlsel . ' Error: ' . $conn->error, E_USER_ERROR);
				} else {
						while ($items = $rs->fetch_assoc()) {
									$returnedModelId = stripslashes($items['model_id']);
						}			
				  $rows_returned = $rs->num_rows;
				}
			$sql="UPDATE `ubm_model` SET conceptual_definition=$v3, 
			mission_statement=$v4, 
			vision_statement=$v5
			WHERE id='$activeModelId'";
			if($conn->query($sql) === false) {
			  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
			} else {
			  $affected_rows = $conn->affected_rows;
			  echo $_GET['callback'] . '(' . "{'message' : 'The number of affected rows is $affected_rows, the Model Id is: $activeModelId.'}" . ')';
			}





/*Send Email Message 
$to = "jspenc72@gmail.com";
$subject = "New feedback has bee submitted for request# $ubmchangerequestid!";
$message = "$usrname submitted feedback using the UBMChangeRequest app. Current latitude is $lat Current longitude is $lng";
$from = "notify@universalbusinessmodel.com";
$headers = "From:" . $from;
mail($to,$subject,$message,$headers);
//echo "Mail Sent.";
/*http://www.pontikis.net/blog/how-to-use-php-improved-mysqli-extension-and-why-you-should
	 * SELECT
				$sql='SELECT col1, col2, col3 FROM table1 WHERE condition';
				 
				$rs=$conn->query($sql);
				 
				if($rs === false) {
				  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
				} else {
				  $rows_returned = $rs->num_rows;
				}			
			 * Iterate over Recordset		
				$rs->data_seek(0);
				while($row = $rs->fetch_assoc()){
				    echo $row['col1'] . '<br>';
				}
			 * 	Store all values to array
				$rs=$conn->query($sql);
				 
				if($rs === false) {
				  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
				} else {
				  $arr = $rs->fetch_all(MYSQLI_ASSOC);
				}
				foreach($arr as $row) {
				  echo $row['co1'];
				}	 
			 * 		Record count	
			 	$rows_returned = $rs->num_rows;
			 * Move inside recordset
			 	$rs->data_seek(10);
			 *	Free memory
			 
			  $rs->free();
			 * 
	 * INSERT
			$v1="'" . $conn->real_escape_string('col1_value') . "'";
			 
			$sql="INSERT INTO tbl (col1_varchar, col2_number) VALUES ($v1,10)";
			 
			if($conn->query($sql) === false) {
			  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
			} else {
			  $last_inserted_id = $conn->insert_id;
			  $affected_rows = $conn->affected_rows;
			}	 
	 * UPDATE
			$v1="'" . $conn->real_escape_string('col1_value') . "'";
			 
			$sql="UPDATE tbl SET col1_varchar=$v1, col2_number=1 WHERE id>10";
			 
			if($conn->query($sql) === false) {
			  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
			} else {
			  $affected_rows = $conn->affected_rows;
			}	 	
	 * DELETE
			$sql="DELETE FROM tbl WHERE id>10";
			 
			if($conn->query($sql) === false) {
			  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
			} else {
			  $affected_rows = $conn->affected_rows;
			}	
				 
	 * */	
?>