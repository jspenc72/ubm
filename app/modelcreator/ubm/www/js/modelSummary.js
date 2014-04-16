
			function getModelSetupSummary(){
				$('#ubmsuite_mcs_model_review_ubm_modelSetup_ul').empty();
				$('#tab-1').show();	
				$('#tab-2').hide();	
				$('#tab-3').hide();	
				$('#tab-4').hide();	
				$('#tab-5').hide();	
				$('#tab-6').hide();	
				$.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_getCurrentModel_ModelSummary.php?callback=?', {//JSONP Request
					username : window.username,					
					key : window.key,
					activeModelUUID : window.activeModelUUID
				}, function(res, status) {
					$.each(res, function(i, item) {
						if(item.line_number == 1 && item.status == "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_modelSetup_ul').append("<li class='success'>" + item.instruction_detail + "<br>Completed By: " + item.preparer_username + "</li>");												
							
						}else if(item.line_number == 1 && item.status != "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_modelSetup_ul').append("<li class='warning'>Warning : <a href='#mcs_setup_1_popUp'>" + item.instruction_detail + "</a></li>");												
							
						}	
						if(item.task_id == 2 && item.status == "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_modelSetup_ul').append("<li class='success'>" + item.instruction_detail + "<br>Completed By: " + item.preparer_username + "</li>");												
							
						}else if(item.status != "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_modelSetup_ul').append("<li class='warning'>Warning : <a href='#mcs_UBMFlowchart'>" + item.instruction_detail + "</a></li>");												
							
						}
						if(item.task_id == 3 && item.status == "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_modelSetup_ul').append("<li class='success'>" + item.instruction_detail + "<br>Completed By: " + item.preparer_username + "</li>");												
							
						}else if(item.status != "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_modelSetup_ul').append("<li class='warning'>Warning : <a href='#mcs_setup_checklist_setup_userGuide_Popup'>" + item.instruction_detail + "</a></li>");												
							
						}
						if(item.task_id == 4 && item.status == "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_modelSetup_ul').append("<li class='success'>" + item.instruction_detail + "<br>Completed By: " + item.preparer_username + "</li>");												
							
						}else if(item.status != "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_modelSetup_ul').append("<li class='warning'>Warning : <a href='#mcs_setup_checklist_setup_identification_setup_popup'>" + item.instruction_detail + "</a></li>");												
							
						}
						if(item.task_id == 5 && item.status == "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_modelSetup_ul').append("<li class='success'>" + item.instruction_detail + "<br>Completed By: " + item.preparer_username + "</li>");												
							
						}else if(item.status != "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_modelSetup_ul').append("<li class='warning'>Warning : <a href='#gettingStarted'>" + item.instruction_detail + "</a></li>");												
							
						}
					});
				});
				
			}
		
		
			function getControlSummary(){
				$('#ubmsuite_mcs_model_review_ubm_control_ul').empty();		
				$('#tab-2').show();
				$('#tab-1').hide();	
				$('#tab-3').hide();	
				$('#tab-4').hide();	
				$('#tab-5').hide();	
				$('#tab-6').hide();											
				$.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_getCurrentModel_ModelSummary.php?callback=?', {//JSONP Request
					username : window.username,					
					key : window.key,
					activeModelUUID : window.activeModelUUID
				}, function(res, status) {
					$.each(res, function(i, item) {
						if(item.line_number == 8 && item.status == "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_control_ul').append("<li class='success'>" + item.instruction_detail + "<br>Completed By: " + item.preparer_username + "</li>");												
						}else if(item.line_number == 8 && !item.status){
							$('#ubmsuite_mcs_model_review_ubm_control_ul').append("<li class='warning'>Warning : <a href='#" + item.href + "'>" + item.instruction_detail + "</li>");												
						}	
						if(item.line_number == 9 && item.status == "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_control_ul').append("<li class='success'>" + item.instruction_detail + "<br>Completed By: " + item.preparer_username + "</li>");												
						}else if(item.line_number == 9 && !item.status){
							$('#ubmsuite_mcs_model_review_ubm_control_ul').append("<li class='warning'>Warning : <a href='#mcs_setup_checklist_setup_userGuide_Popup'>" + item.instruction_detail + "</a></li>");												
						}
						if(item.line_number == 10 && item.status == "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_control_ul').append("<li class='success'>" + item.instruction_detail + "<br>Completed By: " + item.preparer_username + "</li>");												
						}else if(item.line_number == 10 && item.status != "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_control_ul').append("<li class='warning'>Warning : <a href='#'>" + item.instruction_detail + "</a></li>");												
						}
						if(item.line_number == 11 && item.status == "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_control_ul').append("<li class='success'>" + item.instruction_detail + "<br>Completed By: " + item.preparer_username + "</li>");												
						}else if(item.line_number == 11 && item.status != "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_control_ul').append("<li class='warning'>Warning : <a href='#mcs_setup_checklist_setup_identification_setup_popup'>" + item.instruction_detail + "</a></li>");												
						}
					});
				});
				
			}
		
		
			function getPhase1Summary(){
				$('#ubmsuite_mcs_model_review_ubm_phase1_ul').empty();
				$('#tab-3').show();
				$('#tab-2').hide();	
				$('#tab-1').hide();	
				$('#tab-4').hide();	
				$('#tab-5').hide();	
				$('#tab-6').hide();										
				$.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_getCurrentModel_ModelSummary.php?callback=?', {//JSONP Request
					username : window.username,					
					key : window.key,
					activeModelUUID : window.activeModelUUID
				}, function(res, status) {
					$.each(res, function(i, item) {
						if(item.task_id == 15 && item.status == "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='success'>Placeholder. Completed By: " + item.preparer_username + "</li>");												
							
						}else if(item.status !="TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='warning'>Warning : <a href='#mcs_setup_1_popUp'>Placeholder</a></li>");												
							
						}	
						if(item.task_id == 16 && item.status == "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='success'>User Guide has been read. Completed By: " + item.preparer_username + "</li>");												
							
						}else if(item.status != "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='warning'>Warning : <a href='#mcs_setup_checklist_p1_userGuide_popup'>The User Guide for this section has not been read!</a></li>");												
							
						}
						if(item.task_id == 17 && item.status == "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='success'>Conceptual Definitions, Mission Statement and Vision Statement have been added. Completed By: " + item.preparer_username + "</li>");												
							
						}else if(item.status != "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='warning'>Warning : <a href='#mcs_setup_checklist_p1_primaryObjects_setup_popup'>Conceptual Definitions, Mission Statement and Vision Statement have not been added!</a></li>");												
							
						}
						if(item.task_id == 18 && item.status == "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='success'>Placeholder. Completed By: " + item.preparer_username + "</li>");												
							
						}else if(item.status != "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='warning'>Warning : <a href='#'>Placeholder!</a></li>");												
							
						}
						if(item.task_id == 19 && item.status == "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='success'>Placeholder. Completed By: " + item.preparer_username + "</li>");												
							
						}else if(item.status != "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='warning'>Warning : <a href='#'>Placeholder!</a></li>");												
							
						}
						if(item.task_id == 20 && item.status == "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='success'>Placeholder. Completed By: " + item.preparer_username + "</li>");												
							
						}else if(item.status != "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='warning'>Warning : <a href='#'>Placeholder!</a></li>");												
							
						}
					});
				});
				
			}
		
		
			function getPhase2Summary(){
				$('#ubmsuite_mcs_model_review_ubm_phase2_ul').empty();
				$('#tab-4').show();
				$('#tab-2').hide();	
				$('#tab-3').hide();	
				$('#tab-1').hide();	
				$('#tab-5').hide();	
				$('#tab-6').hide();											
				$.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_getCurrentModel_ModelSummary.php?callback=?', {//JSONP Request
					username : window.username,					
					key : window.key,
					activeModelUUID : window.activeModelUUID
				}, function(res, status) {
					$.each(res, function(i, item) {
						if(item.task_id == 25 && item.status == "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_phase2_ul').append("<li class='success'>Placeholder. Completed By: " + item.preparer_username + "</li>");												
							
						}else if(item.status != "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_phase2_ul').append("<li class='warning'>Warning : <a href='#'>Placeholder!</a></li>");												
							
						}	
						if(item.task_id == 26 && item.status == "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_phase2_ul').append("<li class='success'>User Guide has for this section has been read. Completed By: " + item.preparer_username + "</li>");												
							
						}else if(item.status != "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_phase2_ul').append("<li class='warning'>Warning : <a href='#mcs_setup_checklist_p2_userGuide_popup'>The user guide for thes section has not been read!</a></li>");												
							
						}
						if(item.task_id == 27 && item.status == "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_phase2_ul').append("<li class='success'>List of alternitives has been completed. Completed By: " + item.preparer_username + "</li>");												
							
						}else if(item.status != "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_phase2_ul').append("<li class='warning'>Warning : <a href='#possible_alternatives'>List of alternitives has not been completed!</a></li>");												
							
						}
						if(item.task_id == 28 && item.status == "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_phase2_ul').append("<li class='success'>Return on Investment Analysis form has been completed. Completed By: " + item.preparer_username + "</li>");												
							
						}else if(item.status != "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_phase2_ul').append("<li class='warning'>Warning : <a href='#return_on_investment'>Return on Investment Analysis form has not been completed</a></li>");												
							
						}
						if(item.task_id == 29 && item.status == "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_phase2_ul').append("<li class='success'>Risk Analysis marked as Use Now has been completed. Completed By: " + item.preparer_username + "</li>");												
							
						}else if(item.status != "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_phase2_ul').append("<li class='warning'>Warning : <a href='#risk_analysis'>Risk Analysis marked as Use Now has not been completed!</a></li>");												
							
						}
						if(item.task_id == 30 && item.status == "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_phase2_ul').append("<li class='success'>Placeholder. Completed By: " + item.preparer_username + "</li>");												
							
						}else if(item.status != "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_phase2_ul').append("<li class='warning'>Warning : <a href='#'>Placeholder!</a></li>");												
							
						}
					});
				});
				
			}
		
		
			function getPhase3Summary(){
				$('#ubmsuite_mcs_model_review_ubm_phase3_ul').empty();
				$('#tab-5').show();
				$('#tab-2').hide();	
				$('#tab-3').hide();	
				$('#tab-4').hide();	
				$('#tab-1').hide();	
				$('#tab-6').hide();											
				$.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_getCurrentModel_ModelSummary.php?callback=?', {//JSONP Request
					username : window.username,					
					key : window.key,
					activeModelUUID : window.activeModelUUID
				}, function(res, status) {
					$.each(res, function(i, item) {
						if(item.task_id == 34 && item.status == "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_phase3_ul').append("<li class='success'>Placeholder. Completed By: " + item.preparer_username + "</li>");												
							
						}else if(item.status !=  "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_phase3_ul').append("<li class='warning'>Warning : <a href='#'>Placeholder!</a></li>");												
							
						}	
						if(item.task_id == 35 && item.status == "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_phase3_ul').append("<li class='success'>User Guide for this phase has been read. Completed By: " + item.preparer_username + "</li>");												
							
						}else if(item.status != "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_phase3_ul').append("<li class='warning'>Warning : <a href='#mcs_UBMFlowchart'>User Guide for this phase has not been read!</a></li>");												
							
						}
						if(item.task_id == 36 && item.status == "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_phase3_ul').append("<li class='success'>Selected Alternatives form has been completed. Completed By: " + item.preparer_username + "</li>");												
							
						}else if(item.status != "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_phase3_ul').append("<li class='warning'>Warning : <a href='#'>Selected Alternatives form has not been completed!</a></li>");												
							
						}
						if(item.task_id == 37 && item.status == "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_phase3_ul').append("<li class='success'>Projected Financial Statement form has been completed. Completed By: " + item.preparer_username + "</li>");												
							
						}else if(item.status != "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_phase3_ul').append("<li class='warning'>Warning : <a href='#'>Projected Financial Statement form has not been completed!</a></li>");												
							
						}
						if(item.task_id == 38 && item.status == "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_phase3_ul').append("<li class='success'>Placeholder. Completed By: " + item.preparer_username + "</li>");												
							
						}else if(item.status != "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_phase3_ul').append("<li class='warning'>Warning : <a href='#'>Placeholder!</a></li>");												
							
						}
						if(item.task_id == 39 && item.status == "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_phase3_ul').append("<li class='success'>Strategic Alliances have been specified. Completed By: " + item.preparer_username + "</li>");												
							
						}else if(item.status != "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_phase3_ul').append("<li class='warning'>Warning : <a href='#'>Strategic Alliances have not been specified!</a></li>");												
							
						}
						if(item.task_id == 40 && item.status == "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_phase3_ul').append("<li class='success'>Placeholder. Completed By: " + item.preparer_username + "</li>");												
							
						}else if(item.status != "TRUE"){
							$('#ubmsuite_mcs_model_review_ubm_phase3_ul').append("<li class='warning'>Warning : <a href='#'>Placeholder!</a></li>");												
							
						}
					});
				});
				
			}
		
		
		// 	function getPhase4Summary(){
		// 		$('#ubmsuite_mcs_model_review_ubm_phase4_ul').empty();
		// 		$('#tab-6').show();
		// 		$('#tab-2').hide();	
		// 		$('#tab-3').hide();	
		// 		$('#tab-4').hide();	
		// 		$('#tab-5').hide();	
		// 		$('#tab-1').hide();												
		// 		$.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_getCurrentModel_ModelSummary.php?callback=?', {//JSONP Request
		// 			username : window.username,					
		// 			key : window.key,
		// 			activeModelUUID : window.activeModelUUID
		// 		}, function(res, status) {
		// 			$.each(res, function(i, item) {
		// 				if(item.task_id == 1 && item.status == "TRUE"){
		// 					$('#ubmsuite_mcs_model_review_ubm_phase4_ul').append("<li class='success'>License Agreement has been signed. Completed By: " + item.preparer_username + "</li>");												
							
		// 				}else if(item.status != "TRUE"){
		// 					$('#ubmsuite_mcs_model_review_ubm_phase4_ul').append("<li class='warning'>Warning : <a href='#mcs_setup_1_popUp'>License Agreement has not been signed!</a></li>");												
							
		// 				}	
		// 				if(item.task_id == 2 && item.status == "TRUE"){
		// 					$('#ubmsuite_mcs_model_review_ubm_phase4_ul').append("<li class='success'>Flow Chart has been carefully studied. Completed By: " + item.preparer_username + "</li>");												
							
		// 				}else if(item.status != "TRUE"){
		// 					$('#ubmsuite_mcs_model_review_ubm_phase4_ul').append("<li class='warning'>Warning : <a href='#mcs_UBMFlowchart'>The Flow Chart has not been studied!</a></li>");												
							
		// 				}
		// 				if(item.task_id == 3 && item.status == "TRUE"){
		// 					$('#ubmsuite_mcs_model_review_ubm_phase4_ul').append("<li class='success'>User Guide for this section has been read. Completed By: " + item.preparer_username + "</li>");												
							
		// 				}else if(item.status != "TRUE"){
		// 					$('#ubmsuite_mcs_model_review_ubm_phase4_ul').append("<li class='warning'>Warning : <a href='#mcs_setup_checklist_setup_userGuide_Popup'>The User Guide has not been read for this section!</a></li>");												
							
		// 				}
		// 				if(item.task_id == 4 && item.status == "TRUE"){
		// 					$('#ubmsuite_mcs_model_review_ubm_phase4_ul').append("<li class='success'>Identification Setup has been completed. Completed By: " + item.preparer_username + "</li>");												
							
		// 				}else if(item.status != "TRUE"){
		// 					$('#ubmsuite_mcs_model_review_ubm_phase4_ul').append("<li class='warning'>Warning : <a href='#mcs_setup_checklist_setup_identification_setup_popup'>Identification Setup has not been completed!</a></li>");												
							
		// 				}
		// 				if(item.task_id == 5 && item.status == "TRUE"){
		// 					$('#ubmsuite_mcs_model_review_ubm_phase4_ul').append("<li class='success'>The Getting Started page has been read. Completed By: " + item.preparer_username + "</li>");												
							
		// 				}else if(item.status != "TRUE"){
		// 					$('#ubmsuite_mcs_model_review_ubm_phase4_ul').append("<li class='warning'>Warning : <a href='#gettingStarted'>The Getting Started page has not been read!</a></li>");												
							
		// 				}
		// 			});
		// 		});
				
		// 	}
		
		<!-- Model Summary -->