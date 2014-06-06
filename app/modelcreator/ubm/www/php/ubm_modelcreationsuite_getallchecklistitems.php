 <?php
 require_once('globalGetVariables.php');

$DBServer = 'localhost'; // e.g 'localhost' or '192.168.1.100'
$DBUser   = 'jessespe';
$DBPass   = 'Xfn73Xm0';
$DBName   = 'jessespe_UBMv1';			
	$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);

	// check connection
	if ($conn->connect_error) {
	  trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
	}

//SELECT
$all_items = array();


//1. Select all records for checklist items stored in model_creation_suite, Count the number of items in the checklist.
			$sqlsel1="SELECT * FROM model_creation_suite";		//Select all 
			$rs1=$conn->query($sqlsel1);
			if($rs1 === false) {
			  trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
			} else {
					if($rs1 === false) {												//If something is wrong...
					  trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
					}else{
						$num_rows = mysqli_num_rows($rs1);
						//echo "the total number of rows: $num_rows </br>";						
					}								
			}
//2. for loop while i<number of records in step 1
for ($x=1; $x<=$num_rows; $x++)
  {
  			$row_items = array();
//3. Select the final reviewer entrys for the checklist with task_id equal to x
			$sqlsel2="SELECT * FROM model_creation_suite_has_final_reviewed_by_records WHERE model_id='$activeModelId' AND task_id='$x'";		//Select all 
			$rs2=$conn->query($sqlsel2);
			//echo mysqli_num_rows($rs2);
			if(mysqli_num_rows($rs2)>0){
//4. Add the final reviewer id and timestamp to the $row_items [] array	
				while ($items = $rs2->fetch_assoc()) {
							$returnFinalReviewer = stripslashes($items['final_reviewer_username']);
							$returnFinalReviewDate = stripslashes($items['final_review_date']);
					$row_items ['final_reviewer_username'] = $returnFinalReviewer;
					$row_items ['final_review_date'] = $returnFinalReviewDate;
					//$all_items [] = $items;
				}				
					//echo mysqli_num_rows($rs2);				
			}else{
					$row_items ['final_reviewer_username'] = null;
					$row_items ['final_review_date'] = null;				
			}
//3. Select the reviewer entrys for the checklist with task_id equal to x
			$sqlsel3="SELECT * FROM model_creation_suite_has_reviewed_by_records WHERE model_id='$activeModelId' AND task_id='$x'";		//Select all 
			$rs3=$conn->query($sqlsel3);
			//echo mysqli_num_rows($rs3);
			if(mysqli_num_rows($rs3)>0){
//4. Add the reviewer id and timestamp to the $row_items [] array	
				while ($items = $rs3->fetch_assoc()) {
							$returnReviewer = stripslashes($items['reviewer_username']);
							$returnReviewDate = stripslashes($items['review_date']);							
					$row_items ['reviewer_username'] = $returnReviewer;
					$row_items ['review_date'] = $returnReviewDate;
					//$all_items [] = $items;
				}
			}else{
					$row_items ['reviewer_username'] = null;
					$row_items ['review_date'] = null;
			}

//3. Select the preparer entrys for the checklist with task_id equal to x
			$sqlsel4="SELECT * FROM model_creation_suite_has_prepared_by_records WHERE model_id='$activeModelId' AND task_id='$x'";		//Select all 
			$rs4=$conn->query($sqlsel4);
			//echo mysqli_num_rows($rs4) . '<br>';
			if(mysqli_num_rows($rs4)>0){
				//echo mysqli_num_rows($rs4);				
//4. Add the preparer id and timestamp to the $row_items [] array	
				while ($items = $rs4->fetch_assoc()) {
							$returnPreparer = stripslashes($items['preparer_username']);
							$returnPreparedDate = stripslashes($items['prepared_date']);
					$row_items ['preparer_username'] = $returnPreparer;
					$row_items ['prepared_date'] = $returnPreparedDate;
					//$all_items [] = $items;
				}				
			}else{
					$row_items ['preparer_username'] = null;
					$row_items ['prepared_date'] = null;				
			}
//5. Select the appropriate row from the model_creation_suite table.
			$sqlsel5="SELECT * FROM model_creation_suite WHERE line_number='$x'";		//Select all 
			$rs5=$conn->query($sqlsel5);
			if(mysqli_num_rows($rs5)>0){
//				echo mysqli_num_rows($rs5);				
//6. Add the checklist line item to the $row_items [] array	
				while ($items = $rs5->fetch_assoc()) {
							$id = stripslashes($items['id']);
							$line_number = stripslashes($items['line_number']);
							$budgeted_hours = stripslashes($items['budgeted_hours']);
							$step_type = stripslashes($items['step_type']);
							$instruction_detail = stripslashes($items['instruction_detail']);
							$phase = stripslashes($items['phase']);
							$phase_id = stripslashes($items['phase_id']);
							$mfi_explanation_ref = stripslashes($items['mfi_explanation_ref']);
							$mfi_template_process_ref = stripslashes($items['mfi_template_process_ref']);
							$source_model_mfi_ref = stripslashes($items['source_model_mfi_ref']);
							$href = stripslashes($items['href']);
							$preparedBy_href = stripslashes($items['preparedBy_href']);
							$reviewedBy_href = stripslashes($items['reviewedBy_href']);
							$finalReviewedBy_href = stripslashes($items['finalReviewedBy_href']);
							$eventType = stripslashes($items['event_type']);

														
					$row_items ['id'] = $id;
					$row_items ['line_number'] = $line_number;
					$row_items ['budgeted_hours'] = $budgeted_hours;
					$row_items ['step_type'] = $step_type;
					$row_items ['instruction_detail'] = $instruction_detail;
					$row_items ['phase'] = $phase;
					$row_items ['phase_id'] = $phase_id;
					$row_items ['mfi_explanation_ref'] = $mfi_explanation_ref;
					$row_items ['mfi_template_process_ref'] = $mfi_template_process_ref;
					$row_items ['source_model_mfi_ref'] = $source_model_mfi_ref;				
					$row_items ['href'] = $href;
					$row_items ['preparedBy_href'] = $preparedBy_href;
					$row_items ['reviewedBy_href'] = $reviewedBy_href;
					$row_items ['finalReviewedBy_href'] = $finalReviewedBy_href;
					$row_items ['event_type'] = $eventType;

					//$all_items [] = $items;
// 6. Add the current $row_items[] array to the $all_items[] array.
					$all_items[] = $row_items;					
				}
			}else{
					$row_items ['id'] = null;
					$row_items ['line_number'] = null;
					$row_items ['budgeted_hours'] = null;
					$row_items ['step_type'] = null;
					$row_items ['instruction_detail'] = null;
					$row_items ['phase'] = null;
					$row_items ['phase_id'] = null;
					$row_items ['mfi_explanation_ref'] = null;
					$row_items ['mfi_template_process_ref'] = null;
					$row_items ['source_model_mfi_ref'] = null;				
					$row_items ['href'] = null;				
					$row_items ['preparedBy_href'] = null;				
					$row_items ['reviewedBy_href'] = null;				
					$row_items ['finalReviewedBy_href'] = null;				

			}

			//echo "The row is: $x <br>";
			//echo $_GET['callback'] . '(' . json_encode($all_items) . ')';				//Output $all_items array in json encoded format.
  } 
//6. JSONP packaged $all_items array
			echo $_GET['callback'] . '(' . json_encode($all_items) . ')';				//Output $all_items array in json encoded format.
	 