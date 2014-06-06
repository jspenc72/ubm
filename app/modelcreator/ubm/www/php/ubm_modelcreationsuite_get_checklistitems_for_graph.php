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
$pb_items = array();
$preparer_items = array(); //array where the count for completed items for each phase of the checklist is stored in the array
$reviewer_items = array(); //array where the count for completed items for each phase of the checklist is stored in the array
$final_reviewer_items = array(); //array where the count for completed items for each phase of the checklist is stored in the array
$MFIS_counter = 0;
$CS_counter = 0;
$P1_counter = 0;
$P2_counter = 0;
$P3_counter = 0;
$P4_counter = 0;
$P5_counter = 0;
$P6_counter = 0;
$P7_counter = 0;
$P8_counter = 0;
//. Select for the preparer entrys for the checklist for the active Model
			$sqlsel1="SELECT * 					
			FROM model_creation_suite_has_prepared_by_records  
			JOIN model_creation_suite 
			ON model_creation_suite_has_prepared_by_records.task_id=model_creation_suite.id
			WHERE model_creation_suite_has_prepared_by_records.model_id='$activeModelId'
			ORDER BY model_creation_suite.id";	
//. Select for the reviewer entrys for the checklist for the active Model
			$sqlsel2="SELECT * 					
			FROM model_creation_suite_has_reviewed_by_records  
			JOIN model_creation_suite 
			ON model_creation_suite_has_reviewed_by_records.task_id=model_creation_suite.id
			WHERE model_creation_suite_has_reviewed_by_records.model_id='$activeModelId'
			ORDER BY model_creation_suite.id";	
//. Select for the final reviewer entrys for the checklist for the active Model
			$sqlsel3="SELECT * 					
			FROM model_creation_suite_has_final_reviewed_by_records  
			JOIN model_creation_suite 
			ON model_creation_suite_has_final_reviewed_by_records.task_id=model_creation_suite.id
			WHERE model_creation_suite_has_final_reviewed_by_records.model_id='$activeModelId'
			ORDER BY model_creation_suite.id";	
//Select all
			$rs=$conn->query($sqlsel1);
			//echo mysqli_num_rows($rs2);
			if(mysqli_num_rows($rs)>0){
//4. Add the final reviewer id and timestamp to the $row_items [] array	
				while ($items = $rs->fetch_assoc()) {
					$returnPhaseId = stripslashes($items['phase_id']);											
					if($returnPhaseId=="MFIS"){
						$MFIS_counter++;
					}else{
						if($returnPhaseId=="CS"){
							$CS_counter++;
						}else{
							if($returnPhaseId=="P1"){
								$CS_counter++;
							}else{
								if($returnPhaseId=="P2"){
									$CS_counter++;
								}else{
									if($returnPhaseId=="P3"){
										$CS_counter++;
									}else{
										if($returnPhaseId=="P4"){
											$CS_counter++;
										}else{
											if($returnPhaseId=="P5"){
												$CS_counter++;
											}else{
												if($returnPhaseId=="P6"){
													$CS_counter++;
												}else{
													if($returnPhaseId=="P7"){
														$CS_counter++;
													}else{
														if($returnPhaseId=="P8"){
															$CS_counter++;
														}else{
															
														}														
													}													
												}												
											}
										}										
									}									
								}								
							}
						}
					}
					//$row_items ['final_reviewer_username'] = $returnFinalReviewer;								
				}				
			$pb_items["MFIS_count"] = "$MFIS_counter";
			$pb_items["CS_count"] = "$CS_counter";
			$pb_items["P1_count"] = "$P1_counter";
			$pb_items["P2_count"] = "$P2_counter";
			$pb_items["P3_count"] = "$P3_counter";
			$pb_items["P4_count"] = "$P4_counter";
			$pb_items["P5_count"] = "$P5_counter";
			$pb_items["P6_count"] = "$P6_counter";
			$pb_items["P7_count"] = "$P7_counter";
			$pb_items["P8_count"] = "$P8_counter";
			$all_items[] = $pb_items;
			//Prepared By Count for Phases 1 - 8	
			}else{
				$pb_items["MFIS_count"] = "0";
				$pb_items["CS_count"] = "0";
				$pb_items["P1_count"] = "0";
				$pb_items["P2_count"] = "0";
				$pb_items["P3_count"] = "0";
				$pb_items["P4_count"] = "0";
				$pb_items["P5_count"] = "0";
				$pb_items["P6_count"] = "0";
				$pb_items["P7_count"] = "0";
				$pb_items["P8_count"] = "0";
				$all_items[] = $pb_items;
			}
//Select all
			$rs1=$conn->query($sqlsel2);
			//echo mysqli_num_rows($rs2);
			if(mysqli_num_rows($rs1)>0){
				$MFIS_counter = 0;
				$CS_counter = 0;
				$P1_counter = 0;
				$P2_counter = 0;
				$P3_counter = 0;
				$P4_counter = 0;
				$P5_counter = 0;
				$P6_counter = 0;
				$P7_counter = 0;
				$P8_counter = 0;				
//4. Add the final reviewer id and timestamp to the $row_items [] array	
				while ($items = $rs1->fetch_assoc()) {
					$returnPhaseId = stripslashes($items['phase_id']);											
					if($returnPhaseId=="MFIS"){
						$MFIS_counter++;
					}else{
						if($returnPhaseId=="CS"){
							$CS_counter++;
						}else{
							if($returnPhaseId=="P1"){
								$CS_counter++;
							}else{
								if($returnPhaseId=="P2"){
									$CS_counter++;
								}else{
									if($returnPhaseId=="P3"){
										$CS_counter++;
									}else{
										if($returnPhaseId=="P4"){
											$CS_counter++;
										}else{
											if($returnPhaseId=="P5"){
												$CS_counter++;
											}else{
												if($returnPhaseId=="P6"){
													$CS_counter++;
												}else{
													if($returnPhaseId=="P7"){
														$CS_counter++;
													}else{
														if($returnPhaseId=="P8"){
															$CS_counter++;
														}else{
															
														}														
													}													
												}												
											}
										}										
									}									
								}								
							}
						}
					}
					//$row_items ['final_reviewer_username'] = $returnFinalReviewer;								
				}				
			$rb_items["MFIS_count"] = "$MFIS_counter";
			$rb_items["CS_count"] = "$CS_counter";
			$rb_items["P1_count"] = "$P1_counter";
			$rb_items["P2_count"] = "$P2_counter";
			$rb_items["P3_count"] = "$P3_counter";
			$rb_items["P4_count"] = "$P4_counter";
			$rb_items["P5_count"] = "$P5_counter";
			$rb_items["P6_count"] = "$P6_counter";
			$rb_items["P7_count"] = "$P7_counter";
			$rb_items["P8_count"] = "$P8_counter";
			$all_items[] = $rb_items;

			//Prepared By Count for Phases 1 - 8	
			}else{
			$rb_items["MFIS_count"] = "0";
			$rb_items["CS_count"] = "0";
			$rb_items["P1_count"] = "0";
			$rb_items["P2_count"] = "0";
			$rb_items["P3_count"] = "0";
			$rb_items["P4_count"] = "0";
			$rb_items["P5_count"] = "0";
			$rb_items["P6_count"] = "0";
			$rb_items["P7_count"] = "0";
			$rb_items["P8_count"] = "0";
			$all_items[] = $rb_items;

			}

//Select all
			$rs2=$conn->query($sqlsel3);
			//echo mysqli_num_rows($rs2);
			if(mysqli_num_rows($rs2)>0){
				$MFIS_counter = 0;
				$CS_counter = 0;
				$P1_counter = 0;
				$P2_counter = 0;
				$P3_counter = 0;
				$P4_counter = 0;
				$P5_counter = 0;
				$P6_counter = 0;
				$P7_counter = 0;
				$P8_counter = 0;				
				//4. Add the final reviewer id and timestamp to the $row_items [] array	
				while ($items = $rs2->fetch_assoc()) {
					$returnPhaseId = stripslashes($items['phase_id']);											
					if($returnPhaseId=="MFIS"){
						$MFIS_counter++;
					}else{
						if($returnPhaseId=="CS"){
							$CS_counter++;
						}else{
							if($returnPhaseId=="P1"){
								$CS_counter++;
							}else{
								if($returnPhaseId=="P2"){
									$CS_counter++;
								}else{
									if($returnPhaseId=="P3"){
										$CS_counter++;
									}else{
										if($returnPhaseId=="P4"){
											$CS_counter++;
										}else{
											if($returnPhaseId=="P5"){
												$CS_counter++;
											}else{
												if($returnPhaseId=="P6"){
													$CS_counter++;
												}else{
													if($returnPhaseId=="P7"){
														$CS_counter++;
													}else{
														if($returnPhaseId=="P8"){
															$CS_counter++;
														}else{
															
														}														
													}													
												}												
											}
										}										
									}									
								}								
							}
						}
					}
					//$row_items ['final_reviewer_username'] = $returnFinalReviewer;								
				}				
				$frb_items["MFIS_count"] = "$MFIS_counter";
				$frb_items["CS_count"] = "$CS_counter";
				$frb_items["P1_count"] = "$P1_counter";
				$frb_items["P2_count"] = "$P2_counter";
				$frb_items["P3_count"] = "$P3_counter";
				$frb_items["P4_count"] = "$P4_counter";
				$frb_items["P5_count"] = "$P5_counter";
				$frb_items["P6_count"] = "$P6_counter";
				$frb_items["P7_count"] = "$P7_counter";
				$frb_items["P8_count"] = "$P8_counter";
				$all_items[] = $frb_items;
			//Prepared By Count for Phases 1 - 8	
			}else{
				$frb_items["MFIS_count"] = "0";
				$frb_items["CS_count"] = "0";
				$frb_items["P1_count"] = "0";
				$frb_items["P2_count"] = "0";
				$frb_items["P3_count"] = "0";
				$frb_items["P4_count"] = "0";
				$frb_items["P5_count"] = "0";
				$frb_items["P6_count"] = "0";
				$frb_items["P7_count"] = "0";
				$frb_items["P8_count"] = "0";
				$all_items[] = $frb_items;

			}
					//Reviewed By Count for Phases 1 - 8
					//Final Reviewed By Count for Phases 1 - 8
//6. JSONP packaged $all_items array
			echo $_GET['callback'] . '(' . json_encode($all_items) . ')';				//Output $all_items array in json encoded format.
	 