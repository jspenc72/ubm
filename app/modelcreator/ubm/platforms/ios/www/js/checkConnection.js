function checkConnection() {
				//$().toastmessage('showNoticeToast', 'Check Connection Called');
				var networkState = navigator.connection.type;
				$().toastmessage('showNoticeToast', 'After Network State');
				var states = {};
				states[Connection.UNKNOWN] = 'Unknown connection';
				states[Connection.ETHERNET] = 'Ethernet connection';
				states[Connection.WIFI] = 'WiFi connection';
				states[Connection.CELL_2G] = 'Cell 2G connection';
				states[Connection.CELL_3G] = 'Cell 3G connection';
				states[Connection.CELL_4G] = 'Cell 4G connection';
				states[Connection.CELL] = 'Cell generic connection';
				states[Connection.NONE] = 'No network connection';
				$().toastmessage('showNoticeToast', 'Connection type: ' + states[networkState] + "");
			}

			function getPosition() {
				var onSuccess = function(position) {
					alert('Latitude: ' + position.coords.latitude + '\n' + 'Longitude: ' + position.coords.longitude + '\n' + 'Altitude: ' + position.coords.altitude + '\n' + 'Accuracy: ' + position.coords.accuracy + '\n' + 'Altitude Accuracy: ' + position.coords.altitudeAccuracy + '\n' + 'Heading: ' + position.coords.heading + '\n' + 'Speed: ' + position.coords.speed + '\n' + 'Timestamp: ' + position.timestamp + '\n');
				};
				// onError Callback receives a PositionError object
				function onError(error) {
					alert('code: ' + error.code + '\n' + 'message: ' + error.message + '\n');
				}


				navigator.geolocation.getCurrentPosition(onSuccess, onError);
			}
