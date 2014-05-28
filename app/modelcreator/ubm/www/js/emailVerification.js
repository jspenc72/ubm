    function checkEmailVerification() {
        $.getJSON('http://api.universalbusinessmodel.com/CheckEmailVerification.php?callback=?', { //JSONP Request
            key: window.key,
            username: window.username
        }, function(res, status) {
            alert(res.email_activation_status);
            if (res.email_activation_status == "1") {
                $().toastmessage('showSuccessToast', "Account Successfully Verified");
                window.location = "#gettingStarted";
            } else {
                $().toastmessage('showErrorToast', "Your Account Has Not Been Activated");
            }
        });
    }