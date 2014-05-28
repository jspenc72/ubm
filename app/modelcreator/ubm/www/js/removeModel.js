function removeModel() {
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelCreationSuite_removeModel.php?callback=?', { //JSONP Request
        key: window.key,
        activeModelUUID: window.activeModelUUID
    }, function(res, status) {
        $().toastmessage('showNoticeToast', res.message);
        window.location = "#ubmsuite_SelectBusinessModel";
    });
}