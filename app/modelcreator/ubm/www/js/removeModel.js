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