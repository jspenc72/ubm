function setActiveStrategicAllianceId(activeStrategicAllianceId) {
    window.activeStrategicAllianceId = activeStrategicAllianceId;
}

function getMyModelsStrategicAlliances() { //Populates Customer  Listview on Model Settings Page
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_getCurrentModel_StrategicAlliances.php?callback=?', { //JSONP Request
        username: window.username,
        key: window.key,
        activeModelUUID: window.activeModelUUID
    }, function(res, status) {
        //						alert(status);
        $('#ubmsuite_mcs_model_visual_content_strategic_alliances_ul').empty();
        $('#ubmsuite_modelSettings_myStrategicAlliances_ul').empty();
        $('#ubmsuite_modelSettings_myStrategicAlliances_ul').append("<li><a data-rel='popup' data-transition='slideup' href='#ubmsuite_modelSettings_strategicalliances_popup' class='ui-btn ui-shadow'>UBM Strategic Alliance. </a></li>");
        $('#ubmsuite_modelSettings_myStrategicAlliances_ul').append("<li><a data-rel='popup' data-transition='slideup' href='#ubmsuite_modelSettings_createStrategicAlliance_popup' class='ui-btn ui-shadow'>Create new!</a></li>");
        $.each(res, function(i, item) {


            $('#ubmsuite_mcs_model_visual_content_strategic_alliances_ul').append("<li><a style='width:100%'>" + item.strategicalliance_description + "</a></li>");

            $('#ubmsuite_modelSettings_myStrategicAlliances_ul').append("<li><a href='#'> <h2 style='white-space:normal;'>" + item.strategicalliance_comment + "</h2><p>" + item.strategicalliance_description + "</p></a><a href='#ubmsuite_modelSettings_confirm_remove_StrategicAlliance_popup' data-rel='popup' data-position-to='window' data-transition='pop' onclick='setActiveStrategicAllianceId(" + item.id + ")'>Remove Strategic Alliance</a></li>");

            $('#ubmsuite_modelSettings_myStrategicAlliances_ul').listview().listview().listview("refresh");
        });

        $('#ubmsuite_modelSettings_myStrategicAlliances_ul').listview().listview().listview("refresh");
        $('#ubmsuite_mcs_model_visual_content_strategic_alliances_ul').listview().listview().listview("refresh");
        getMyModelsStrategicPositioningQuestions();
    });
    getListofPossibleStrategicAlliances();
}

function getListofPossibleStrategicAlliances() { //Populates Customer Listview on Possible Customers Popup
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_getAll_StrategicAlliances.php?callback=?', { //JSONP Request
        key: window.key,
    }, function(res, status) {
        //						alert(status);
        $('#ubmsuite_modelSettings_strategicalliances_popup_listview').empty();
        $.each(res, function(i, item) {
            $('#ubmsuite_modelSettings_strategicalliances_popup_listview').append("<li><a href='#'><p style='white-space:normal;'>" + item.strategicalliance_description + "</p></a><a href='#' onclick='addStrategicAllianceToMyModel(" + item.id + ")'>Add Strategic Alliance</a></li>");
            $('#ubmsuite_modelSettings_strategicalliances_popup_listview').listview().listview().listview("refresh");
        })
    });
}

function addStrategicAllianceToMyModel(strategicAllianceId) { //Called when the user selects an item from the Customer Listview in the Possible Customer Popup
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_add_StrategicAlliance.php?callback=?', { //JSONP Request
        key: window.key,
        username: window.username,
        activeModelUUID: window.activeModelUUID,
        activeStrategicAllianceId: strategicAllianceId
    }, function(res, status) {
        $().toastmessage('showSuccessToast', "A Strategic Alliance was added to your model");
    });
    getMyModelsStrategicAlliances();
}

function createNewStrategicAllianceAddtoMyModel() { //Called when the user submits the create new Customer Form
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_create_StrategicAlliance.php?callback=?', { //JSONP Request
        key: window.key,
        activeModelUUID: window.activeModelUUID,
        strategicAllianceDescription: document.getElementById("ubmsuite_modelSettings_createStrategicAlliance_popup_StrategicAlliance_description").value,
        strategicAllianceComment: document.getElementById("ubmsuite_modelSettings_createStrategicAlliance_popup_StrategicAlliance_comment").value
    }, function(res, status) {
        if (status == "success") {
            $('#ubmsuite_modelSettings_createStrategicAlliance_popup_form').each(function() {
                this.reset();
                $("#ubmsuite_modelSettings_createStrategicAlliance_popup").popup('close');

            });
            getMyModelsStrategicAlliances();
        }
    });
}

function removeStrategicAllianceFromMyModel() { //Called when the user selects the side button for each item in the My Models Has Core Values Listview
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_remove_StrategicAlliance.php?callback=?', { //JSONP Request
        key: window.key,
        activeModelUUID: window.activeModelUUID,
        activeStrategicAllianceId: window.activeStrategicAllianceId
    }, function(res, status) {

    });
    setTimeout(function() {
        getMyModelsStrategicAlliances();
    }, 300);

}