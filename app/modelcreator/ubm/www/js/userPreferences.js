function updateUserPreferences() {
				updatePhoneNumber();
			}

			function updatePhoneNumber() {
				if (document.getElementById("ubmsuite_UserPreferences_selectCarrier").value != "Verizon") {
					$().toastmessage('showWarningToast', "Your Carrier is not currently supported!");
				}

				$.getJSON('http://api.universalbusinessmodel.com/app_users_preferences_phoneNumberCarrier.php?callback=?', {//JSONP Request
					carrier : document.getElementById("ubmsuite_UserPreferences_selectCarrier").value,
					phoneNumber : document.getElementById("ubmsuite_UserPreferences_cell").value,
					username : window.username
				}, function(res, status) {
					$().toastmessage('showSuccessToast', "Phone Number Successfully Added!");
				});
			}