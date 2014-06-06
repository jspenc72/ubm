 <?php
require_once('globalGetVariables.php');
require_once('ubms_db_config.php');
require_once('DBConnect_UBMv1.php');		//Provides the variables used for UBMv1 database connection $conn
	$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
	// check connection
	if ($conn->connect_error) {
	  trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
	}
//UPDATE
			$vUsername="'" . $conn->real_escape_string($username) . "'";
			$v0="'" . $conn->real_escape_string($activeModelId) . "'";
			$v1="'" . $conn->real_escape_string($taskId) . "'";
			$v2="'" . $conn->real_escape_string($startTime) . "'";
			$v3="'" . $conn->real_escape_string($modelOwnerLegalEntity) . "'";
			$v4="'" . $conn->real_escape_string($modelOwnerCCODE) . "'";
			$v5="'" . $conn->real_escape_string($modelContactName) . "'";
			$v6="'" . $conn->real_escape_string($modelContactPhone) . "'";
			$v7="'" . $conn->real_escape_string($modelContactEmail) . "'";
			$v8="'" . $conn->real_escape_string($modelPurpose) . "'";
			$v9="'" . $conn->real_escape_string($modelScope) . "'";

			$v10="'" . $conn->real_escape_string($catBusiness) . "'";
			$v11="'" . $conn->real_escape_string($catEducation) . "'";
			$v12="'" . $conn->real_escape_string($catFamily) . "'";
			$v13="'" . $conn->real_escape_string($catHealth) . "'";
			$v14="'" . $conn->real_escape_string($catMedical) . "'";
			$v15="'" . $conn->real_escape_string($catProductivity) . "'";
			$v16="'" . $conn->real_escape_string($catUtility) . "'";
			$v17="'" . $conn->real_escape_string($catChurch) . "'";
			$v18="'" . $conn->real_escape_string($catCoop) . "'";
			$v19="'" . $conn->real_escape_string($catOther) . "'";
			if(strlen($v10)<7 && strlen($v11)>0){			//If stringlength is greater than 6, the value must be false
			//		echo $v10;			
//SELECT																					
				$sqlsel="SELECT * FROM ubm_model_categories WHERE category_name='Business'";																							//Select the category from the database
				$rs=$conn->query($sqlsel);
				if($rs === false) {
				  trigger_error('Wrong SQL: ' . $sqlsel . ' Error: ' . $conn->error, E_USER_ERROR);
				} else {
						while ($items = $rs->fetch_assoc()) {
									$returnedCategory_name = stripslashes($items['category_name']);
									$returnedCategory_id = stripslashes($items['id']);												//Obtain the id for the appropriate category
							//echo $returnedCategory_id;
						}			
				  $rows_returned = $rs->num_rows;
				}	
//INSERT
				$sqlins="INSERT INTO ubm_model_has_categories (model_id, category_id) VALUES ($v0, $returnedCategory_id )";			 // Insert record to add the activeModel to the appropriate category.
				if($conn->query($sqlins) === false) {
				  trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn->error, E_USER_ERROR);
				} else {
				  $last_inserted_id = $conn->insert_id;
				 // $affected_rows = $conn->affected_rows;
				}	
			} 
			if(strlen($v11)<7 && strlen($v11)>0){			//If stringlength is greater than 6, the value must be false
//SELECT																					
				$sqlsel="SELECT * FROM ubm_model_categories WHERE category_name='Education'";																							//Select the category from the database
				$rs=$conn->query($sqlsel);
				if($rs === false) {
				  trigger_error('Wrong SQL: ' . $sqlsel . ' Error: ' . $conn->error, E_USER_ERROR);
				} else {
						while ($items = $rs->fetch_assoc()) {
									$returnedCategory_name = stripslashes($items['category_name']);
									$returnedCategory_id = stripslashes($items['id']);												//Obtain the id for the appropriate category
							//echo $returnedCategory_id;
						}			
				  $rows_returned = $rs->num_rows;
				}	
//INSERT
				$sqlins="INSERT INTO ubm_model_has_categories (model_id, category_id) VALUES ($v0, $returnedCategory_id )";			 // Insert record to add the activeModel to the appropriate category.
				if($conn->query($sqlins) === false) {
				  trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn->error, E_USER_ERROR);
				} else {
				  $last_inserted_id = $conn->insert_id;
				 // $affected_rows = $conn->affected_rows;
				}		
			}
			if(strlen($v12)<7 && strlen($v12)>0){
//SELECT																					
				$sqlsel="SELECT * FROM ubm_model_categories WHERE category_name='Family'";																							//Select the category from the database
				$rs=$conn->query($sqlsel);
				if($rs === false) {
				  trigger_error('Wrong SQL: ' . $sqlsel . ' Error: ' . $conn->error, E_USER_ERROR);
				} else {
						while ($items = $rs->fetch_assoc()) {
									$returnedCategory_name = stripslashes($items['category_name']);
									$returnedCategory_id = stripslashes($items['id']);												//Obtain the id for the appropriate category
							//echo $returnedCategory_id;
						}			
				  $rows_returned = $rs->num_rows;
				}	
//INSERT
				$sqlins="INSERT INTO ubm_model_has_categories (model_id, category_id) VALUES ($v0, $returnedCategory_id )";			 // Insert record to add the activeModel to the appropriate category.
				if($conn->query($sqlins) === false) {
				  trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn->error, E_USER_ERROR);
				} else {
				  $last_inserted_id = $conn->insert_id;
				 // $affected_rows = $conn->affected_rows;
				}
			}
			if(strlen($v13)<7 && strlen($v13)>0){
//SELECT																					
				$sqlsel="SELECT * FROM ubm_model_categories WHERE category_name='Health'";																							//Select the category from the database
				$rs=$conn->query($sqlsel);
				if($rs === false) {
				  trigger_error('Wrong SQL: ' . $sqlsel . ' Error: ' . $conn->error, E_USER_ERROR);
				} else {
						while ($items = $rs->fetch_assoc()) {
									$returnedCategory_name = stripslashes($items['category_name']);
									$returnedCategory_id = stripslashes($items['id']);												//Obtain the id for the appropriate category
							//echo $returnedCategory_id;
						}			
				  $rows_returned = $rs->num_rows;
				}	
//INSERT
				$sqlins="INSERT INTO ubm_model_has_categories (model_id, category_id) VALUES ($v0, $returnedCategory_id )";			 // Insert record to add the activeModel to the appropriate category.
				if($conn->query($sqlins) === false) {
				  trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn->error, E_USER_ERROR);
				} else {
				  $last_inserted_id = $conn->insert_id;
				 // $affected_rows = $conn->affected_rows;
				}
			}
			if(strlen($v14)<7 && strlen($v14)>0){
//SELECT																					
				$sqlsel="SELECT * FROM ubm_model_categories WHERE category_name='Medical'";																							//Select the category from the database
				$rs=$conn->query($sqlsel);
				if($rs === false) {
				  trigger_error('Wrong SQL: ' . $sqlsel . ' Error: ' . $conn->error, E_USER_ERROR);
				} else {
						while ($items = $rs->fetch_assoc()) {
									$returnedCategory_name = stripslashes($items['category_name']);
									$returnedCategory_id = stripslashes($items['id']);												//Obtain the id for the appropriate category
							//echo $returnedCategory_id;
						}			
				  $rows_returned = $rs->num_rows;
				}	
//INSERT
				$sqlins="INSERT INTO ubm_model_has_categories (model_id, category_id) VALUES ($v0, $returnedCategory_id )";			 // Insert record to add the activeModel to the appropriate category.
				if($conn->query($sqlins) === false) {
				  trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn->error, E_USER_ERROR);
				} else {
				  $last_inserted_id = $conn->insert_id;
				 // $affected_rows = $conn->affected_rows;
				}
			}
			if(strlen($v15)<7 && strlen($v15)>0){
//SELECT																					
				$sqlsel="SELECT * FROM ubm_model_categories WHERE category_name='Productivity'";																							//Select the category from the database
				$rs=$conn->query($sqlsel);
				if($rs === false) {
				  trigger_error('Wrong SQL: ' . $sqlsel . ' Error: ' . $conn->error, E_USER_ERROR);
				} else {
						while ($items = $rs->fetch_assoc()) {
									$returnedCategory_name = stripslashes($items['category_name']);
									$returnedCategory_id = stripslashes($items['id']);												//Obtain the id for the appropriate category
							//echo $returnedCategory_id;
						}			
				  $rows_returned = $rs->num_rows;
				}	
//INSERT
				$sqlins="INSERT INTO ubm_model_has_categories (model_id, category_id) VALUES ($v0, $returnedCategory_id )";			 // Insert record to add the activeModel to the appropriate category.
				if($conn->query($sqlins) === false) {
				  trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn->error, E_USER_ERROR);
				} else {
				  $last_inserted_id = $conn->insert_id;
				 // $affected_rows = $conn->affected_rows;
				}
			}
			if(strlen($v16)<7 && strlen($v16)>0){
//SELECT																					
				$sqlsel="SELECT * FROM ubm_model_categories WHERE category_name='Utility'";																							//Select the category from the database
				$rs=$conn->query($sqlsel);
				if($rs === false) {
				  trigger_error('Wrong SQL: ' . $sqlsel . ' Error: ' . $conn->error, E_USER_ERROR);
				} else {
						while ($items = $rs->fetch_assoc()) {
									$returnedCategory_name = stripslashes($items['category_name']);
									$returnedCategory_id = stripslashes($items['id']);												//Obtain the id for the appropriate category
							//echo $returnedCategory_id;
						}			
				  $rows_returned = $rs->num_rows;
				}	
//INSERT
				$sqlins="INSERT INTO ubm_model_has_categories (model_id, category_id) VALUES ($v0, $returnedCategory_id )";			 // Insert record to add the activeModel to the appropriate category.
				if($conn->query($sqlins) === false) {
				  trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn->error, E_USER_ERROR);
				} else {
				  $last_inserted_id = $conn->insert_id;
				 // $affected_rows = $conn->affected_rows;
				}
			}
			if(strlen($v17)<7 && strlen($v17)>0){
//SELECT																					
				$sqlsel="SELECT * FROM ubm_model_categories WHERE category_name='Church'";																							//Select the category from the database
				$rs=$conn->query($sqlsel);
				if($rs === false) {
				  trigger_error('Wrong SQL: ' . $sqlsel . ' Error: ' . $conn->error, E_USER_ERROR);
				} else {
						while ($items = $rs->fetch_assoc()) {
									$returnedCategory_name = stripslashes($items['category_name']);
									$returnedCategory_id = stripslashes($items['id']);												//Obtain the id for the appropriate category
							//echo $returnedCategory_id;
						}			
				  $rows_returned = $rs->num_rows;
				}	
//INSERT
				$sqlins="INSERT INTO ubm_model_has_categories (model_id, category_id) VALUES ($v0, $returnedCategory_id )";			 // Insert record to add the activeModel to the appropriate category.
				if($conn->query($sqlins) === false) {
				  trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn->error, E_USER_ERROR);
				} else {
				  $last_inserted_id = $conn->insert_id;
				 // $affected_rows = $conn->affected_rows;
				}
			}
			if(strlen($v18)<7 && strlen($v18)>0){
//SELECT																					
				$sqlsel="SELECT * FROM ubm_model_categories WHERE category_name='Coop'";																							//Select the category from the database
				$rs=$conn->query($sqlsel);
				if($rs === false) {
				  trigger_error('Wrong SQL: ' . $sqlsel . ' Error: ' . $conn->error, E_USER_ERROR);
				} else {
						while ($items = $rs->fetch_assoc()) {
									$returnedCategory_name = stripslashes($items['category_name']);
									$returnedCategory_id = stripslashes($items['id']);												//Obtain the id for the appropriate category
							//echo $returnedCategory_id;
						}			
				  $rows_returned = $rs->num_rows;
				}	
//INSERT
				$sqlins="INSERT INTO ubm_model_has_categories (model_id, category_id) VALUES ($v0, $returnedCategory_id )";			 // Insert record to add the activeModel to the appropriate category.
				if($conn->query($sqlins) === false) {
				  trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn->error, E_USER_ERROR);
				} else {
				  $last_inserted_id = $conn->insert_id;
				 // $affected_rows = $conn->affected_rows;
				}
			}			
			if(strlen($v19)<7 && strlen($v19)>0){
//SELECT																					
				$sqlsel="SELECT * FROM ubm_model_categories WHERE category_name='Other'";																							//Select the category from the database
				$rs=$conn->query($sqlsel);
				if($rs === false) {
				  trigger_error('Wrong SQL: ' . $sqlsel . ' Error: ' . $conn->error, E_USER_ERROR);
				} else {
						while ($items = $rs->fetch_assoc()) {
									$returnedCategory_name = stripslashes($items['category_name']);
									$returnedCategory_id = stripslashes($items['id']);												//Obtain the id for the appropriate category
							//echo $returnedCategory_id;
						}			
				  $rows_returned = $rs->num_rows;
				}	
//INSERT
				$sqlins="INSERT INTO ubm_model_has_categories (model_id, category_id) VALUES ($v0, $returnedCategory_id )";			 // Insert record to add the activeModel to the appropriate category.
				if($conn->query($sqlins) === false) {
					trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn->error, E_USER_ERROR);
				} else {
					$last_inserted_id = $conn->insert_id;
					// $affected_rows = $conn->affected_rows;
				}
			}
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
				$sql="UPDATE `ubm_model` SET owner_legal_entity=$v3, 
				owner_ccode=$v4, 
				model_contact_name=$v5, 
				model_contact_phone=$v6, 
				model_contact_email=$v7, 
				purpose=$v8, 
				scope=$v9   WHERE id='$returnedModelId'";
				if($conn->query($sql) === false) {
				  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
				} else {
				  $affected_rows = $conn->affected_rows;
				  echo $_GET['callback'] . '(' . "{'message' : 'The number of affected rows is $affected_rows, the Model Id is: $returnedModelId.'}" . ')';
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