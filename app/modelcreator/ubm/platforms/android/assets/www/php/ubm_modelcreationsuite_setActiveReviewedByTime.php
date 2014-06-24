 <?php
 $aname = $_GET['appname'];
 $RQType = $_GET['RQType'];
 $username = $_GET['username']; 
//Put your json request variables here
 $activeModelId = $_GET['activeModelId']; 
 $taskId = $_GET['taskId']; 
 $startTime = $_GET['startTime']; 
 $modelOwnerLegalEntity = $_GET['modelOwnerLegalEntity']; 
 $modelOwnerCCODE = $_GET['modelOwnerCCODE']; 
 $modelContactName = $_GET['modelContactName']; 
 $modelContactPhone = $_GET['modelContactPhone']; 
 $modelContactEmail = $_GET['modelContactEmail']; 
 $modelPurpose = $_GET['modelPurpose']; 
 $modelScope = $_GET['modelScope']; 
 $catBusiness = $_GET['catBusiness']; 
 $catEducation = $_GET['catEducation']; 
 $catFamily = $_GET['catFamily']; 
 $catHealth = $_GET['catHealth']; 
 $catMedical = $_GET['catMedical']; 
 $catProductivity = $_GET['catProductivity']; 
 $catUtility = $_GET['catUtility']; 
 $catChurch = $_GET['catChurch']; 
 $catCoop = $_GET['catCoop']; 
 $catOther = $_GET['catOther']; 

 //End JSON Request Variables

 $lat = $_GET['lat'];
 $lng = $_GET['lng'];
 //$property_name = $_GET['property_name'];
   //   if($aname=='FindMyDriver')
    //  {
				//$con=mysqli_connect("localhost","jessespe","Xfn73Xm0","jessespe_UBMv1"); 	//Define db Connection
$DBServer = 'localhost'; // e.g 'localhost' or '192.168.1.100'
$DBUser   = 'jessespe';
$DBPass   = 'Xfn73Xm0';
$DBName   = 'jessespe_UBMv1';			
	$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
	 
	// check connection
	if ($conn->connect_error) {
	  trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
	}
	
//INSERT

//SELECT

//UPDATE
 		//$v1="'" . $conn->real_escape_string($disposition) . "'";			 
		$sql="UPDATE `model_creation_suite_has_prepared_by_records` SET start_time='$setActiveFinalReviewedByTime' WHERE model_id='$activeModelId' AND task_id='$itemId' ";
		if($conn->query($sql) === false) {
		  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
		} else {
		  $affected_rows = $conn->affected_rows;
		  echo $_GET['callback'] . '(' . "{'message' : 'The number of affected rows is $affected_rows, the modelId is: $activeModelId and the item id is is: $itemId the time set was $setActiveFinalReviewedByTime!'}" . ')';
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