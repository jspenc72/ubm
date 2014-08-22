function userSignIn() {
    event.preventDefault();
    var si_email = document.getElementById("si_email").value;
    var si_passWord = document.getElementById("si_pw").value;
    var si_userName = si_email.split("@", 1).toString();
    $.getJSON('http://api.universalbusinessmodel.com/ubms_usrsi.php?callback=?', { //JSONP Request
        key: window.key,
        username: si_userName,
        password: si_passWord
    }, function(res, status) {
        $('#si_pw').val("");
        if (res.validation == 0) {
            $().toastmessage('showErrorToast', res.message);
            $('#result').empty().append("<p>" + res.message + "</p>");
            document.getElementById("si_pw").focus();
        } else {
            if (res.validation != 0) {
                $('#result').empty().append("<p>Performing your sign in request...</p>");
                $("#draggable_circle_linkTo_openPointsPage").attr("href", "#open_points_action_items");
                window.username = si_userName;
                window.accounttype = res.accountType;
                switch (res.validation) {
                    case 1:
                        window.location = "#models";
                        break;
                    case 2:
                        alert(res.message);
                        window.location = "#license_agreement_verification";
                        break;
                    case 3:
                        alert(res.message);
                        $("#initialChangePasssword").popup("open");
                        break;
                    case 4:
                        alert(res.message);
                        window.location = "#account_verification";
                        break;
                    default:
                        alert("Unknown Error");
                        break;
                }
            }
        }
    });
}