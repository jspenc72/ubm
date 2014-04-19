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
							if (res.validation == 'TRUE') {
								$('#result').empty().append('<center><p>' + res.message + res.validation + '</p></center>');
								$('#result').empty();
								window.accounttype = res.accounttype;
							} else {
								$('#result').empty().append('<center><p>No account exists with that username or password. Click Register to create your free account</p></center>');
							}
							if (res.accounttype == 'admin') {
								//admin only stuff here
								$().toastmessage('showNoticeToast', "You are an Admin");
								window.location = "#ubmsuite_SelectBusinessModel"	
								//$('body').prepend('<div id="overlayTest" class="circleBase type2" style="z-index: 99999; position:fixed;"><a href="#openItem_popup" data-rel="popup" data-transition="slideup" class="ui-btn ui-icon-alert ui-btn-icon-notext ui-corner-all">No text</a><a href="#openItem_popup" data-rel="popup" data-transition="slideup" class="ui-btn ui-icon-action ui-btn-icon-notext ui-corner-all">No text</a><center><a href="#mcs_setup_checklist_setup_searchPopup" data-rel="popup" data-transition="slideup" class="ui-btn ui-icon-search ui-btn-icon-notext ui-corner-all">No text</a></center></div>');
								$(".circleBase").draggable();
							} else {
								if (res.accounttype == 'user') {
									$().toastmessage('showNoticeToast', "you are a user");
									window.location = "#ubmsuite_SelectBusinessModel"
									//Driver only stuff here
								} else {
									if (res.accounttype == 'dispatch') {
										$().toastmessage('showNoticeToast', "You are a dispatch");
										window.location = "#ubmsuite_SelectBusinessModel"

										//Dispatch only stuff here
									} else {
										if (res.accounttype == 'driver') {
											$().toastmessage('showNoticeToast', "You are a driver");
											window.location = "#ubmsuite_SelectBusinessModel"
										}
										//User has not been assigned an account type!
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