//Model Management
function createModel() {
    if (!document.getElementById("ubmsuite_createModel_popup_newModel_form_reference").value) {
        $().toastmessage('showWarningToast', "You need a reference");
    } else {
        if (!document.getElementById("ubmsuite_createModel_popup_newModel_form_title").value) {
            $().toastmessage('showWarningToast', "You need a title");
        } else {
            if (!document.getElementById("ubmsuite_createModel_popup_newModel_form_description").value) {
                $().toastmessage('showWarningToast', "You need a description");
            } else {
                showLoader();
                $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_createModel.php?callback=?', { //JSONP Request
                    key: window.key,
                    reference: document.getElementById("ubmsuite_createModel_popup_newModel_form_reference").value,
                    modelTitle: document.getElementById("ubmsuite_createModel_popup_newModel_form_title").value,
                    description: document.getElementById("ubmsuite_createModel_popup_newModel_form_description").value,
                    username: window.username
                }, function(res, status) {
                    if (status == "success") { //Tests whether the json request was successful, if so it will clear the contents of the form submitted.
                        $().toastmessage('showSuccessToast', "" + res.message + "");
                        $('#ubmsuite_createModel_popup_newModel_form').each(function() {
                            this.reset();
                            $("#ubmsuite_createModel_popup").popup('close');
                        });
                    }
                });
                setTimeout(function() {
                    getMyModels();
                    hideLoader();
                }, 800);
            }
        }
    }


}

function getMyModels() { //Get all models in database where current user is the creator.
    showLoader();
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_getMyModels.php?callback=?', { //JSONP Request
        username: window.username,
        key: window.key
    }, function(res, status) {
        $('#ubmsuite_SelectBusinessModel_MyModels_ul').empty();
        $('#ubmsuite_SelectBusinessModel_MyModels_ul').append("<li data-role='list-divider'><center>Models I Created</center></li>");
        $('#ubmsuite_SelectBusinessModel_MyModels_ul').listview().listview("refresh");
        $.each(res, function(i, item) {
            $('#ubmsuite_SelectBusinessModel_MyModels_ul').append("<li id='creator_name_list_divider' data-role='list-divider' >Model Contact: " + item.model_contact_name + "</li>");
            $('#ubmsuite_SelectBusinessModel_MyModels_ul').append("<li><a href='#ubmsuite_modelDashboard' onclick='setActiveModel(" + item.UUID + ")'></br></br></br><h2 style='white-space:normal;'>Title: " + item.title + "</h2><p><strong>Model Reference: " + item.reference + "</strong></p><p style='white-space:normal;'>" + item.description + "</p><p class='ui-li-aside'>Creation Date:</br> <strong>" + item.created_date + "</strong></p></a></li>");
            $('#ubmsuite_SelectBusinessModel_MyModels_ul').listview().listview("refresh");
            $(".model_listItem").hover();
        });
        getSharedModels();
    });


}

function getSharedModels() { //Get all models in database where current user is the creator.
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_getSharedModels.php?callback=?', { //JSONP Request
        username: window.username,
        key: window.key
    }, function(res, status) {
        $('#ubmsuite_SelectBusinessModel_SharedModels_ul').empty();
        $('#ubmsuite_SelectBusinessModel_SharedModels_ul').append("<li data-role='list-divider'><center>Models Shared with Me</center></li>");
        $('#ubmsuite_SelectBusinessModel_SharedModels_ul').listview().listview("refresh");
        $.each(res, function(i, item) {
            if (window.username !== item.creator_id) {
                $('#ubmsuite_SelectBusinessModel_SharedModels_ul').append("<li data-role='list-divider' >Model Creator: " + item.model_contact_name + "</li>");
                $('#ubmsuite_SelectBusinessModel_SharedModels_ul').append("<li><a href='#ubmsuite_modelDashboard' onclick='setActiveModel(" + item.UUID + ")'></br></br></br><h2 style='white-space:normal;'>Title: " + item.title + "</h2><p><strong>Model Reference: " + item.reference + "</strong></p><p style='white-space:normal;'>" + item.description + "</p><p class='ui-li-aside'>Creation Date:</br> <strong>" + item.created_date + "</strong></p></a></li>");
                $('#ubmsuite_SelectBusinessModel_SharedModels_ul').listview().listview("refresh");
            }
        });
        hideLoader();
    });
}

function model_getuserswithaccess() {
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_getuserswithaccess.php?callback=?', { //JSONP Request
        key: window.key,
        username: window.username,
        activeModelUUID: window.activeModelUUID,
    }, function(res, status) {
        $('#ubmsuite_modelSettings_modelusers_ul').empty();
        $.each(res, function(i, item) {
            $('#ubmsuite_modelSettings_modelusers_ul').append("<li><a href='#' onclick='setSelectedModelUser(" + item.id + ")'>" + item.member_id + "</a></li>");
            $('#ubmsuite_modelSettings_modelusers_ul').listview().listview("refresh");
        });
    });
}

function setActiveModel(activeModelUUID) {
    $('.modelApp_title_header').empty();
    window.activeModelUUID = activeModelUUID;
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelCreationSuite_getModelName.php?callback=?', { //JSONP Request
        key: window.key,
        activeModelUUID: window.activeModelUUID,
    }, function(res, status) {
        $(".modelApp_title_header").append("Model / App Title: " + res + "");
    });
}

function shareModel() {
    event.preventDefault();
    var invite_email = document.getElementById("ubmsuite_modelSettings_shareModel_inviteEmail").value;
    var invite_username = invite_email.split("@", 1).toString();
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_addusertomodel.php?callback=?', { //JSONP Request
        key: window.key,
        username: window.username,
        activeModelUUID: window.activeModelUUID,
        memberRole: document.getElementById("ubmsuite_modelSettings_shareModel_setRole").value,
        inviteUsername: invite_username,
        inviteEmail: document.getElementById("ubmsuite_modelSettings_shareModel_inviteEmail").value
    }, function(res, status) {
        if (status == "success") { //Tests whether the json request was successful, if so it will clear the contents of the form submitted.
            $('#ubmsuite_modelSettings_shareModel_popup_form').each(function() {
                this.reset();
            });
        }
    });
    model_getuserswithaccess();
}

function removeUserFromModel() {
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_removeUserFromModel.php?callback=?', { //JSONP Request
        key: window.key,
        username: window.username,
        selectedUserId: window.selectedModelUserId,
        activeModelUUID: window.activeModelUUID
    }, function(res, status) {
        //alert(res.message);
    });
    $("#ubmsuite_modelSettings_removeUser_popup").popup('close');
    model_getuserswithaccess();
}

function confirmationPopup() { //Remove user from model confirmation
    $("#ubmsuite_modelSettings_modifyUser_popup").popup('close');
    setTimeout(function() {
        $("#ubmsuite_modelSettings_removeUser_popup").popup('open');
    }, 500);

}

function setSelectedModelUser(selectedUserId) {
    window.selectedModelUserId = selectedUserId;
    $("#ubmsuite_modelSettings_modifyUser_popup").popup('open');
}