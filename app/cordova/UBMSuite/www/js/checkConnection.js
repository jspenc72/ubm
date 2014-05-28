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

function checkConnection() {
    var networkState = navigator.connection.type;
    var states = {};
    states[Connection.UNKNOWN] = 'Unknown connection';
    states[Connection.ETHERNET] = 'Ethernet connection';
    states[Connection.WIFI] = 'WiFi connection';
    states[Connection.CELL_2G] = 'Cell 2G connection';
    states[Connection.CELL_3G] = 'Cell 3G connection';
    states[Connection.CELL_4G] = 'Cell 4G connection';
    states[Connection.CELL] = 'Cell generic connection';
    states[Connection.NONE] = 'No network connection';

    //alert('Connection type: ' + states[networkState]);
    if (states[networkState] == 'Unknown connection') {
        //alert("Network status: "+states[networkState]);
        $(".unknownnetwork").css("visibility", "visible");
    } else {
        $(".unknownnetwork").css("visibility", "hidden");
    }
    if (states[networkState] == 'No network connection') {
        alert("Network status: " + states[networkState]);
        $(".offline").css("visibility", "visible");
    } else {
        $(".offline").css("visibility", "hidden");
    }
}
$(document).on("pageshow", "#ubmsuite_modelDashboard", function() {
    if (window.walkthrough == 0) {
        setTimeout(function() {
            introJs('#ubmsuite_modelDashboard').start();
        }, 1000);
    }
    setTimeout(function() {
        getModelCreationSuiteChecklistItems();

    }, 100);
    setTimeout(function() {
        getMyModelsCoreValues();
        getMyModelsCustomers();
        getMyModelsProducts();


        getListofPossibleCoreValues();
        getListofPossibleCustomers();
        getListofPossibleProducts();
    }, 2000);
    setTimeout(function() {
        getMyModelsServices();
        getMyModelsPhysicalFacilities();
        getMyModelsStrategicAlliances();
        getMyModelsStrategicPositioningQuestions();
        getMyModelsFeatures();
        getMyModelsOrganizationalStructures();

        getListofPossibleServices();
        getListofPossiblePhysicalFacilities();
        getListofPossibleStrategicAlliances();
        getListofPossibleStrategicPositioningQuestions();
        getListofPossibleFeatures();
        getListofPossibleOrganizationalStructures();
    }, 2000);
});