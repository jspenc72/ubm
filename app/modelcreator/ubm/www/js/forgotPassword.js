function resetPassword() {
    var email = document.getElementById("forgotPassword_popup_email_input").value;
    $.getJSON('http://api.universalbusinessmodel.com/forgot_password.php?callback=?', { //JSONP Request
        key: window.key,
        email: email
    }, function(res, status) {
        if (status == "success") {
            $('#forgotPassword_form').each(function() {
                this.reset();
                $("#forgotPassword_popup").popup('close');
            });
        }
        $().toastmessage('showNoticeToast', "" + res.message + "");
    });
}