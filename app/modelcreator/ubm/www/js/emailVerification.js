function checkEmailVerification() {
    $.getJSON('http://api.universalbusinessmodel.com/CheckEmailVerification.php?callback=?', { //JSONP Request
        key: window.key,
        username: window.username
    }, function(res, status) {
        alert(res.email_activation_status);
        if (res.email_activation_status == "1") {
            $().toastmessage('showSuccessToast', "Account Successfully Verified");
            walkthrough('ubmsuite_SelectBusinessModel', function(status) {
                if (status == 0) {
                    window.location = "#gettingStarted";
                } else {
                    window.location = "#ubmsuite_SelectBusinessModel";
                }
            });
        } else {
            $().toastmessage('showErrorToast', "Your Account Has Not Been Activated");
        }
    });
}