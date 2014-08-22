function checkEmailVerification() {
    $.getJSON('http://api.universalbusinessmodel.com/CheckEmailVerification.php?callback=?', { //JSONP Request
        key: window.key,
        username: window.username
    }, function(res, status) {
        if (res.email_activation_status == "1") {
            alert("Account Successfully Verified");
            window.location = "#models"
        } else {
            alert("This account has not yet been activated.");
        }
    });
}