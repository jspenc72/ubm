function removeModel() {
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelCreationSuite_removeModel.php?callback=?', { //JSONP Request
        key: window.key,
        username: window.username,
        activeModelUUID: window.activeModelUUID
    }, function(res, status) {
        $().toastmessage('showNoticeToast', res.message);
        getMyModels();
        window.location = "#ubmsuite_SelectBusinessModel";
    });
}