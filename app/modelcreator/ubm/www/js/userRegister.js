function userRegister() {
                //Show Loader Message
                var $this = $("#page_loading_message"), theme = $this.jqmData("theme") || $.mobile.loader.prototype.options.theme, msgText = $this.jqmData("msgtext") || $.mobile.loader.prototype.options.text, textVisible = $this.jqmData("textvisible") || $.mobile.loader.prototype.options.textVisible, textonly = !!$this.jqmData("textonly");
                html = $this.jqmData("html") || "";

                $.mobile.loading("show", {
                    text : msgText,
                    textVisible : textVisible,
                    theme : theme,
                    textonly : textonly,
                    html : html
                });
                //End Show Loader Message
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
                                    $.mobile.loading("hide");
                        return false;
                    } else {
                        if (license_agreement == false) {
                        	$().toastmessage('showErrorToast', "You Must Agree to the License Agreement!");
                                    $.mobile.loading("hide");
                            return false;
                            }
                        else {
               
                            var reg_username = reg_email.split("@", 1).toString();
                            window.username = reg_username;
                            
                            //alert(reg_username);
							if(reg_passwd1.length<8){
								$().toastmessage('showErrorToast', "Your password must be at least 8 characters.");
								//alert("Your password must be at least 8 characters.");
	                                    $.mobile.loading("hide");								
							}else{
	                            if (reg_passwd1 == reg_passwd2) {
	                                //alert("passwords match!");
	                                $.getJSON('http://api.universalbusinessmodel.com/ubms_usreg.php?callback=?', {
	                                    key : window.key,
	                                    appname : "FindMyDriver",
	                                    RQType : "userRegister",
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
	                                    window.location = "#account_verification"   //Need to modify server side to check if username already exists, if so send a callback to notify the user, Only allow change window location if the user account was created successfully.
	                                });
	                            } else {
	                            	$().toastmessage('showErrorToast', "The passwords you entered do not match!");
	                            }
								
							}

                     }
                }
            }