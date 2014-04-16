
			function setReviewedByStartTime(itemId) {
				var date = new Date();
				$.getJSON('http://api.universalbusinessmodel.com/ubm_modelcreationsuite_setActiveReviewedByTime.php?callback=?', {//JSONP Request
					itemId : window.itemId,
					date : window.setActiveReviewedByTime,
					activeModelUUID : window.activeModelUUID
				}, function(res, status) {
					$().toastmessage('showNoticeToast', res.message);
				});
			}
			function setFinalReviewedByStartTime(itemId) {
				var date = new Date();
				$.getJSON('http://api.universalbusinessmodel.com/ubm_modelcreationsuite_setActiveFinalReviewedByTime.php?callback=?', {//JSONP Request
					itemId : window.itemId,
					date : window.setActiveFinalReviewedByTime,
					activeModelUUID : window.activeModelUUID
				}, function(res, status) {
					$().toastmessage('showNoticeToast', res.message);
				});
			}
			function getMyModelsListofApplications(){
				$.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_get_MyApps.php?callback=?', {//JSONP Request
					key : window.key,
					activeModelUUID : window.activeModelUUID,
					username : window.username
				}, function(res, status) {
					$('#ubmsuite_mcs_my_applications_myApps_ul').empty();
					$.each(res, function(i, item) {
//For Each Application attached to the model. Insert an Icon for the Applicaiton on the My Apps Page.
						$('#ubmsuite_mcs_my_applications_myApps_ul').append("<li><a href='#" + item.app_dashboard_href + "'><img src='img/time-for-review.jpg' class='ui-li-thumb'><h2>" + item.title + "</h2><p>" + item.summary + "</p><p class='ui-li-aside'>MA</p></a></li> ");
						$('#ubmsuite_mcs_my_applications_myApps_ul').listview("refresh");
//For Each Application Insert the Management Dashboard for the Application.
						$('body').prepend("<div data-role='page' id=" + item.app_dashboard_href + " ><div data-role='header' data-theme='a'><a href='#ubmsuite_SelectBusinessModel' class='back_btn' data-icon='arrow-l' data-iconpos='notext'>Back</a><h1>" + item.title + "</h1></div><div role='main' class='ui-content'></div></div>");
						setTimeout(function() {
							//$('#' + item.app_dashboard_href).trigger('create');
							//$('#ubmsuite_mcs_my_applications').trigger('create');
						}, 500);					
					});					
				});			
			}
			window.c = 0;
			//Set window variable so that the counter persists each time the function is called.
			function addField(c, cloned) {
				var c = window.c;
				//Set c equal to the window variable
				var cloned //define a variable to serve as the reference for inserting a new element
				event.preventDefault();
				//prevent the default from happening
				cloned = $('#gettingStarted_content_textarea' + c);
				//set cloned as the element being cloned.
				$("#gettingStarted_content_textarea" + c).clone().attr('id', 'gettingStarted_content_textarea' + (++c)).insertAfter(cloned);

				$("#gettingStarted_content_textarea" + c).text('gettingStarted_content_textarea' + c);
				// JUST TO TEST
				window.c = c;
				//alert("addField was called");
				//$( "p" ).clone().add( "<span>Again</span>" ).appendTo( document.body );

				//		$('#gettingStarted_content').append($( "#gettingStarted_content_textarea" ).clone());
				//alert("addField was executed");
			}

			function submitReviewPoint(popupid) {
				//Show Loader Message
				var $this = $("#page_loading_message"), theme = $this.jqmData("theme") || $.mobile.loader.prototype.options.theme, msgText = $this.jqmData("msgtext") || $.mobile.loader.prototype.options.text, textVisible = $this.jqmData("textvisible") || $.mobile.loader.prototype.options.textVisible, textonly = !!$this.jqmData("textonly");
				html = $this.jqmData("html") || "";
				$.mobile.loading("show", {
					text : msgText,
					textVisible : textVisible,
					theme : theme,
					textonly : textonly,
					html : html
				});
				if (popupid == "sign_in_sign_up_") {
					alert("this is the popup: " + popupid);
				}
				//End Show Loader Message
				//event.preventDefault();
				//alert(window.username);
				$.getJSON('http://api.universalbusinessmodel.com/ubmsubmitopenitems.php?callback=?', {
					appname : "UBMMFICS",
					RQType : "sumbitReviewPoint",
					username : window.username,
					formref : document.getElementById(popupid + "submitreviewpoint_formref").value,
					priority : document.getElementById(popupid + "submitreviewpoint_priority").value,
					actionrequired : document.getElementById(popupid + "submitreviewpoint_actionrequired").value,
					assignedto : document.getElementById(popupid + "submitreviewpoint_assignedto").value,
					duedate : document.getElementById(popupid + "submitreviewpoint_duedatetime").value,
				}, function(res, status) {
					$().toastmessage('showNoticeToast', "init: " + status + "");
					$().toastmessage('showNoticeToast', res.message);
					if (status == "success") {
						$('#gettingStarted_open_items_form').each(function() {
							this.reset();
						});
						$('#sign_in_sign_up_open_items_form').each(function() {
							this.reset();
						});
						$('#ubmsuite_table_of_contents_open_items_form').each(function() {
							this.reset();
						});
						$('#creator_table_of_contents_open_items_form').each(function() {
							this.reset();
						});
						$('#identification_setup_open_items_form').each(function() {
							this.reset();
						});
						$('#primary_objects_setup_table_open_items_form').each(function() {
							this.reset();
						});
						$('#management_reporting_open_items_form').each(function() {
							this.reset();
						});
						$('#mcs_setup_checklist_setup_open_items_form').each(function() {
							this.reset();
						});
						$('#mcs_setup_checklist_CS_open_items_form').each(function() {
							this.reset();
						});
						$('#mcs_setup_checklist_p1_open_items_form').each(function() {
							this.reset();
						});
						$('#mcs_setup_checklist_p2_open_items_form').each(function() {
							this.reset();
						});
						$('#mcs_setup_checklist_p3_open_items_form').each(function() {
							this.reset();
						});
						$('#mcs_setup_checklist_p4_b1_open_items_form').each(function() {
							this.reset();
						});
						$('#mcs_setup_checklist_p4_b2_open_items_form').each(function() {
							this.reset();
						});
						$('#mcs_setup_checklist_p4_b3_open_items_form').each(function() {
							this.reset();
						});
						$('#mcs_setup_checklist_p4_b4_open_items_form').each(function() {
							this.reset();
						});
						$('#mcs_setup_checklist_p4_b5_open_items_form').each(function() {
							this.reset();
						});
						$('#mcs_setup_checklist_p4_b6_open_items_form').each(function() {
							this.reset();
						});
						$('#mcs_setup_checklist_p4_b7_open_items_form').each(function() {
							this.reset();
						});
						$('#mcs_setup_checklist_p4_b8_open_items_form').each(function() {
							this.reset();
						});
						$('#mcs_setup_checklist_p4_b9_open_items_form').each(function() {
							this.reset();
						});
						$('#mcs_setup_checklist_p4_b10_open_items_form').each(function() {
							this.reset();
						});
						$('#mcs_setup_checklist_p4_b11_open_items_form').each(function() {
							this.reset();
						});
						$('#mcs_setup_checklist_p4_b12_open_items_form').each(function() {
							this.reset();
						});
						$('#mcs_setup_checklist_p5_open_items_form').each(function() {
							this.reset();
						});
						$('#mcs_setup_checklist_p6_open_items_form').each(function() {
							this.reset();
						});
						$('#mcs_setup_checklist_p7_open_items_form').each(function() {
							this.reset();
						});
						$('#mcs_setup_checklist_p8_open_items_form').each(function() {
							this.reset();
						});
						$('#open_points_action_items_open_items_form').each(function() {
							this.reset();
						});
						$('#ubmsuite_SelectBusinessModel_open_items_form').each(function() {
							this.reset();
						});
						$('#ubmsuite_modelSettings_open_items_form').each(function() {
							this.reset();
						});
					}
					//Start Show Loading Message
					$.mobile.loading("hide");
					//End Hide Loading Message
				});
			}