function sendActivationEmail() {
    event.preventDefault();
    var email = document.getElementById("emailForActivation").value;
    $.getJSON('http://api.universalbusinessmodel.com/ubms_ActivateAccount.php?callback=?', {
        key: window.key,
        email: email,
    }, function(res, status) {
        if (status) {
            $().toastmessage('showNoticeToast', res.message);
            $('#email_has_been_sent').empty().append("<p>The email has been sent, please click the link that was emailed to you, then click continue.");
        }
    });
}