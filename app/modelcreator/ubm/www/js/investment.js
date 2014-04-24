
			function createNewCostDriver () {
				//alert(window.activeModelInvestmentId);
				$.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_investment_create_CostDriver.php?callback=?', {//JSONP Request to Open Items Page setup tables
					key : window.key,
					activeInvestmentId : window.activeModelInvestmentId,
					username : window.username,
					costPerUnit : document.getElementById("return_on_investment_createNewCostDriver_popup_form_CostperUnit").value,
					description : document.getElementById("return_on_investment_createNewCostDriver_popup_form_description").value,
					numberOfUnits : document.getElementById("return_on_investment_createNewCostDriver_popup_form_numberOfUnits").value
				}, function(res, status) {
					$().toastmessage('showNoticeToast', res.message);
					$("#return_on_investment_createNewCostDriver_popup").popup("close");
					$("#return_on_investment_createNewCostDriver_popup_form").each(function() {
						this.reset();
					});
					if (status == "success") {
						getActiveInvestmentCostDrivers();
					} else {
						setTimeout(function() {
							getActiveInvestmentCostDrivers();
						}, 2000);
					}
				});	
			}
			function createNewIncomeDriver () {
				$.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_investment_create_IncomeDriver.php?callback=?', {//JSONP Request to Open Items Page setup tables
					key : window.key,
					activeInvestmentId : window.activeModelInvestmentId,
					username : window.username,
					incomePerUnit : document.getElementById("return_on_investment_createNewIncomeDriver_popup_form_IncomePerUnit").value,
					description : document.getElementById("return_on_investment_createNewIncomeDriver_popup_form_description").value,
					numberOfUnits : document.getElementById("return_on_investment_createNewIncomeDriver_popup_form_numberOfUnits").value
				}, function(res, status) {
					$().toastmessage('showNoticeToast', res.message);
					$("#return_on_investment_createNewIncomeDriver_popup").popup("close");
					$("#return_on_investment_createNewIncomeDriver_popup_form").each(function() {
						this.reset();
					});
					if (status == "success") {
						getActiveInvestmentIncomeDrivers();
					} else {
						setTimeout(function() {
							getActiveInvestmentIncomeDrivers();
						}, 2000);
					}
				});		
			}
			// function getActiveInvestmentCostDrivers () {
			// 	showLoader();
			// 	//alert(window.activeModelInvestmentId);
			// 	$('#return_on_investment_input_form_cost_tbody').empty();
			// 	$.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_investment_get_CostDrivers.php?callback=?', {//JSONP Request to Open Items Page setup tables
			// 		key : window.key,
			// 		activeModelInvestmentId : window.activeModelInvestmentId
			// 	}, function(res, status) {
			// 		$.each(res, function(i, item) {
			// 			$('#return_on_investment_input_form_cost_tbody').append("<tr><td><a href='#' onclick='removeCostFromInvestment(" + item.cost_driver_id + ")'><span class='trashico'></span></a></td><td><input value='" + item.description + "' name='return_on_investment_costDescription_form' id='return_on_investment_costDescription_form' placeholder='Cost Driver Description...'><td><input name='return_on_investment_costPerUnit_form' id='return_on_investment_costPerUnit_form' class='costperunit_col_num col_num' placeholder='Cost Per Unit...' value='" + item.cost_per_unit + "'></td><td><input name='return_on_investment_costNumberOfUnits_form' id='return_on_investment_numberOfUnits_form' placeholder='# of Units...' class='numunits_col_num col_num' value='" + item.number_of_units + "'></td><td class='totalcost_col_num'></td><td><button class='return_on_investment_cost_table_form_submit_button'>Update Cost Driver</button></td></tr>");	

			// 			$("#return_on_investment_input_form_cost_tbody").trigger("create");
			// 		});
			// 	}); 
			// 	setTimeout(function() {
			// 	    $(".col_num").each(function() {				
			// 	        $(this).keyup(function(){				//Call the newCalculatedCostDriver function each time a keystroke is activated in any of the inputs with col_num as the class.
			// 	            newCalculatedCostDriver.call(this);
			// 	        });
			// 	    });
			// 		hideLoader();
			// 	}, 2000);
			// }
			// function getActiveInvestmentIncomeDrivers () {
			// 	showLoader();
			// 	//alert(window.activeModelInvestmentId);
			// 	$('#return_on_investment_input_form_income_tbody').empty();
			// 	$.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_investment_get_IncomeDrivers.php?callback=?', {//JSONP Request to Open Items Page setup tables
			// 		key : window.key,
			// 		activeModelInvestmentId : window.activeModelInvestmentId
			// 	}, function(res, status) {
			// 		$.each(res, function(i, item) {
			// 			$('#return_on_investment_input_form_income_tbody').append("<tr><td><a href='#' onclick='removeIncomeFromInvestment(" + item.income_driver_id + ")'><span class='trashico'></span></a></td><td><input value='" + item.description + "' name='return_on_investment_incomeDescription_form' id='return_on_investment_incomeDescription_form' placeholder='Income Driver Description...' value='" + item.description + "' ></td><td><input name='return_on_investment_incomePerUnit_form' id='return_on_investment_incomePerUnit_form' class='incomeperunit_col_num col_num' placeholder='Income Per Unit...' value='" + item.income_per_unit + "'></td><td><input  name='return_on_investment_incomeNumberOfUnits_form' id='return_on_investment_incomeNumberOfUnits_form' class='numunits_col_num col_num' placeholder='# of Units...' value='" + item.number_of_units + "'></td><td class='totalincome_col_num'></td><td><button class='return_on_investment_income_table_form_submit_button'>Update Income Driver</button></td></tr>");							
			// 			$("#return_on_investment_input_form_income_tbody").trigger("create");

			// 		});
			// 	});
			// 		setTimeout(function() {
			// 		    $(".col_num").each(function() {				
			// 		        $(this).keyup(function(){				//Call the newCalculatedCostDriver function each time a keystroke is activated in any of the inputs with col_num as the class.
			// 		            newCalculatedIncomeDriver.call(this);
			// 		        });
			// 		    });
			// 			hideLoader();
			// 		}, 2000);
			// }


			function getActiveInvestmentCostDrivers () {
				showLoader();
				$('#return_on_investment_input_cost_tbody').empty();
				$.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_investment_get_CostDrivers.php?callback=?', {//JSONP Request to Open Items Page setup tables
					key : window.key,
					activeModelInvestmentId : window.activeModelInvestmentId
				}, function(res, status) {
					$.each(res, function(i, item) {
						$('#return_on_investment_input_cost_tbody').append("<tr><td><a href='#' onclick='removeCostFromInvestment(" + item.cost_driver_id + ")'><span class='trashico'></span></a></td><td><input value='" + item.description + "' id='return_on_investment_costDescription' placeholder='Cost Driver Description...'><td><input name='return_on_investment_costPerUnit_form' id='return_on_investment_costPerUnit_form' class='costperunit_col_num col_num' placeholder='Cost Per Unit...' value='" + item.cost_per_unit + "'></td><td><input name='return_on_investment_costNumberOfUnits' id='return_on_investment_numberOfUnits' placeholder='# of Units...' class='numunits_col_num col_num' value='" + item.number_of_units + "'></td><td class='totalcost_col_num'></td><td><button class='return_on_investment_cost_table_submit_button'>Update Cost Driver</button></td></tr>");	

						$("#return_on_investment_input_cost_tbody").trigger("create");
					});
				});	
				hideLoader();
			}

			function getActiveInvestmentIncomeDrivers () {
				showLoader();
				$('#return_on_investment_input_income_tbody').empty();
				$.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_investment_get_IncomeDrivers.php?callback=?', {//JSONP Request to Open Items Page setup tables
					key : window.key,
					activeModelInvestmentId : window.activeModelInvestmentId
				}, function(res, status) {
					$.each(res, function(i, item) {
						$('#return_on_investment_input_income_tbody').append("<tr><td><a href='#' onclick='removeIncomeFromInvestment(" + item.income_driver_id + ")'><span class='trashico'></span></a></td><td><input value='" + item.description + "' id='return_on_investment_incomeDescription' placeholder='Income Driver Description...'><td><input name='return_on_investment_incomePerUnit_form' id='return_on_investment_incomePerUnit_form' class='incomeperunit_col_num col_num' placeholder='Income Per Unit...' value='" + item.income_per_unit + "'></td><td><input name='return_on_investment_costNumberOfUnits' id='return_on_investment_numberOfUnits' placeholder='# of Units...' class='numunits_col_num col_num' value='" + item.number_of_units + "'></td><td class='totalcost_col_num'></td><td><button class='return_on_investment_income_table_submit_button'>Update Income Driver</button></td></tr>");	

						$("#return_on_investment_input_income_tbody").trigger("create");
					});
				});	
				hideLoader();
			}

			function createNewInvestment () {
				//alert("was called");
				$.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_alternative_create_Investment.php?callback=?', {//JSONP Request to Open Items Page setup tables
					key : window.key,
					username: window.username,
					activeModelAlternativeId : window.activeModelUUID,
					title: document.getElementById("return_on_investment_createNewInvestment_popup_form_title").value,
					description: document.getElementById("return_on_investment_createNewInvestment_popup_form_description").value,
					type: document.getElementById("return_on_investment_createNewInvestment_popup_form_type").value
				}, function(res, status) {
					$().toastmessage('showNoticeToast', res.message);
					$("#return_on_investment_createNewInvestment_popup").popup("close");
					$("#return_on_investment_createNewInvestment_popup_form").each(function() {
						this.reset();
					});
					if (status == "success") {
						getAlternativesInvestments();
					} else {
						setTimeout(function() {
						getAlternativesInvestments();
						}, 2000);
					}
				});	
			}
		function fixit () {
			alert("test");
        	alert(window.username);
        	alert(window.activeModelUUID);
        }	
			function getAlternativesInvestments () {
				var c = 0;
				//alert(window.activeModelAlternativeId);
				$('#return_on_investment_alternative_select_investment_menu').empty();
				$.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_alternative_get_Investments.php?callback=?', {//JSONP Request to Open Items Page setup tables
					key : window.key,
					activeModelAlternativeId : window.activeModelAlternativeId
				}, function(res, status) {
					$.each(res, function(i, item) {
						if (c==0) {
							window.activeModelInvestmentId = item.investment_id;
							c=1;
						}
						if(item.investment_id == 0) {
							$('#return_on_investment_alternative_select_investment_menu').append("<option value=''>" + item.title + "</option>");							
							$('#return_on_investment_alternative_select_investment_menu').selectmenu('refresh', true);
						}else{
							$('#return_on_investment_alternative_select_investment_menu').append("<option value='" + item.investment_id + "'>Investment " + item.investment_id + ": " + item.title + "</option>");							
							$('#return_on_investment_alternative_select_investment_menu').selectmenu('refresh', true);
						}
					});
				});
				setTimeout(function(){
					  	getActiveInvestmentIncomeDrivers();
					  	getActiveInvestmentCostDrivers();
					 }, 1000);
			}
			function getListofAlternativesforReturnOnInvestment(){//Populates the Alternative Picker at the top of the risk_analysis page.
				var i = 0;			//Reset Counter
				$('#return_on_investment_alternative_select_menu').empty();

				$.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_getCurrentModel_Alternatives.php?callback=?', {//JSONP Request to Open Items Page setup tables
					key : window.key,
					activeModelUUID : window.activeModelUUID
				}, function(res, status) {
					$('#risk_analysis_alternative_select_menu').empty();
					$.each(res, function(i, item) {
						if(item.decision=="Use Now"){
							if(i==0){	
								window.activeModelAlternativeId = item.id;	//Set the first item in the callback as the activeModelAlternativeId.
								i = 1;
								setTimeout(function() {
									getAlternativesInvestments();
								}, 1000);											//Iterate counter
							}
							$('#return_on_investment_alternative_select_menu').append("<option value='" + item.id + "'>Alternative " + item.id + " : " + item.description + "</option>");							
							$('#return_on_investment_alternative_select_menu').selectmenu('refresh', true);
						}else{
							//$('#').append("...");
						}
						
					});
					
				});				
							//$('#risk_analysis_alternative_select_menu_container').trigger("refresh");
			}
			function removeCostFromInvestment (activeCostDriverId) {
				//alert("this is a test "+activeCostDriverId)
				$.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_investment_remove_CostDriver.php?callback=?', {//JSONP Request to Open Items Page setup tables
					key : window.key,
					activeInvestmentId : window.activeModelInvestmentId,
					activeCostDriverId: activeCostDriverId
				}, function(res, status) {
					$().toastmessage('showNoticeToast', res.message);
				});	
				getAlternativesInvestments();
				setTimeout(function(){
					  	getActiveInvestmentCostDrivers();
				}, 1000);
			}
			function removeIncomeFromInvestment(activeIncomeDriveId) {
				//alert("this is a test "+activeIncomeDriveId)
				$.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_investment_remove_IncomeDriver.php?callback=?', {//JSONP Request to Open Items Page setup tables
					key : window.key,
					activeInvestmentId : window.activeModelInvestmentId,
					activeIncomeDriverId: activeIncomeDriveId
				}, function(res, status) {
					$().toastmessage('showNoticeToast', res.message);
				});	
				getAlternativesInvestments();
				setTimeout(function(){
					  	getActiveInvestmentIncomeDrivers();
				}, 1000);
			}
			function newCalculatedCostDriver() {		//Calculates the Product of 
			    var sum=0;
			    var costperunit = 0;
			    var numunits = 0;
			    var totalcost = 0;
			    var thisRow = $(this).closest('tr');
			    //iterate through each input and add to sum
			    $(thisRow).find("td:not(.total) .costperunit_col_num").each(function() {
			            costperunit = parseFloat(this.value);  
			    });
			    $(thisRow).find("td:not(.total) .numunits_col_num").each(function() {
			            numunits = parseFloat(this.value);                     
			    }); 
			    totalcost = costperunit*numunits;
			    //change value of Risk
			    var totalcost_input = $(thisRow).find(".totalcost_col_num");
			    totalcost_input.html('$'+ totalcost);
			}
			function newCalculatedIncomeDriver() {		//Calculates the Product of 
			    var sum=0;
			    var incomeperunit = 0;
			    var numunits = 0;
			    var totalincome = 0;
			    var thisRow = $(this).closest('tr');
			    //iterate through each input and add to sum
			    $(thisRow).find("td:not(.total) .incomeperunit_col_num").each(function() {
			            incomeperunit = parseFloat(this.value);  
			    });
			    $(thisRow).find("td:not(.total) .numunits_col_num").each(function() {
			            numunits = parseFloat(this.value);                     
			    }); 
			    totalincome = incomeperunit*numunits;
			    //change value of Risk
			    var totalincome_input = $(thisRow).find(".totalincome_col_num");
			    totalincome_input.html('$'+ totalincome);
			}	