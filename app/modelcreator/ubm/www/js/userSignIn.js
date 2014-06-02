function userSignIn() {
    event.preventDefault();
    var si_email = document.getElementById("si_email").value;
    var si_passWord = document.getElementById("si_pw").value;
    var si_userName = si_email.split("@", 1).toString();
    window.username = si_userName;
    $.getJSON('http://api.universalbusinessmodel.com/ubms_usrsi.php?callback=?', { //JSONP Request
        key: window.key,
        username: si_userName,
        password: si_passWord
    }, function(res, status) {
        $('#sign_in_form').each(function() {
            this.reset();
        });
        if (res.validation == 0) {
            $().toastmessage('showErrorToast', res.message);
            $('#result').empty().append("<center><p style='background-color:black'>" + res.message + "</p></center>");
            document.getElementById("si_email").focus();
        } else {
            if (res.validation != 0) {
                $('#result').empty().append("<center><p style='background-color:black'>Performing your sign in request...</p></center>");
                walkthrough('ubmsuite_SelectBusinessModel', function(status) {
                    var walkthroughStatus = status;
                    $("#draggable_circle_linkTo_openPointsPage").attr("href", "#open_points_action_items");
                    window.accounttype = res.accountType;
                    switch (res.validation) {
                        case 1:
                            console.log(walkthroughStatus);
                            if (walkthroughStatus == 1) {
                                window.location = "#ubmsuite_SelectBusinessModel";
                            } else {
                                window.location = "#gettingStarted";
                            }
                            break;
                        case 2:
                            $().toastmessage('showNoticeToast', res.message);
                            window.location = "#license_agreement_verification";
                            break;
                        case 3:
                            $().toastmessage('showNoticeToast', res.message);
                            $("#initialChangePasssword").popup("open");
                            break;
                        case 4:
                            $().toastmessage('showNoticeToast', res.message);
                            window.location = "#account_verification";
                            break;
                        default:
                            $().toastmessage('showErrorToast', "Unknown Error");
                            break;
                    }
                });

            }
        }
    });
}

function submitNewPassword() {
    event.preventDefault();
    var password = document.getElementById("initialChangePasssword_form_changePassword").value;
    var verifyPassword = document.getElementById("initialChangePasssword_form_verfyChangePassword").value;
    if (password != verifyPassword) {
        $().toastmessage('showErrorToast', "Your passwords are not the same!");
    } else {
        $.getJSON('http://api.universalbusinessmodel.com/ubms_changePassword.php?callback=?', {
            key: window.key,
            username: window.username,
            password: password
        }, function(res, status) {
            $("#initialChangePasssword").popup("close");
            $('#initialChangePasssword_form').each(function() {
                this.reset();
            });
            window.location = "sign_in_sign_up";
            $().toastmessage('showSuccessToast', "Your password has been changed, please log in.");
            location.reload();
        });
    }
}

function walkthrough(pageName, cb) {
    $.getJSON('http://api.universalbusinessmodel.com/getWalkthroughStatus.php?callback=?', {
        key: window.key,
        username: window.username,
        pageName: pageName
    }, function(res, status) {
        var walkthrough = res.status;
        cb(walkthrough);
    });

}

function setWalkthroughAsComplete(pageName) {
    $.getJSON('http://api.universalbusinessmodel.com/setWalkthroughStatus.php?callback=?', {
        key: window.key,
        username: window.username,
        pageName: pageName
    }, function(res, status) {

    });
}