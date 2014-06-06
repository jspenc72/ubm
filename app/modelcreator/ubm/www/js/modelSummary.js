			function overview() {
			    $("#links_setup").attr("onclick", "getModelSetupSummary(2)");
			    $("#links_control").attr("onclick", "getControlSummary(2)");
			    $("#links_phase1").attr("onclick", "getPhase1Summary(2)");
			    $("#links_phase2").attr("onclick", "getPhase2Summary(2)");
			    $("#links_phase3").attr("onclick", "getPhase3Summary(2)");
			    $("#links_phase4").attr("onclick", "getPhase4Summary(2)");
			    $("#links_setup").removeClass('ico3');
			    $("#links_setup").addClass('ico2');
			    $("#links_control").removeClass('ico3');
			    $("#links_control").addClass('ico2');
			    $("#links_phase1").removeClass('ico3');
			    $("#links_phase1").addClass('ico2');
			    $("#links_phase2").removeClass('ico3');
			    $("#links_phase2").addClass('ico2');
			    $("#links_phase3").removeClass('ico3');
			    $("#links_phase3").addClass('ico2');
			    $("#links_phase4").removeClass('ico3');
			    $("#links_phase4").addClass('ico2');
			    getModelSetupSummary(2);
			}

			function summary() {
			    $("#links_setup").attr("onclick", "getModelSetupSummary(1)");
			    $("#links_control").attr("onclick", "getControlSummary(1)");
			    $("#links_phase1").attr("onclick", "getPhase1Summary(1)");
			    $("#links_phase2").attr("onclick", "getPhase2Summary(1)");
			    $("#links_phase3").attr("onclick", "getPhase3Summary(1)");
			    $("#links_phase4").attr("onclick", "getPhase4Summary(1)");
			    $("#links_setup").removeClass('ico2');
			    $("#links_setup").addClass('ico3');
			    $("#links_control").removeClass('ico2');
			    $("#links_control").addClass('ico3');
			    $("#links_phase1").removeClass('ico2');
			    $("#links_phase1").addClass('ico3');
			    $("#links_phase2").removeClass('ico2');
			    $("#links_phase2").addClass('ico3');
			    $("#links_phase3").removeClass('ico2');
			    $("#links_phase3").addClass('ico3');
			    $("#links_phase4").removeClass('ico2');
			    $("#links_phase4").addClass('ico3');
			    getModelSetupSummary(1);
			}

			function getModelSetupSummary(classId) {
			    showLoader();
			    var complete = 0;
			    var incomplete = 0;
			    $('#ubmsuite_mcs_model_review_ubm_modelSetup_ul').empty();
			    $('#tab-1').show();
			    $('#tab-2').hide();
			    $('#tab-3').hide();
			    $('#tab-4').hide();
			    $('#tab-5').hide();
			    $('#tab-6').hide();
			    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_getallchecklistitems.php?callback=?', { //JSONP Request
			        username: window.username,
			        key: window.key,
			        activeModelUUID: window.activeModelUUID
			    }, function(res, status) {
			        $.each(res, function(i, item) {
			            if (item.status && item.line_number >= 1 && item.line_number <= 7) {
			                $('#ubmsuite_mcs_model_review_ubm_modelSetup_ul').append("<li class='success'>" + item.instruction_detail + "<br>Completed By: " + item.preparer_username + "</li>");
			                complete++;
			            } else if (item.line_number >= 1 && item.line_number <= 7) {
			                $('#ubmsuite_mcs_model_review_ubm_modelSetup_ul').append("<li class='warning'>Warning : <a href='#mcs_setup_checklist_setup'>" + item.instruction_detail + "</a></li>");
			                incomplete++;
			            }
			        });
			        if (classId == 2) {
			            var total = incomplete + complete;
			            var percentComplete = complete / total * 100 + "%";

			            $('#ubmsuite_mcs_model_review_ubm_modelSetup_ul').empty();
			            $('#ubmsuite_mcs_model_review_ubm_modelSetup_ul').append("<li class='success'>Items Completed: " + complete + "</li>");
			            $('#ubmsuite_mcs_model_review_ubm_modelSetup_ul').append("<li class='warning'>Items Incomplete: " + incomplete + "</li>");
			            $('#ubmsuite_mcs_model_review_ubm_modelSetup_ul').append("<li class='success'>" + percentComplete + " Complete</li>");
			        }
			        hideLoader();
			    });
			}


			function getControlSummary(classId) {
			    showLoader();
			    var complete = 0;
			    var incomplete = 0;
			    $('#ubmsuite_mcs_model_review_ubm_control_ul').empty();
			    $('#tab-2').show();
			    $('#tab-1').hide();
			    $('#tab-3').hide();
			    $('#tab-4').hide();
			    $('#tab-5').hide();
			    $('#tab-6').hide();
			    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_getallchecklistitems.php?callback=?', { //JSONP Request
			        username: window.username,
			        key: window.key,
			        activeModelUUID: window.activeModelUUID
			    }, function(res, status) {
			        $.each(res, function(i, item) {
			            if (item.line_number >= 8 && item.line_number <= 11 && item.status == "TRUE") {
			                $('#ubmsuite_mcs_model_review_ubm_control_ul').append("<li class='success'>" + item.instruction_detail + "<br>Completed By: " + item.preparer_username + "</li>");
			                complete++;
			            } else if (item.line_number >= 8 && item.line_number <= 11) {
			                $('#ubmsuite_mcs_model_review_ubm_control_ul').append("<li class='warning'>Warning : <a href='#mcs_setup_checklist_CS'>" + item.instruction_detail + "</li>");
			                incomplete++;
			            }
			        });
			        if (classId == 2) {
			            if (incomplete != 0) {
			                var percentComplete = complete / incomplete * 100 + "%";
			            } else {
			                var percentComplete = 100 + "%";
			            }
			            $('#ubmsuite_mcs_model_review_ubm_control_ul').empty();
			            $('#ubmsuite_mcs_model_review_ubm_control_ul').append("<li class='success'>Items Completed: " + complete + "</li>");
			            $('#ubmsuite_mcs_model_review_ubm_control_ul').append("<li class='warning'>Items Incomplete: " + incomplete + "</li>");
			            $('#ubmsuite_mcs_model_review_ubm_control_ul').append("<li class='success'>" + percentComplete + " Complete</li>");
			        }
			        hideLoader();
			    });

			}


			function getPhase1Summary(classId) {
			    showLoader();
			    var complete = 0;
			    var incomplete = 0;
			    $('#ubmsuite_mcs_model_review_ubm_phase1_ul').empty();
			    $('#tab-3').show();
			    $('#tab-2').hide();
			    $('#tab-1').hide();
			    $('#tab-4').hide();
			    $('#tab-5').hide();
			    $('#tab-6').hide();
			    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_getallchecklistitems.php?callback=?', { //JSONP Request
			        username: window.username,
			        key: window.key,
			        activeModelUUID: window.activeModelUUID
			    }, function(res, status) {
			        $.each(res, function(i, item) {
			            if (item.line_number >= 15 && item.line_number <= 20 && item.status == "TRUE") {
			                $('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='success'>" + item.instruction_detail + "<br>Completed By: " + item.preparer_username + "</li>");
			                complete++;

			            } else if (item.line_number >= 15 && item.line_number <= 20) {
			                $('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='warning'>Warning : <a href='#mcs_setup_checklist_p1'>" + item.instruction_detail + "</li>");
			                incomplete++;

			            }
			        });
			        if (classId == 1) {
			            getModelSummary();
			        }
			        if (classId == 2) {
			            if (incomplete != 0) {
			                var percentComplete = complete / incomplete * 100 + "%";
			            } else {
			                var percentComplete = 100 + "%";
			            }
			            $('#ubmsuite_mcs_model_review_ubm_phase1_ul').empty();
			            $('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='success'>Items Completed: " + complete + "</li>");
			            $('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='warning'>Items Incomplete: " + incomplete + "</li>");
			            $('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='success'>" + percentComplete + " Complete</li>");
			        }
			        hideLoader();
			    });



			}

			function getModelSummary() {
			    showLoader();
			    $('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li><center><h1>Business Model Summary</h1></center></li>");
			    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_getCurrentModel_Summary.php?callback=?', { //JSONP Request
			        username: window.username,
			        key: window.key,
			        activeModelUUID: window.activeModelUUID
			    }, function(res, status) {
			        $.each(res, function(i, item) {

			            if (item.title) {
			                $('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='success'>" + item.title_prefix + " : " + item.title + "</li>");

			            } else {
			                $('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='warning'>Warning : This model doesnt have a Title.</li>");

			            } if (item.description) {
			                $('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='success'>" + item.description_prefix + " : " + item.description + "</li>");

			            } else {
			                $('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='warning'>Warning : This model doesnt have a Description.</li>");

			            } if (item.scope) {
			                $('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='success'>" + item.scope_prefix + " : " + item.scope + "</li>");

			            } else {
			                $('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='warning'>Warning : This model doesnt have a Scope.</li>");

			            } if (item.purpose) {
			                $('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='success'>" + item.purpose_prefix + " : " + item.purpose + "</li>");

			            } else {
			                $('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='error'>Warning : This model doesnt have a purpose!</li>");

			            } if (item.conceptual_definition) {
			                $('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='success'>" + item.conceptual_definition_prefix + " : " + item.conceptual_definition + "</li>");

			            } else {
			                $('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='error'>Warning : This model doesnt have a Conceptual Definition.</li>");

			            } if (item.mission_statement) {
			                $('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='success'>" + item.mission_statement_prefix + " : " + item.mission_statement + "</li>");

			            } else {
			                $('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='error'>Warning : This model doesnt have a Mission Statement.</li>");

			            } if (item.vision_statement) {
			                $('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='success'>" + item.vision_statement_prefix + " : " + item.vision_statement + "</li>");

			            } else {
			                $('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='error'>Warning : This model doesnt have a Vision Statement.</li>");

			            } if (item.model_steward) {
			                $('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='success'>" + item.model_steward_prefix + " : " + item.model_steward + "</li>");

			            } else {
			                $('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='warning'>Warning : This model doesnt have a Model Steward.</li>");

			            } if (item.creator_id) {
			                $('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='success'>" + item.creator_id_prefix + " : " + item.creator_id + "</li>");

			            } else {
			                $('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='error'>Error : This model doesnt have a Creator ID!.</li>");

			            } if (item.created_date) {
			                $('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='success'>" + item.created_date_prefix + " : " + item.created_date + "</li>");

			            } else {
			                $('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='error'>Error : This model doesnt appear to have a on which it was created!</li>");

			            } if (item.modified_date) {
			                $('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='success'>" + item.modified_date_prefix + " : " + item.modified_date + "</li>");

			            } else {
			                $('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='warning'>Warning : This model doesnt have a Modified Date.</li>");

			            } if (item.model_version) {
			                $('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='success'>" + item.model_version_prefix + " : " + item.model_version + "</li>");

			            } else {
			                $('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='warning'>Warning : This model doesnt have a Model Version.</li>");

			            } if (item.owner_legal_entity) {
			                $('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='success'>" + item.owner_legal_entity_prefix + " : " + item.owner_legal_entity + "</li>");

			            } else {
			                $('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='warning'>Warning : This model doesnt have a Legal Entity.</li>");

			            } if (item.owner_ccode) {
			                $('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='success'>" + item.owner_ccode_prefix + " : " + item.owner_ccode + "</li>");

			            } else {
			                $('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='error'>Error : This model doesnt have an Owner CCODE on file.</li>");

			            } if (item.model_contact_name) {
			                $('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='success'>" + item.model_contact_name_prefix + " : " + item.model_contact_name + "</li>");

			            } else {
			                $('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='error'>Error : We dont have a Contact on file for this model.</li>");

			            } if (item.model_contact_phone) {
			                $('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='success'>" + item.model_contact_phone_prefix + " : " + item.model_contact_phone + "</li>");

			            } else {
			                $('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='error'>Error : We dont have a Contact Phone Number on file for this model.</li>");

			            } if (item.model_contact_email) {
			                $('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='success'>" + item.model_contact_email_prefix + " : " + item.model_contact_email + "</li>");

			            } else {
			                $('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='warning'>Warning : This model doesnt have a reference.</li>");

			            } if (item.system_title) {
			                $('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='success'>" + item.system_title_prefix + " : " + item.system_title + "</li>");

			            } else {
			                $('#ubmsuite_mcs_model_review_ubm_phase1_ul').append("<li class='warning'>Warning : This model doesnt have a System Title.</li>");
			            }
			        });
			        hideLoader();
			    });
			}

			function getPhase2Summary(classId) {
			    showLoader();
			    var complete = 0;
			    var incomplete = 0;
			    $('#ubmsuite_mcs_model_review_ubm_phase2_ul').empty();
			    $('#tab-4').show();
			    $('#tab-2').hide();
			    $('#tab-3').hide();
			    $('#tab-1').hide();
			    $('#tab-5').hide();
			    $('#tab-6').hide();
			    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_getallchecklistitems.php?callback=?', { //JSONP Request
			        username: window.username,
			        key: window.key,
			        activeModelUUID: window.activeModelUUID
			    }, function(res, status) {
			        $.each(res, function(i, item) {
			            if (item.line_number >= 25 && item.line_number <= 30 && item.status == "TRUE") {
			                $('#ubmsuite_mcs_model_review_ubm_phase2_ul').append("<li class='success'>" + item.instruction_detail + "<br>Completed By: " + item.preparer_username + "</li>");
			                complete++;

			            } else if (item.line_number >= 25 && item.line_number <= 30) {
			                $('#ubmsuite_mcs_model_review_ubm_phase2_ul').append("<li class='warning'>Warning : <a href='#mcs_setup_checklist_p2'>" + item.instruction_detail + "</li>");
			                incomplete++;

			            }
			        });
			        if (classId == 2) {
			            if (incomplete != 0) {
			                var percentComplete = complete / incomplete * 100 + "%";
			            } else {
			                var percentComplete = 100 + "%";
			            }
			            $('#ubmsuite_mcs_model_review_ubm_phase2_ul').empty();
			            $('#ubmsuite_mcs_model_review_ubm_phase2_ul').append("<li class='success'>Items Completed: " + complete + "</li>");
			            $('#ubmsuite_mcs_model_review_ubm_phase2_ul').append("<li class='warning'>Items Incomplete: " + incomplete + "</li>");
			            $('#ubmsuite_mcs_model_review_ubm_phase2_ul').append("<li class='success'>" + percentComplete + " Complete</li>");
			        }
			        hideLoader();
			    });
			}


			function getPhase3Summary(classId) {
			    showLoader();
			    var complete = 0;
			    var incomplete = 0;
			    $('#ubmsuite_mcs_model_review_ubm_phase3_ul').empty();
			    $('#tab-5').show();
			    $('#tab-2').hide();
			    $('#tab-3').hide();
			    $('#tab-4').hide();
			    $('#tab-1').hide();
			    $('#tab-6').hide();
			    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_getallchecklistitems.php?callback=?', { //JSONP Request
			        username: window.username,
			        key: window.key,
			        activeModelUUID: window.activeModelUUID
			    }, function(res, status) {
			        $.each(res, function(i, item) {
			            if (item.line_number >= 34 && item.line_number <= 40 && item.status == "TRUE") {
			                $('#ubmsuite_mcs_model_review_ubm_phase3_ul').append("<li class='success'>" + item.instruction_detail + "<br>Completed By: " + item.preparer_username + "</li>");
			                complete++;

			            } else if (item.line_number >= 34 && item.line_number <= 40) {
			                $('#ubmsuite_mcs_model_review_ubm_phase3_ul').append("<li class='warning'>Warning : <a href='#mcs_setup_checklist_p3'>" + item.instruction_detail + "</li>");
			                incomplete++;

			            }
			        });
			        if (classId == 2) {
			            if (incomplete != 0) {
			                var percentComplete = complete / incomplete * 100 + "%";
			            } else {
			                var percentComplete = 100 + "%";
			            }
			            $('#ubmsuite_mcs_model_review_ubm_phase3_ul').empty();
			            $('#ubmsuite_mcs_model_review_ubm_phase3_ul').append("<li class='success'>Items Completed: " + complete + "</li>");
			            $('#ubmsuite_mcs_model_review_ubm_phase3_ul').append("<li class='warning'>Items Incomplete: " + incomplete + "</li>");
			            $('#ubmsuite_mcs_model_review_ubm_phase3_ul').append("<li class='success'>" + percentComplete + " Complete</li>");
			        }
			        hideLoader();
			    });

			}


			function getPhase4Summary(classId) {
			    showLoader();
			    var complete = 0;
			    var incomplete = 0;
			    $('#ubmsuite_mcs_model_review_ubm_phase4_ul').empty();
			    $('#tab-6').show();
			    $('#tab-2').hide();
			    $('#tab-3').hide();
			    $('#tab-4').hide();
			    $('#tab-5').hide();
			    $('#tab-1').hide();
			    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_getallchecklistitems.php?callback=?', { //JSONP Request
			        username: window.username,
			        key: window.key,
			        activeModelUUID: window.activeModelUUID
			    }, function(res, status) {
			        $.each(res, function(i, item) {
			            if (item.line_number >= 44 && item.line_number <= 76 && item.status == "TRUE") {
			                $('#ubmsuite_mcs_model_review_ubm_phase4_ul').append("<li class='success'>" + item.instruction_detail + "<br>Completed By: " + item.preparer_username + "</li>");
			                complete++;

			            } else if (item.line_number >= 44 && item.line_number <= 76) {
			                $('#ubmsuite_mcs_model_review_ubm_phase4_ul').append("<li class='warning'>Warning : <a href='#mcs_setup_checklist_p4_b1'>" + item.instruction_detail + "</li>");
			                incomplete++;
			            }
			        });
			        if (classId == 2) {
			            if (incomplete != 0) {
			                var percentComplete = complete / incomplete * 100 + "%";
			            } else {
			                var percentComplete = 100 + "%";
			            }
			            $('#ubmsuite_mcs_model_review_ubm_phase4_ul').empty();
			            $('#ubmsuite_mcs_model_review_ubm_phase4_ul').append("<li class='success'>Items Completed: " + complete + "</li>");
			            $('#ubmsuite_mcs_model_review_ubm_phase4_ul').append("<li class='warning'>Items Incomplete: " + incomplete + "</li>");
			            $('#ubmsuite_mcs_model_review_ubm_phase4_ul').append("<li class='success'>" + percentComplete + " Complete</li>");
			        }
			        hideLoader();
			    });

			}
			 <!-- Model Summary -->