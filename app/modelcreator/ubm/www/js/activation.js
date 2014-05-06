function sendActivationEmail() {
    event.preventDefault();
    var email = document.getElementById("emailForActivation").value;
    $.getJSON('http://api.universalbusinessmodel.com/ubms_ActivateAccount.php?callback=?', {
        key : window.key,
        email : email,
    }, function(res, status) {
        if (status) {
            $().toastmessage('showNoticeToast', res.message);
            window.location="#sign_in_sign_up";
        }
        });
}