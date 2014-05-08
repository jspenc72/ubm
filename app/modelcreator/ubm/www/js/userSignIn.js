function userSignIn() {				
				event.preventDefault();
				var si_email = document.getElementById("si_email").value;
				var si_passWord = document.getElementById("si_pw").value;
				var si_userName = si_email.split("@", 1).toString();
				window.username = si_userName;
				//var si_userName = si_userNameArray.toString();
				//				alert(si_userName);
				if (si_userName.length < 1) {
					$().toastmessage('showErrorToast', "You must enter a username!");
				} else {
					if (si_passWord.length < 1) {
						$().toastmessage('showErrorToast', "You must enter your password");
					} else {
						$('#result').empty().append('<center><p>Performing your sign in request...</p></center>');
						/* stop form from submitting normally */
						$.getJSON('http://api.universalbusinessmodel.com/ubms_usrsi.php?callback=?', {
							key : window.key,
							appname : "FindMyDriver",
							RQType : "userSignIn",
							email : si_email,
							username : si_userName,
							password : si_passWord
						}, function(res, status) {
							//				    alert(res.message);
							if (res.passwordStatus == 0) {
								//$("#initialChangePasssword_form").empty();
								$("#initialChangePasssword").popup("open");
							} else {
								if(res.activationStatus == 0 ) {
									window.location = "#account_verification";
									$().toastmessage('showErrorToast', "Your Account Has Not Been Activated");
								} else {
									if (res.validation == 'TRUE') {
										window.walkthrough = res.walkthrough;
										$('#result').empty().append('<center><p>' + res.message + res.validation + '</p></center>');
										$('#result').empty();
										window.accounttype = res.accounttype;
										if (res.accounttype == 'admin') {
											//admin only stuff here
											$().toastmessage('showNoticeToast', "You are an Admin");
											if(res.walkthrough == 0) {
												window.location ="#gettingStarted";
											} else {
												window.location = "#ubmsuite_SelectBusinessModel"	
											}
											//$('body').prepend('<div id="overlayTest" class="circleBase type2" style="z-index: 99999; position:fixed;"><a href="#openItem_popup" data-rel="popup" data-transition="slideup" class="ui-btn ui-icon-alert ui-btn-icon-notext ui-corner-all">No text</a><a href="#openItem_popup" data-rel="popup" data-transition="slideup" class="ui-btn ui-icon-action ui-btn-icon-notext ui-corner-all">No text</a><center><a href="#mcs_setup_checklist_setup_searchPopup" data-rel="popup" data-transition="slideup" class="ui-btn ui-icon-search ui-btn-icon-notext ui-corner-all">No text</a></center></div>');
											$(".circleBase").draggable();
										} else {
											if (res.accounttype == 'user') {
												$().toastmessage('showNoticeToast', "you are a user");
												if(res.walkthrough == 0) {
													window.location ="#gettingStarted";
												} else {
													window.location = "#ubmsuite_SelectBusinessModel"	
												}
												//Driver only stuff here
											} else {
												if (res.accounttype == 'dispatch') {
													$().toastmessage('showNoticeToast', "You are a dispatch");
													if(res.walkthrough == 0) {
													window.location ="#gettingStarted";
													} else {
														window.location = "#ubmsuite_SelectBusinessModel"	
													}

													//Dispatch only stuff here
												} else {
													if (res.accounttype == 'driver') {
														$().toastmessage('showNoticeToast', "You are a driver");
														if(res.walkthrough == 0) {
															window.location ="#gettingStarted";
														} else {
															window.location = "#ubmsuite_SelectBusinessModel"	
														}
													} else {
														$().toastmessage('showNoticeToast', "You do not have an account type!");
														if(res.walkthrough == 0) {
															window.location ="#gettingStarted";
															} else {
																window.location = "#ubmsuite_SelectBusinessModel"	
															}
													}
													//User has not been assigned an account type!
												}
											}
										}
									} else {
										$('#result').empty().append('<center><p>No account exists with that username or password. Click Register to create your free account</p></center>');
									}
									
								}
							}
							//						$('#result').empty().append('<center><p>'+ res.validation + '</p></center>');
							//					    alert(status);
						});
					}
				}
				//		alert("user Sign in Clicked");
				//	$.mobile.changePage( "#home", { transition: "fade", changeHash: false, reloadPage: true });
}

function submitNewPassword () {
	event.preventDefault();
	var password = document.getElementById("initialChangePasssword_form_changePassword").value;
	var verifyPassword = document.getElementById("initialChangePasssword_form_verfyChangePassword").value;
	if (password != verifyPassword) {
		$().toastmessage('showErrorToast', "Your passwords are not the same!");
	} else {
$.getJSON('http://api.universalbusinessmodel.com/ubms_changePassword.php?callback=?', {
		key : window.key,
		username : window.username,
		password : password
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

function gettingStarted () {
	$.getJSON('http://api.universalbusinessmodel.com/ubms_GettingStarted.php?callback=?', {
		key : window.key,
		username : window.username,
	}, function(res, status) {
		
	});
}
