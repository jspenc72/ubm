
//Initialize Slider for Pro Hi and Low Monetary Benefit
				  $(function() {
				    $( "#possible_alternatives_pro_monetary_gain_slider" ).slider({
				      range: true,
				      min: 0,
				      max: 500,
				      values: [ 75, 300 ],
				      slide: function( event, ui ) {
				    		$( "#possible_alternatives_pro_monetary_gain_input" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] ); //Populate the text input with the Low and High values from the slider.
					      $("#possible_alternatives_pro_monetary_gain_input_low").val(ui.values[ 0 ]);
					      $("#possible_alternatives_pro_monetary_gain_input_high").val(ui.values[ 1 ]);	      
				      }
				    });
				    $( "#possible_alternatives_pro_monetary_gain_input" ).val( "$" + $( "#possible_alternatives_pro_monetary_gain_slider" ).slider( "values", 0 ) +
				      " - $" + $( "#possible_alternatives_pro_monetary_gain_slider" ).slider( "values", 1 ) );
				      $("#possible_alternatives_pro_monetary_gain_input_low").val($( "#possible_alternatives_pro_monetary_gain_slider" ).slider("values", 0));
				      $("#possible_alternatives_pro_monetary_gain_input_high").val($( "#possible_alternatives_pro_monetary_gain_slider" ).slider("values", 1));
				  });
//Initialize Slider for Con Hi and Low Monetary Benefit
				  $(function() {
				    $( "#possible_alternatives_con_monetary_cost_slider" ).slider({
				      range: true,
				      min: -1000,
				      max: 0,
				      values: [ -500, -10 ],
				      slide: function( event, ui ) {
				        $( "#possible_alternatives_con_monetary_cost_input" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] ); //Populate the text input with the Low and High values from the slider.
				      }
				    });
				    $( "#possible_alternatives_con_monetary_cost_input" ).val( "$" + $( "#possible_alternatives_con_monetary_cost_slider" ).slider( "values", 0 ) +
				      " - $" + $( "#possible_alternatives_con_monetary_cost_slider" ).slider( "values", 1 ) );
				      $("#possible_alternatives_con_monetary_cost_input_low").val($( "#possible_alternatives_con_monetary_cost_slider" ).slider("values", 0));
				      $("#possible_alternatives_con_monetary_cost_input_high").val($( "#possible_alternatives_con_monetary_cost_slider" ).slider("values", 1));
				  });
				function newLowSum() {		//Calculates the Sum of the Low Annual Expected ROI Costs and Benefits 
				    var sum=0;
				    var thisRow = $(this).closest('tr');
				    
				    var total=0;
				
				    //iterate through each input and add to sum
				    $(thisRow).find(".low_col_num").each(function() {
				            sum += parseInt(this.value);                     
				    }); 
				    //change value of total
				    $(thisRow).find(".low_total").html(sum);
				    
				     
				     // the grand total
				    /*** / $('.total').each(function() {
				         total += parseInt($(this).html());
				     });/***/
				      
				   // $('.result').val(total);
				}
				function newHighSum() {		//Calculates the Sum of the Low Annual Expected ROI Costs and Benefits 
				    var sum=0;
				    var thisRow = $(this).closest('tr');
				    var total=0;				
				    //iterate through each input and add to sum
				    $(thisRow).find("td:not(.total) .high_col_num").each(function() {
				            sum += parseInt(this.value);                     
				    }); 
				    //change value of total
				    $(thisRow).find(".high_total").html(sum);
				     // the grand total
				     $('.high_total').each(function() {
				         total += parseInt($(this).html());
				     });
				    $('.result').val(total);
				}
				function setActiveAlternativePro(activeModelAlternativeProId){
					window.activeModelAlternativeProId = activeModelAlternativeProId;
				}
				function setActiveAlternativeCon(activeModelAlternativeConId){
					window.activeModelAlternativeConId = activeModelAlternativeConId;
				}
				function setActiveAlternative(activeModelAlternativeId){
					window.activeModelAlternativeId = activeModelAlternativeId;
					$().toastmessage('showNoticeToast', window.activeModelAlternativeId);
					//alert(window.activeModelAlternativeId);
					setTimeout(function() {
						getActiveAlternativeListofPros();
						getActiveAlternativeListofCons();
						getActiveAlternativeListofRisks();
					}, 1000);						
				}
				function getMyModelsListofAlternatives(){
					showLoader();
					$('#possible_alternitives_table_body').empty();
					$.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_getCurrentModel_Alternatives.php?callback=?', {//JSONP Request
						key : window.key,
						activeModelUUID : window.activeModelUUID,
					}, function(res, status) {
						$.each(res, function(i, item) {
							if(item.decision=="Use Now"){
								$('#possible_alternitives_table_body').append("<tr><td><a href='#' onclick='removeAlternativefromModel(" + item.id + ")'><span class='trashico'></span></a></td><td>" + item.id + "<a href='#' onclick='setActiveAlternative(" + item.id + ")' class='ui-btn ui-icon-tag ui-btn-icon-notext ui-corner-all'>No text</a></td><td>" + item.description + "</td><td><fieldset class='alternative_decision_controlgroup' data-role='controlgroup' data-type='horizontal'><button data-icon='refresh' onclick='setActiveAlternative(" + item.id + ")'>Show Pros and Cons</button><label for='select-more-1a' class='ui-hidden-accessible'>More</label><select name='select-more-1a' id='select-more-1a' data-theme='d'><option value='#' selected='selected'>Use Now</option><option value='#'>Consider for the future</option><option value='#'>Not a forseen use</option></select></fieldset></td><td><input class='high_col_num' value = '" + item.annual_cost_high + "'/></td><td><input class='low_col_num' value = '" + item.annual_cost_low + "'/></td><td><input class='high_col_num' value = '" + item.annual_benefit_high + "'/></td><td><input class='low_col_num' value = '" + item.annual_benefit_low + "'/></td><td class='high_total'>High ROI</td><td class='low_total'>Low ROI</td><td><a href='#' class='ui-btn risk_analysis_table' onclick='saveAlternativeAnalysis(" + item.id + ")'>Save Alternative </br> Analysis</a></td></tr>");							
								$( "#possible_alternitives_table" ).table( "refresh" );
								$(".alternative_decision_controlgroup").trigger("create");
							}else{
								if(item.decision=="Consider for the future"){
									$('#possible_alternitives_table_body').append("<tr><td><a href='#' onclick='removeAlternativefromModel(" + item.id + ")'><span class='trashico'></span></a></td><td>" + item.id + "<a href='#' onclick='setActiveAlternative(" + item.id + ")' class='ui-btn ui-icon-tag ui-btn-icon-notext ui-corner-all'>No text</a></td><td>" + item.description + "</td><td><fieldset class='alternative_decision_controlgroup' data-role='controlgroup' data-type='horizontal'><button data-icon='refresh' onclick='setActiveAlternative(" + item.id + ")'>Show Pros and Cons</button><label for='select-more-1a' class='ui-hidden-accessible'>More</label><select name='select-more-1a' id='select-more-1a' data-theme='b'><option value='#'>Use Now</option><option value='#' selected='selected'>Consider for the future</option><option value='#'>Not a forseen use</option></select></fieldset></td><td><input class='high_col_num' value = '" + item.annual_cost_high + "'/></td><td><input class='low_col_num' value = '" + item.annual_cost_low + "'/></td><td><input class='high_col_num' value = '" + item.annual_benefit_high + "'/></td><td><input class='low_col_num' value = '" + item.annual_benefit_low + "'/></td><td class='high_total'>High ROI</td><td class='low_total'>Low ROI</td><td><a href='#' class='ui-btn risk_analysis_table' onclick='saveAlternativeAnalysis(" + item.id + ")'>Save Alternative </br> Analysis</a></td></tr>");
									$( "#possible_alternitives_table" ).table( "refresh" );
									$(".alternative_decision_controlgroup").trigger("create");								
								}else{
									if(item.decision=="Not a forseen use"){
										$('#possible_alternitives_table_body').append("<tr><td><a href='#' onclick='removeAlternativefromModel(" + item.id + ")'><span class='trashico'></span></a></td><td>" + item.id + "<a href='#' onclick='setActiveAlternative(" + item.id + ")' class='ui-btn ui-icon-tag ui-btn-icon-notext ui-corner-all'>No text</a></td><td>" + item.description + "</td><td><fieldset class='alternative_decision_controlgroup' data-role='controlgroup' data-type='horizontal'><button data-icon='refresh' onclick='setActiveAlternative(" + item.id + ")'>Show Pros and Cons</button><label for='select-more-1a' class='ui-hidden-accessible'>More</label><select name='select-more-1a' id='select-more-1a' data-theme='c'><option value='#'>Use Now</option><option value='#'>Consider for the future</option><option value='#' selected='selected'>Not a forseen use</option></select></fieldset></td><td><input class='high_col_num' value = '" + item.annual_cost_high + "'/></td><td><input class='low_col_num' value = '" + item.annual_cost_low + "'/></td><td><input class='high_col_num' value = '" + item.annual_benefit_high + "'/></td><td><input class='low_col_num' value = '" + item.annual_benefit_low + "'/></td><td class='high_total'>High ROI</td><td class='low_total'>Low ROI</td><td><a href='#' class='ui-btn risk_analysis_table' onclick='saveAlternativeAnalysis(" + item.id + ")'>Save Alternative </br> Analysis</a></td></tr>");
										$( "#possible_alternitives_table" ).table( "refresh" );
										$(".alternative_decision_controlgroup").trigger("create");
									}else{
										
									}
								}
							}

						});
					});				
					setTimeout(function() {
					    $(".low_col_num").each(function() {				
					        $(this).keyup(function(){				//Call the newSum function each time a keystroke is activated in any of the inputs with col_num as the class.
					            newLowSum.call(this);
					        });
					    });
					    $(".high_col_num").each(function() {				
					        $(this).keyup(function(){				//Call the newSum function each time a keystroke is activated in any of the inputs with col_num as the class.
					            newHighSum.call(this);
					        });
					    });

						hideLoader();
					}, 5000);
				}
				function getActiveAlternativeListofPros(){
					showLoader();
					$('#possible_alternitives_pros_table_body').empty();

					$.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_getCurrentModel_activeAlternativePros.php?callback=?', {//JSONP Request
						key : window.key,
						activeModelAlternativeId : window.activeModelAlternativeId,
					}, function(res, status) {
						if(status=="success"){
							setTimeout(function() {
								hideLoader();
							}, 1000);							
						}
						$.each(res, function(i, item) {
							$('#possible_alternitives_pros_table_body').append("<tr><td>" + item.id + "<a href='#' onclick='setActiveAlternativePro(" + item.id + ")' class='ui-btn ui-icon-tag ui-btn-icon-notext ui-corner-all'>No text</a></td><td>" + item.description + "</td><td><input class='high_col_num' value = '" + item.benefit_high + "'/></td><td><input class='low_col_num' value = '" + item.benefit_low + "'/></td></tr>");
							$( "#possible_alternitives_pros_table" ).table( "refresh" );
						});
					});						
				}
				function getActiveAlternativeListofCons(){
					showLoader();
					$('#possible_alternitives_cons_table_body').empty();
					$.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_getCurrentModel_activeAlternativeCons.php?callback=?', {//JSONP Request
						key : window.key,
						activeModelAlternativeId : window.activeModelAlternativeId,
					}, function(res, status) {
						if(status=="success"){
							setTimeout(function() {
								hideLoader();
							}, 1000);							
						}
						$.each(res, function(i, item) {
							$('#possible_alternitives_cons_table_body').append("<tr><td>" + item.id + "<a href='#' onclick='setActiveAlternativeCon(" + item.id + ")' class='ui-btn ui-icon-tag ui-btn-icon-notext ui-corner-all'>No text</a></td><td>" + item.description + "</td><td><input class='high_col_num' value = '" + item.cost_low + "'/></td><td><input class='low_col_num' value = '" + item.cost_high + "'/></td></tr>");
							$( "#possible_alternitives_cons_table" ).table( "refresh" );
						});

					});						
				}
				function createNewAlternative(){
					showLoader();
					$.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_create_Alternative.php?callback=?', {//JSONP Request
						key : window.key,
						activeModelUUID : window.activeModelUUID,
						alternativeDescription : document.getElementById("possible_alternatives_alternativeDescription").value,
						alternativeDecision : document.getElementById("possible_alternatives_alternativeDecision").value,
						username : window.username
					}, function(res, status) {
						if(status=="success"){
							setTimeout(function() {
								getMyModelsListofAlternatives();
								hideLoader();
							}, 1000);							
						}
					});
				}
				function createNewProforactiveModelAlternative(){
					showLoader();
					$.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_create_Alternative_Pro.php?callback=?', {//JSONP Request
						key : window.key,
						activeModelUUID : window.activeModelUUID,
						activeModelAlternativeId : window.activeModelAlternativeId,
						alternativeProDescription : document.getElementById("possible_alternatives_alternativeProDescription").value,
						alternativeProROIRef : document.getElementById("possible_alternatives_alternativeProROIRef").value,
						alternativeProHighBenefit : document.getElementById("possible_alternatives_pro_monetary_gain_input_high").value,
						alternativeProLowBenefit : document.getElementById("possible_alternatives_pro_monetary_gain_input_low").value,
						username : window.username
					}, function(res, status) {
						if(status=="success"){
							setTimeout(function() {
								getMyModelsListofAlternatives();
								getActiveAlternativeListofPros();
								hideLoader();
							}, 1000);							
						}
					});
				}
				function createNewConforactiveModelAlternative(){
					showLoader();
					$.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_create_Alternative_Con.php?callback=?', {//JSONP Request
						key : window.key,
						activeModelUUID : window.activeModelUUID,
						activeModelAlternativeId : window.activeModelAlternativeId,
						alternativeConDescription : document.getElementById("possible_alternatives_alternativeConDescription").value,
						alternativeConROIRef : document.getElementById("possible_alternatives_alternativeConROIRef").value,
						alternativeConHighCost : document.getElementById("possible_alternatives_con_monetary_cost_input_low").value,
						alternativeConLowCost : document.getElementById("possible_alternatives_con_monetary_cost_input_high").value,
						username : window.username
					}, function(res, status) {
						$().toastmessage('showNoticeToast', status);
						if(status=="success"){
							setTimeout(function() {
								getMyModelsListofAlternatives();
								getActiveAlternativeListofCons();
								hideLoader();
							}, 1000);							
						}
					});
				}
				function removeAlternativefromModel(activeAlternativeId){
					$().toastmessage('showNoticeToast', "this is a test " + activeAlternativeId + "");
					$.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_remove_Alternative.php?callback=?', {//JSONP Request
						key : window.key,
						activeAlternativeId : activeAlternativeId,
						activeModelUUID: window.activeModelUUID
					}, function(res, status) {
						$().toastmessage('showNoticeToast', res.message);
					});	
					getMyModelsListofAlternatives();
				}
					function saveAlternativeAnalysis(){
						$().toastmessage('showNoticeToast', 'alternative analysis will be save to this model.');
				}
