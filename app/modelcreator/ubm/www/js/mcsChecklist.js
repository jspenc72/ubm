//Complete MCS Checklist Tasks
function submitGettingStartedPreparedBy() {
    window.MCSTaskId = 5;
    submitMCSTaskPreparedByRecord();
}

function setActiveTaskIncomplete() {
    if (document.getElementByClassName("reviewedBy_actionRequired_input").value == null) {
        $().toastmessage('showWarningToast', "You must enter a required action!");
    } else {
        $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_changePreparedByToIncomplete.php?callback=?', { //JSONP Request
            key: window.key,
            activeModelUUID: window.activeModelUUID,
            taskId: window.MCSTaskId
        }, function(res, status) {
            $().toastmessage('showNoticeToast', res.message);
            getModelCreationSuiteChecklistItems();
        });
    }
}

function setActiveMCSTaskId(MCSTaskId) {
    if (MCSTaskId == 5) {
        $("#gettingStarted_continueToNextPhase_button").remove();
        $('#continue_button').append("<a href='#mcs_setup_checklist_CS' data-role='button' id='gettingStarted_continueToNextPhase_button' onclick='submitGettingStartedPreparedBy()' data-inline='true'>Continue to the Next Phase</a>").trigger("create");
    }
    //alert("The active task is: "+MCSTaskId);
    window.MCSTaskId = MCSTaskId;
    var date = new Date();
    window.MCSTaskPreparedByStartTime = date;
    //Sets the current time as the task start time for the preparer.
    var currentPage;
    window.activeubm_page = currentPage;
    //$("#" + currentPage + "_prepareTaskPopup").popup('open');
}

function submitMCSTaskPreparedByRecord() {
    if (window.MCSTaskId > 0) {
        $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_submitTaskPreparedBy.php?callback=?', { //JSONP Request
            key: window.key,
            activeModelUUID: window.activeModelUUID,
            taskId: window.MCSTaskId,
            startTime: window.MCSTaskPreparedByStartTime,
            username: window.username
        }, function(res, status) {
            $().toastmessage('showNoticeToast', res.message);
            getModelCreationSuiteChecklistItems();
        });
    } else {
        $().toastmessage('showNoticeToast', "Something went wrong, The Task Id is currently set to 0. Reopen your browser and try again. ");
    }
}

function submitMCSTaskReviewedByRecord() {
    if (window.MCSTaskId > 0) {
        $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_submitTaskReviewedBy.php?callback=?', { //JSONP Request
            key: window.key,
            activeModelUUID: window.activeModelUUID,
            taskId: window.MCSTaskId,
            startTime: window.MCSTaskStartTime,
            username: window.username
        }, function(res, status) {
            $().toastmessage('showNoticeToast', res.message);
            getModelCreationSuiteChecklistItems();
        });
    } else {
        $().toastmessage('showNoticeToast', "Something went wrong, The Task Id is currently set to 0. Reopen your browser and try again. ");
    }
}

function submitMCSTaskFinalReviewedByRecord() {
    if (window.MCSTaskId > 0) {
        $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_submitTaskFinalReviewedBy.php?callback=?', { //JSONP Request
            key: window.key,
            activeModelUUID: window.activeModelUUID,
            taskId: window.MCSTaskId,
            startTime: window.MCSTaskStartTime,
            username: window.username
        }, function(res, status) {
            $().toastmessage('showNoticeToast', res.message);
            getModelCreationSuiteChecklistItems();
        });
    } else {
        $().toastmessage('showNoticeToast', "Something went wrong, The Task Id is currently set to 0. Reopen your browser and try again. ");
        return false;
    }
}

function submitMCS_phaseSetup_submitT4(MCSTaskId) {
    if (MCSTaskId == 4) {
        //alert("this is a test.");
        var modelOwnerLegalEntityVal = document.getElementById("mcs_setup_checklist_setup_identification_setup_popup_form_legalentity").value;
        var modelOwnerCCODEVal = document.getElementById("mcs_setup_checklist_setup_identification_setup_popup_form_ccode").value;
        var modelContactNameVal = document.getElementById("mcs_setup_checklist_setup_identification_setup_popup_form_model_contactname").value;
        var modelContactPhoneVal = document.getElementById("mcs_setup_checklist_setup_identification_setup_popup_form_modelcontactphone").value;
        var modelContactEmailVal = document.getElementById("mcs_setup_checklist_setup_identification_setup_popup_form_modelcontactemail").value;
        var modelPurposeVal = document.getElementById("mcs_setup_checklist_setup_identification_setup_popup_form_purpose").value;
        var modelScopeVal = document.getElementById("mcs_setup_checklist_setup_identification_setup_popup_form_scope").value;
        var catBusinessVal = $('#mcs_setup_checklist_setup_identification_setup_popup_form_category_business').is(':checked');
        var catEducationVal = $('#mcs_setup_checklist_setup_identification_setup_popup_form_category_education').is(':checked');
        var catFamilyVal = $('#mcs_setup_checklist_setup_identification_setup_popup_form_category_family').is(':checked');
        var catHealthVal = $('#mcs_setup_checklist_setup_identification_setup_popup_form_category_health').is(':checked');
        var catMedicalVal = $('#mcs_setup_checklist_setup_identification_setup_popup_form_category_medical').is(':checked');
        var catProductivityVal = $('#mcs_setup_checklist_setup_identification_setup_popup_form_category_productivity').is(':checked');
        var catUtilityVal = $('#mcs_setup_checklist_setup_identification_setup_popup_form_category_utilities').is(':checked');
        var catChurchVal = $('#mcs_setup_checklist_setup_identification_setup_popup_form_category_church').is(':checked');
        var catCoopVal = $('#mcs_setup_checklist_setup_identification_setup_popup_form_category_coop').is(':checked');
        var catOtherVal = $('#mcs_setup_checklist_setup_identification_setup_popup_form_category_other').is(':checked');
        var formStringArray = new Array();
        formStringArray.push({
            modelOwnerLegalEntityVal: modelOwnerLegalEntityVal,
            modelOwnerCCODEVal: modelOwnerCCODEVal,
            modelContactNameVal: modelContactNameVal,
            modelContactPhoneVal: modelContactPhoneVal,
            modelContactEmailVal: modelContactEmailVal,
            modelPurposeVal: modelPurposeVal,
            modelScopeVal: modelScopeVal,
            catBusinessVal: catBusinessVal,
            catEducationVal: catEducationVal,
            catFamilyVal: catFamilyVal,
            catHealthVal: catHealthVal,
            catMedicalVal: catMedicalVal,
            catProductivityVal: catProductivityVal,
            catUtilityVal: catUtilityVal,
            catChurchVal: catChurchVal,
            catCoopVal: catCoopVal,
            catOtherVal: catOtherVal,
        });
        $.each(formStringArray, function(index, val) {
            if (!val.modelOwnerLegalEntityVal) {
                $().toastmessage('showErrorToast', "Your model must have a legal entity associated with it.");
            } else {
                if (!val.modelOwnerCCODEVal) {
                    $().toastmessage('showErrorToast', "Your model must have an associated CCODE.");
                } else {
                    if (!val.modelContactNameVal) {
                        $().toastmessage('showErrorToast', "A model must have a contact associated with it.");
                    } else {
                        if (!val.modelContactPhoneVal) {
                            $().toastmessage('showErrorToast', "The model contact must have a valid phone number.");
                        } else {
                            if (!val.modelContactEmailVal) {
                                $().toastmessage('showErrorToast', "The model contact must have a valid email.");
                            } else {
                                if (!val.modelPurposeVal) {
                                    $().toastmessage('showErrorToast', "A model must have a purpose.");
                                } else {
                                    if (!val.modelScopeVal) {
                                        $().toastmessage('showErrorToast', "A model must be limited to a specific scope.");
                                    } else {
                                        $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_phaseSetup_submitT4.php?callback=?', { //JSONP Request
                                            key: window.key,
                                            username: window.username,
                                            activeModelUUID: window.activeModelUUID,
                                            modelOwnerLegalEntity: modelOwnerLegalEntityVal,
                                            modelOwnerCCODE: modelOwnerCCODEVal,
                                            modelContactName: modelContactNameVal,
                                            modelContactPhone: modelContactPhoneVal,
                                            modelContactEmail: modelContactEmailVal,
                                            modelPurpose: modelPurposeVal,
                                            modelScope: modelScopeVal,
                                            catBusiness: catBusinessVal,
                                            catEducation: catEducationVal,
                                            catFamily: catFamilyVal,
                                            catHealth: catHealthVal,
                                            catMedical: catMedicalVal,
                                            catProductivity: catProductivityVal,
                                            catUtility: catUtilityVal,
                                            catChurch: catChurchVal,
                                            catCoop: catCoopVal,
                                            catOther: catOtherVal
                                        }, function(res, status) {
                                            if (status == "success") {
                                                //alert(res.message);
                                                setActiveMCSTaskId(MCSTaskId);
                                                setTimeout(function() {
                                                    submitMCSTaskPreparedByRecord();
                                                }, 1000);
                                            }
                                        });
                                    }
                                }
                            }
                        }
                    }
                }
            }
        });
    } else {
        if (MCSTaskId == 5) {} else {}
    }
}

function submitMCS_phase1_submitT17(MCSTaskId) {
    if (MCSTaskId == 17) {
        var conceptualDefinition = document.getElementById("mcs_setup_checklist_p1_primaryObjects_setup_popup_form_conceptualDefinition").value;
        var missionStatement = document.getElementById("mcs_setup_checklist_p1_primaryObjects_setup_popup_form_missionStatement").value;
        var visionStatement = document.getElementById("mcs_setup_checklist_p1_primaryObjects_setup_popup_form_visionStatement").value;
        var formStringArray = new Array();
        formStringArray.push({
            conceptualDefinition: conceptualDefinition,
            missionStatement: missionStatement,
            visionStatement: visionStatement,
        });
        $.each(formStringArray, function(index, val) {
            if (!val.conceptualDefinition) {
                $().toastmessage('showErrorToast', "Your model must have at least one conceptual definition.");
            } else {
                if (!val.missionStatement) {
                    $().toastmessage('showErrorToast', "Your model must have a mission statement.");
                } else {
                    if (!val.visionStatement) {
                        $().toastmessage('showErrorToast', "A model must have a vision statement.");
                    } else {
                        $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_phase1_submitT17.php?callback=?', { //JSONP Request
                            key: window.key,
                            username: window.username,
                            activeModelUUID: window.activeModelUUID,
                            conceptualDefinition: conceptualDefinition,
                            missionStatement: missionStatement,
                            visionStatement: visionStatement
                        }, function(res, status) {
                            $().toastmessage('showNoticeToast', status);
                            if (status == "success") {
                                //alert(res.message);
                                setActiveMCSTaskId(MCSTaskId);
                                setTimeout(function() {
                                    submitMCSTaskPreparedByRecord();
                                }, 1000);
                            }
                        });
                    }
                }
            }
        });
    } else {
        if (MCSTaskId == 5) {} else {}
    }
}