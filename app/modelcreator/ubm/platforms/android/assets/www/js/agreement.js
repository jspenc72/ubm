function agreeToLicenseAgreement() {
    $.getJSON('http://api.universalbusinessmodel.com/agreements.php?callback=?', { //JSONP Request
        key: window.key,
        activeModelUUID: window.activeModelUUID,
        licenseAgreementSetup: 1
    }, function(res, status) {
        $("#mcs_setup_1_popUp").popup("close");
        setActiveMCSTaskId(1);
        submitMCSTaskPreparedByRecord();
        $().toastmessage('showNoticeToast', res.message);
    });
}