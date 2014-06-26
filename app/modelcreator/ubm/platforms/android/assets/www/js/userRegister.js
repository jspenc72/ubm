function userRegister() {
    showLoader();
    event.preventDefault();
    var reg_passwd1 = document.getElementById("reg_pw1").value;
    //  alert(reg_passwd1);
    var reg_passwd2 = document.getElementById("reg_pw2").value;
    //  alert(reg_passwd2);
    var reg_email = document.getElementById("reg_email").value;
    var terms_of_service = document.getElementById("register_termsOfService").checked;
    var license_agreement = document.getElementById("register_license_agreement").checked;

    if (terms_of_service == false) {
        $().toastmessage('showErrorToast', "You Must Agree to the Terms of Service!");
        return false;
        hideLoader();
    } else {
        if (license_agreement == false) {
            $().toastmessage('showErrorToast', "You Must Agree to the License Agreement!");
            return false;
            hideLoader();
        } else {
            var reg_username = reg_email.split("@", 1).toString();
            window.username = reg_username;

            //alert(reg_username);
            if (reg_passwd1.length < 8) {
                $().toastmessage('showErrorToast', "Your password must be at least 8 characters.");
                //alert("Your password must be at least 8 characters.");
                $.mobile.loading("hide");
            } else {
                if (reg_passwd1 == reg_passwd2) {
                    //alert("passwords match!");
                    $.getJSON('http://api.universalbusinessmodel.com/ubms_usreg.php?callback=?', {
                        key: window.key,
                        appname: "FindMyDriver",
                        RQType: "userRegister",
                        email: reg_email,
                        password: reg_passwd1,
                        username: reg_username,
                        licenseAgreement: "Signed",
                        termsOfService: "Signed"
                    }, function(res, status) {

                        //alert(res.message);
                        if (status = "SUCCESS") {
                            $().toastmessage('showSuccessToast', 'Your username is ' + reg_username);
                            $().toastmessage('showNoticeToast', res.message);
                            $('#registration_form').each(function() {
                                this.reset();
                            });
                        }
                        hideLoader();
                        //Hide Loading Message
                        window.location = "#account_verification"; //Need to modify server side to check if username already exists, if so send a callback to notify the user, Only allow change window location if the user account was created successfully.
                    });
                } else {
                    $().toastmessage('showErrorToast', "The passwords you entered do not match!");
                }

            }

        }
    }
}