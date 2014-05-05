function sendActivationEmail() {
               
    event.preventDefault();
    //  alert(reg_asswd2);
    var reg_email = document.getElementById("emailForActivation").value;
    $.getJSON('http://api.universalbusinessmodel.com/ubms_usreg.php?callback=?', {
        key : window.key,
        email : reg_email,
        password : reg_passwd1,
        username : reg_username,
        licenseAgreement : "Signed",
        termsOfService : "Signed"
    }, function(res, status) {

        //alert(res.message);
        if ( status = "SUCCESS") {
            $().toastmessage('showSuccessToast', 'Your username is ' + reg_username);
            $().toastmessage('showNoticeToast', res.message);
            $('#registration_form').each(function() {
            this.reset();
        });
        }
        $.mobile.loading("hide");
        //Hide Loading Message
        window.location = "#account_verification";  //Need to modify server side to check if username already exists, if so send a callback to notify the user, Only allow change window location if the user account was created successfully.
    });

}