
				function checkConnection() {
					var networkState = navigator.connection.type;
					var states = {};
					states[Connection.UNKNOWN] = 'Unknown connection';
					states[Connection.ETHERNET] = 'Ethernet connection';
					states[Connection.WIFI] = 'WiFi connection';
					states[Connection.CELL_2G] = 'Cell 2G connection';
					states[Connection.CELL_3G] = 'Cell 3G connection';
					states[Connection.CELL_4G] = 'Cell 4G connection';
					states[Connection.CELL] = 'Cell generic connection';
					states[Connection.NONE] = 'No network connection';
			
					//alert('Connection type: ' + states[networkState]);
					if (states[networkState] == 'Unknown connection') {
						//alert("Network status: "+states[networkState]);
						$(".unknownnetwork").css("visibility", "visible");
					} else {
						$(".unknownnetwork").css("visibility", "hidden");
					}
					if (states[networkState] == 'No network connection') {
						alert("Network status: " + states[networkState]);
						$(".offline").css("visibility", "visible");
					} else {
						$(".offline").css("visibility", "hidden");
					}
				}
				$(document).on("pageshow", "#ubmsuite_modelDashboard", function() {
					setTimeout(function() {
						getModelCreationSuiteChecklistItems();
	
					}, 100);
					setTimeout(function() {					
						getMyModelsCoreValues();
						getMyModelsCustomers();
						getMyModelsProducts();
						
						
						getListofPossibleCoreValues();
						getListofPossibleCustomers();
						getListofPossibleProducts();
					}, 2000);
					setTimeout(function() {
						getMyModelsServices();
						getMyModelsPhysicalFacilities();
						getMyModelsStrategicAlliances();
						getMyModelsStrategicPositioningQuestions();
						getMyModelsFeatures();
						getMyModelsOrganizationalStructures();
						
						getListofPossibleServices();
						getListofPossiblePhysicalFacilities();
						getListofPossibleStrategicAlliances();
						getListofPossibleStrategicPositioningQuestions();
						getListofPossibleFeatures();
						getListofPossibleOrganizationalStructures();
					}, 2000);
				});
				$(document).on("pageshow", "#ubmsuite_sharedModelDashboard", function() {
					setTimeout(function() {
						getModelCreationSuiteChecklistItems();
	
					}, 100);
					setTimeout(function() {					
						getMyModelsCoreValues();
						getMyModelsCustomers();
						getMyModelsProducts();
						
						
						getListofPossibleCoreValues();
						getListofPossibleCustomers();
						getListofPossibleProducts();
					}, 2000);
					setTimeout(function() {
						getMyModelsServices();
						getMyModelsPhysicalFacilities();
						getMyModelsStrategicAlliances();
						getMyModelsStrategicPositioningQuestions();
						getMyModelsFeatures();
						getMyModelsOrganizationalStructures();
						
						getListofPossibleServices();
						getListofPossiblePhysicalFacilities();
						getListofPossibleStrategicAlliances();
						getListofPossibleStrategicPositioningQuestions();
						getListofPossibleFeatures();
						getListofPossibleOrganizationalStructures();
					}, 2000);
				});
				$(document).on("pageshow", "#ubmsuite_SelectBusinessModel", function() {
					setTimeout(function() {
						getMyModels();
						getSharedModels();
						while (window.globalCounter == 0) {
							greetUser();
							window.globalCounter++;
						}
					}, 1000);
				});
				
				$(document).on("pageshow", "#return_on_investment", function() {
					getListofAlternativesforReturnOnInvestment();
					$("#return_on_investment_alternative_select_menu").bind( "change", function(event, ui) {
					  window.activeModelAlternativeId = $( "#return_on_investment_alternative_select_menu option:selected" ).val();
					  setTimeout(function(){
					  	getAlternativesInvestments();
					  }, 500);
					});
					$("#return_on_investment_alternative_select_investment_menu").bind( "change", function(event, ui) {
					window.activeModelInvestmentId = $("#return_on_investment_alternative_select_investment_menu option:selected").val();
					setTimeout(function() {
						getActiveInvestmentIncomeDrivers();
						getActiveInvestmentCostDrivers();
					}, 500);
					});
				});
				$(document).on("pageshow", "#ubmsuite_mcs_model_review", function() {
					getModelSetupSummary(2);
				});
				$(document).on("pageshow", "#ubmsuite_mcs_master_file_index", function() {
				    getMasterFileIndexItems();
                    setTimeout(function() {
                        
                    }, 1000);
                });
                $(document).on("pageshow", "#open_points_action_items", function() {
                    setTimeout(function() {
						refreshOpenItemsList();
                    }, 1000);
                });
                $(document).on("pageshow", "#mcs_setup_checklist_p4_b1", function() {
						fillTodaysDate();
				});
				$(document).on("pageshow", "#ubmsuite_mcs_management_reporting", function() {
						getMyModelsPositions();
				});
				$(document).on("pageshow", "#ubmsuite_swotAnalysis", function() {
					$('area').on('click', function() {
						if ($(this).attr('title') == 'strength') {
							$("#ubmsuite_swotAnalysis_add_strength_popup").popup("open");
						}
						if ($(this).attr('title') == 'weakness') {
							$("#ubmsuite_swotAnalysis_add_weakness_popup").popup("open");
						}
						if ($(this).attr('title') == 'opportunity') {
							$("#ubmsuite_swotAnalysis_add_opportunity_popup").popup("open");
						}
						if ($(this).attr('title') == 'threat') {
							$("#ubmsuite_swotAnalysis_add_threat_popup").popup("open");
						}
					});				
				});									
                $(document).on("pageshow", "#risk_analysis", function() {
                	//var value =$( "#risk_analysis_alternative_select_menu option:selected" ).text();							
					$("#risk_analysis_alternative_select_menu").bind( "change", function(event, ui) {
					  window.activeModelAlternativeId = $( "#risk_analysis_alternative_select_menu option:selected" ).val();
					  setTimeout(function(){
					  	getListofRisksforRiskAnalysisTable();
					  }, 1000);
					});       
					          	
                	
                    setTimeout(function() {
						getListofRisksforSearchBars();
						getListofAlternativesforRiskAnalysis();
						getListofRisksforRiskAnalysisTable();
                    }, 10);
                });

                $(document).on("pageshow", "#AdminSignIn_dialog", function() {
                	$('#ok_admin_button').focus();
                });
				$(document).on("pageshow", "#ubmsuite_mcs_my_organizational_chart", function() {
					//initializeTooltipsterItem();
					/*** /$( "#heirarchyObjectTree_container_frame" ).draggable().resizable({
				      maxHeight: 550,
				      maxWidth: $( window ).width()*2,
				      minHeight: 250,
				      minWidth: 200
				    });/***/
	                   $( "#ubmsuite_mcs_my_organizational_chart_content_managePolicyPopUp" ).draggable();
	                   $( "#ubmsuite_mcs_my_organizational_chart_content_manageProcedurePopUp" ).draggable();
	                   $( "#ubmsuite_mcs_my_organizational_chart_content_manageJobDescriptionPopUp" ).draggable();
	                   $( "#ubmsuite_mcs_my_organizational_chart_content_manageStepPopUp" ).draggable();
	                   $( "#ubmsuite_mcs_my_organizational_chart_content_manageTask" ).draggable();
					$('#chart').empty();
			        getMyModelsOrgChart();	
			        getObjectsforBackboneTable();
				});
				$(document).on("pageshow", "#possible_alternatives", function() {
					getMyModelsListofAlternatives();
					getActiveAlternativeListofPros();
					getActiveAlternativeListofCons();
				});
				$(document).on("pageshow", "#ubmsuite_mcs_position_strategic_command_center", function() {

						var date = new Date();
						var d = date.getDate();
						var m = date.getMonth();
						var y = date.getFullYear();
						
						$('#calendar').fullCalendar({
							header: {
								left: 'prev,next today',
								center: 'title',
								right: 'month,agendaWeek,agendaDay'
							},
							editable: true,
							events: [
								{
									title: 'All Day Event',
									start: new Date(y, m, 1)
								},
								{
									title: 'Long Event',
									start: new Date(y, m, d-5),
									end: new Date(y, m, d-2)
								},
								{
									id: 999,
									title: 'Repeating Event',
									start: new Date(y, m, d-3, 16, 0),
									allDay: false
								},
								{
									id: 999,
									title: 'Repeating Event',
									start: new Date(y, m, d+4, 16, 0),
									allDay: false
								},
								{
									title: 'Meeting',
									start: new Date(y, m, d, 10, 30),
									allDay: false
								},
								{
									title: 'Lunch',
									start: new Date(y, m, d, 12, 0),
									end: new Date(y, m, d, 14, 0),
									allDay: false
								},
								{
									title: 'Birthday Party',
									start: new Date(y, m, d+1, 19, 0),
									end: new Date(y, m, d+1, 22, 30),
									allDay: false
								},
								{
									title: 'Click for Google',
									start: new Date(y, m, 28),
									end: new Date(y, m, 29),
									url: 'http://google.com/'
								}
							]
						});
				});
				$(document).on("pagehide", "#ubmsuite_mcs_position_strategic_command_center", function() {
					$("#calendar").empty()
				});
				$(document).on("pageshow", "#ubmsuite_mcs_my_applications", function() {
					getMyModelsListofApplications();
				});
				$(document).on("pagehide", "#projected_financial_statement", function() {
					$("#projected_financial_statement_iframe_container").empty()
				});
				$(document).on("pageshow", "#projected_financial_statement", function() {
					//1. Load the iframe with src directed to the application on Bluehost, Pass the active model id to the iframe. When the Page Loads
						showLoader();
				    	$('iframe').remove();
						$('<iframe id="projected_financial_statement_iframe" src="http://application.universalbusinessmodel.com/P3/?activeModelUUID=' + window.activeModelUUID + '&username='+ window.username +'" width="100%" height="700px" seamless=""></iframe>').appendTo('#projected_financial_statement_iframe_container');		
						setTimeout(function() {					
							hideLoader();
						}, 2000);
					//2. Reload the iframe with src directed to the application on Bluehost, Pass the active model id to the iframe. When the something inside the iframe container but outside the iframe is clicked.
					$('#projected_financial_statement_iframe_container').on('click', function(){
						showLoader();
				    	$('iframe').remove();
						$('<iframe id="projected_financial_statement_iframe" src="http://application.universalbusinessmodel.com/P3/?activeModelUUID=' + window.activeModelUUID + '&username='+ window.username +'" width="100%" height="700px" seamless=""></iframe>').appendTo('#projected_financial_statement_iframe_container');		
						setTimeout(function() {					
							hideLoader();
						}, 2000);						
					});
				});
				$('.currency').keyup(function () {
					 //alert('test'); 
					 $('.currency').currency();
				});
				$(document).on("pageshow", "#ubmsuite_modelSettings", function() {
					model_getuserswithaccess();
					setTimeout(function() {
						$('#tiles').trigger('refreshWookmark');	//Layout items in Wookmark Grid
					    $( "#ubmsuite_modelSettings_createProduct_popup" ).draggable({ handle: "h1" });
					    $( "#ubmsuite_modelSettings_createFeature_popup_form" ).draggable({ handle: "h1" });
					    $( "#ubmsuite_modelSettings_createStrategicPositioningQuestion_popup" ).draggable({ handle: "h1" });
					    $( "#ubmsuite_modelSettings_createStrategicAlliance_popup" ).draggable({ handle: "h1" });
					    $( "#ubmsuite_modelSettings_createPhysicalFacility_popup" ).draggable({ handle: "h1" });
					    $( "#ubmsuite_modelSettings_createOrganizationalStructure_popup" ).draggable({ handle: "h1" });
					    $( "#ubmsuite_modelSettings_createCoreValue_popup" ).draggable({ handle: "h1" });
					    $( "#ubmsuite_modelSettings_createService_popup" ).draggable({ handle: "h1" });
					    $( "#ubmsuite_modelSettings_createCustomer_popup" ).draggable({ handle: "h1" });											
						$( "#ubmsuite_modelSettings_coreValues_popup" ).draggable({ handle: "h1" });
						$( "#ubmsuite_modelSettings_customers_popup" ).draggable({ handle: "h1" });
						$( "#ubmsuite_modelSettings_products_popup" ).draggable({ handle: "h1" });
						$( "#ubmsuite_modelSettings_services_popup" ).draggable({ handle: "h1" });
						$( "#ubmsuite_modelSettings_organizationalstructure_popup" ).draggable({ handle: "h1" });
						$( "#ubmsuite_modelSettings_physicalfacilities_popup" ).draggable({ handle: "h1" });
						$( "#ubmsuite_modelSettings_strategicalliances_popup" ).draggable({ handle: "h1" });
						$( "#ubmsuite_modelSettings_strategicpositioningquestions_popup" ).draggable({ handle: "h1" });
						$( "#ubmsuite_modelSettings_features_popup" ).draggable({ handle: "h1" });
						$( "#ubmsuite_modelSettings_requestedapplications_popup" ).draggable({ handle: "h1" });
					}, 2000);
					setTimeout(function() {					
						getMyModelsCoreValues();
						getMyModelsCustomers();
						getMyModelsProducts();
						
						
						getListofPossibleCoreValues();
						getListofPossibleCustomers();
						getListofPossibleProducts();
					}, 2000);
					setTimeout(function() {
						getMyModelsServices();
						getMyModelsPhysicalFacilities();
						getMyModelsStrategicAlliances();
						getMyModelsStrategicPositioningQuestions();
						getMyModelsFeatures();
						getMyModelsOrganizationalStructures();
						
						getListofPossibleServices();
						getListofPossiblePhysicalFacilities();
						getListofPossibleStrategicAlliances();
						getListofPossibleStrategicPositioningQuestions();
						getListofPossibleFeatures();
						getListofPossibleOrganizationalStructures();
					}, 2000);
				});
				$(document).on("pageshow", ".ubm_page", function() {
					PieMenuInit();
					setTimeout(function() {
						$( ".draggable" ).draggable();
						$( ".draggable_popup" ).draggable({ handle: "h1" });
	                    $( "#sign_in_sign_up_openItem_popup" ).draggable({ handle: "h1" });
	                    $( "#mcs_setup_checklist_p2_openItem_popup" ).draggable({ handle: "h1" });
	                    $( "#ubmsuite_SelectBusinessModel_openItem_popup" ).draggable({ handle: "h1" });
	                    $( "#ubmsuite_table_of_contents_openItem_popup" ).draggable({ handle: "h1" });
	                    $( "#ubmsuite_modelDashboard_openItem_popup" ).draggable({ handle: "h1" });
	                    $( "#ubmsuite_sharedModelDashboard_openItem_popup" ).draggable({ handle: "h1" });
	                    $( "#gettingStarted_openItem_popup" ).draggable({ handle: "h1" });
	                    $( "#ubmsuite_modelSettings_openItem_popup" ).draggable({ handle: "h1" });
	                    $( "#ubmsuite_modelSettings_shareModel_popup" ).draggable({ handle: "h1" });
	                    $( "#mcs_setup_checklist_setup_openItem_popup" ).draggable({ handle: "h1" });
	                    $( "#mcs_setup_checklist_CS_openItem_popup" ).draggable({ handle: "h1" });
	                    $( "#mcs_setup_checklist_p1_userGuide_popup" ).draggable({ handle: "h1" });
	                    $( "#mcs_setup_checklist_p1_openItem_popup" ).draggable({ handle: "h1" });
	                    $( "#mcs_setup_checklist_p2_userGuide_popup" ).draggable({ handle: "h1" });
	                    $( "#mcs_setup_checklist_p3_userGuide_popup" ).draggable({ handle: "h1" });
	                    $( "#mcs_setup_checklist_p3_openItem_popup" ).draggable({ handle: "h1" });
	                    $( "#mcs_setup_checklist_p4_b1_userGuide_popup" ).draggable({ handle: "h1" });
	                    $( "#mcs_setup_checklist_p4_b1_openItem_popup" ).draggable({ handle: "h1" });
	                    $( "#mcs_setup_checklist_p4_b2_userGuide_popup" ).draggable({ handle: "h1" });
	                    $( "#mcs_setup_checklist_p4_b2_openItem_popup" ).draggable({ handle: "h1" });
	                    $( "#mcs_setup_checklist_p4_b3_userGuide_popup" ).draggable({ handle: "h1" });
	                    $( "#mcs_setup_checklist_p4_b3_openItem_popup" ).draggable({ handle: "h1" });
	                    $( "#mcs_setup_checklist_p4_b4_userGuide_popup" ).draggable({ handle: "h1" });
	                    $( "#mcs_setup_checklist_p4_b4_openItem_popup" ).draggable({ handle: "h1" });
	                    $( "#mcs_setup_checklist_p4_b5_userGuide_popup" ).draggable({ handle: "h1" });
	                    $( "#mcs_setup_checklist_p4_b5_openItem_popup" ).draggable({ handle: "h1" });
	                    $( "#mcs_setup_checklist_p4_b6_userGuide_popup" ).draggable({ handle: "h1" });
	                    $( "#mcs_setup_checklist_p4_b6_openItem_popup" ).draggable({ handle: "h1" });
	                    $( "#mcs_setup_checklist_p4_b7_userGuide_popup" ).draggable({ handle: "h1" });
	                    $( "#mcs_setup_checklist_p4_b7_openItem_popup" ).draggable({ handle: "h1" });
	                    $( "#mcs_setup_checklist_p4_b8_userGuide_popup" ).draggable({ handle: "h1" });
	                    $( "#mcs_setup_checklist_p4_b8_openItem_popup" ).draggable({ handle: "h1" });
	                    $( "#mcs_setup_checklist_p4_b9_userGuide_popup" ).draggable({ handle: "h1" });
	                    $( "#mcs_setup_checklist_p4_b9_openItem_popup" ).draggable({ handle: "h1" });	                    
	                    $( "#mcs_setup_checklist_p4_b10_userGuide_popup" ).draggable({ handle: "h1" });
	                    $( "#mcs_setup_checklist_p4_b10_openItem_popup" ).draggable({ handle: "h1" });	                    
	                    $( "#mcs_setup_checklist_p4_b11_userGuide_popup" ).draggable({ handle: "h1" });
	                    $( "#mcs_setup_checklist_p4_b11_openItem_popup" ).draggable({ handle: "h1" });	                    	                    	                    
	                    $( "#mcs_setup_checklist_p4_b12_userGuide_popup" ).draggable({ handle: "h1" });
	                    $( "#mcs_setup_checklist_p4_b12_openItem_popup" ).draggable({ handle: "h1" });
	                    $( "#mcs_setup_checklist_p5_userGuide_popup" ).draggable({ handle: "h1" });
	                    $( "#mcs_setup_checklist_p5_openItem_popup" ).draggable({ handle: "h1" });
	                    $( "#mcs_setup_checklist_p6_userGuide_popup" ).draggable({ handle: "h1" });
	                    $( "#mcs_setup_checklist_p6_openItem_popup" ).draggable({ handle: "h1" });
	                    $( "#mcs_setup_checklist_p7_openItem_popup" ).draggable({ handle: "h1" });
	                    $( "#mcs_setup_checklist_p7_openItem_popup" ).draggable({ handle: "h1" });
	                    $( "#mcs_setup_checklist_p8_userGuide_popup" ).draggable({ handle: "h1" });
	                    $( "#mcs_setup_checklist_p8_openItem_popup" ).draggable({ handle: "h1" });
	                    $( "#open_points_action_items_openItem_popup" ).draggable({ handle: "h1" });
	                    $( "#mcs_setup_checklist_p4_b1_NewBusinessAccount_popup" ).draggable({ handle: "h1" });
	                    $( "#ubmsuite_mcs_my_organizational_chart_content_modifyPositionPopUp" ).draggable({ handle: "h1" });

                    }, 2000);
					//alert(window.activeubm_page);
					$.getJSON('http://api.universalbusinessmodel.com/ubm_get_page_ref.php?callback=?', {//JSONP Request to Open Items Page setup tables
						activeubm_page : window.activeubm_page
					}, function(res, status) {
						$.each(res, function(i, item) {
							//alert(item.headerRecord_right_formref);
							$('#headerRecord_right_formref').empty();
							$('#headerRecord_right_formref').append(item.headerRecord_right_formref);
							window.activeUbmPageReference = item.headerRecord_right_formref;
						})
						//alert("jsonp request returned: " + status);
					});
	                                    
					setTimeout(function() {
					    
						checkConnection();
					}, 3000);
				});
				app.initialize();