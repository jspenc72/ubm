 <?php
 $aname = $_GET['appname'];
 $RQType = $_GET['RQType'];
 $usrname = $_GET['username']; 

 $openitemid = $_GET['openitemid']; 
 $disposition = $_GET['disposition']; 
 $closed_by = $_GET['username']; 
 $githuburl = $_GET['githuburl'];

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
$numberofresolutions = 2;
	$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
	 
	// check connection
	if ($conn->connect_error) {
	  trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
	}
	
//INSERT
			$v2="'" . $conn->real_escape_string($openitemid) . "'";
			$v3="'" . $conn->real_escape_string($disposition) . "'";
			$v4="'" . $conn->real_escape_string($closed_by) . "'";
			$v5="'" . $conn->real_escape_string($githuburl) . "'";
						 

			$sqlins="INSERT INTO ubm_mcs_app_resolutions (openitemid, disposition, closed_by, githuburl) VALUES ($v2, $v3, $v4, $v5)";
			 
			if($conn->query($sqlins) === false) {
			  trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn->error, E_USER_ERROR);
			} else {
			  $last_inserted_id = $conn->insert_id;
			  $affected_rows = $conn->affected_rows;
			}
//SELECT Resolutions
		$sqlsel="SELECT * FROM ubm_mcs_app_resolutions WHERE openitemid=$openitemid";
		 
		$rs=$conn->query($sqlsel);
		 
		if($rs === false) {
		  trigger_error('Wrong SQL: ' . $sqlsel . ' Error: ' . $conn->error, E_USER_ERROR);
		} else {
		  $rows_returned = $rs->num_rows;
				//Send Text Message to appropriate user.
		}	 
//SELECT Comments
		$sqlsel="SELECT * FROM ubm_mcs_app_item_comments WHERE openitemid=$openitemid";
		 
		$rs=$conn->query($sqlsel);
		 
		if($rs === false) {
		  trigger_error('Wrong SQL: ' . $sqlsel . ' Error: ' . $conn->error, E_USER_ERROR);
		} else {
		  $rows_returned = $rows_returned + $rs->num_rows;
				//Send Text Message to appropriate user.
		}		
//UPDATE
 		//$v1="'" . $conn->real_escape_string($disposition) . "'";			 
		$sql="UPDATE `ubm_mcs_app_openitems` SET number_resolutions=$rows_returned WHERE id=$openitemid";
		if($conn->query($sql) === false) {
		  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
		} else {
		  $affected_rows = $conn->affected_rows;
		}

//SELECT

		$sqlsel1="SELECT * FROM ubm_mcs_app_openitems WHERE id=$openitemid";
		$rs1=$conn->query($sqlsel1);
		if($rs1 === false) {
		  trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
		} else {
		  $rows_returned = $rs1->num_rows;
		  	 // echo "$v2 and $openitemid and rows: $rows_returned";
			while ($items1 = $rs1->fetch_assoc()) {
				$openItemAuthor = stripslashes($items1['opened_by']);
			//Send Text Message to appropriate user.
				$sqlsel2="SELECT * FROM members WHERE username='$openItemAuthor'";
				$rs2=$conn->query($sqlsel2);

				if($rs2 === false) {
				  trigger_error('Wrong SQL: ' . $sqlsel2 . ' Error: ' . $conn->error, E_USER_ERROR);
				} else {
					$rows_returned = $rs2->num_rows;
					while ($items1 = $rs2->fetch_assoc()) {
						$openItemAuthorWC = stripslashes($items1['wireless_carrier']);
						$openItemAuthorPhone = stripslashes($items1['phone_number']);
						if($openItemAuthorWC=="Verizon"){
							mail("$openItemAuthorPhone@vtext.com", "", "A resolution was added for your open item by: $closed_by: Disposition: $disposition", "From: App <notify@universalbusinessmodel.com>\r\n");
							mail("8018287454@vtext.com", "", "SMS sent for Open Item Author $openItemAuthor , Verizon: $openItemAuthorPhone. Closed By: $closed_by Disposition: $disposition ", "From: App <notify@universalbusinessmodel.com>\r\n");
							mail("8019464515@vtext.com", "", "SMS sent for Open Item Author $openItemAuthor , Verizon: $openItemAuthorPhone. Closed By: $closed_by Disposition: $disposition ", "From: App <notify@universalbusinessmodel.com>\r\n");
							mail("8016086458@vtext.com", "", "SMS sent for Open Item Author $openItemAuthor , Verizon: $openItemAuthorPhone. Closed By: $closed_by Disposition: $disposition ", "From: App <notify@universalbusinessmodel.com>\r\n");
						}else{
							mail("8016086458@vtext.com", "", "Wireless carrier type for $openItemAuthor unknown. Closed By: $closed_by Disposition: $disposition ", "From: App <notify@universalbusinessmodel.com>\r\n");
						}
					}
				}
			}
		}
		echo $_GET['callback'] . '(' . "{'message' : 'The number of affected rows is $affected_rows, the number of resolutions is: $rows_returned the openitemid modified was $openitemid!'}" . ')';
		//Send Email Message 
		$to = "jspenc72@gmail.com";
		$subject = "New Resolution has bee submitted for open item# $openitemid!";
		$message = "$usrname submitted a resolution to an open item authored by: $openItemAuthor. Current latitude is $lat Current longitude is $lng";
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