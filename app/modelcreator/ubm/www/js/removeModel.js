function removeModel() {
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelCreationSuite_removeModel.php?callback=?', { //JSONP Request
        key: window.key,
        username: window.username,
        activeModelUUID: window.activeModelUUID
    }, function(res, status) {
        $("#ubmsuite_modelSettings_deleteModel_popup").popup("close");
        window.location = "#ubmsuite_SelectBusinessModel";
        $().toastmessage('showNoticeToast', res.message);
    });
}

function editModel() {
    $.getJSON('http://api.universalbusinessmodel.ubms_modelCreationSuite_editModelInformation.php?callback=?', { //JSONP Request
        key: window.key,
        activeModelUUID: window.activeModelUUID
    }, function(res, status) {
        $("#ubmsuite_modelSettings_editModel_popup").popup("close");
        $().toastmessage('showNoticeToast', res.message);
    });
}

function getModelInformation() {
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelCreationSuite_getModelInformation.php?callback=?', { //JSONP Request
        key: window.key,
        activeModelUUID: window.activeModelUUID
    }, function(res, status) {
        $("#ubmsuite_modelSettings_editModel_popup_form_title_input").val(res.modelTitle);
        $("#ubmsuite_modelSettings_editModel_popup_form_reference_input").val(res.modelReference);
        $("#ubmsuite_modelSettings_editModel_popup_form_description_textarea").val(res.modelDescription);

    });
}