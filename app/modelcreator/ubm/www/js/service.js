function setActiveServiceId(activeServiceId) {
    window.activeServiceId = activeServiceId;
}

function getMyModelsServices() { //Populates Customer  Listview on Model Settings Page
    //alert("Customers was called");
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_getCurrentModel_Services.php?callback=?', { //JSONP Request
        username: window.username,
        key: window.key,
        activeModelUUID: window.activeModelUUID
    }, function(res, status) {
        //						alert(status);
        $('#ubmsuite_mcs_model_visual_content_services_ul').empty();
        $('#ubmsuite_modelSettings_myServices_ul').empty();
        $('#ubmsuite_modelSettings_myServices_ul').append("<li><a data-rel='popup' data-transition='slideup' href='#ubmsuite_modelSettings_services_popup' class='ui-btn ui-shadow'>UBM Services. </a></li>");
        $('#ubmsuite_modelSettings_myServices_ul').append("<li><a data-rel='popup' data-transition='slideup' href='#ubmsuite_modelSettings_createService_popup' class='ui-btn ui-shadow'>Create new!</a></li>");
        $.each(res, function(i, item) {
            $('#ubmsuite_mcs_model_visual_content_services_ul').append("<li><a style='padding:0px 0px 0px 0px; width:100%'>" + item.title + "</a></li>");
            //$('#ubmsuite_mcs_model_visual_content_services_ul').listview("refresh");
            $('#ubmsuite_modelSettings_myServices_ul').append("<li><a href='#'> <h2 style='white-space:normal;'>" + item.title + "</h2><p>" + item.id + "</p></a><a href='#ubmsuite_modelSettings_confirm_remove_Service_popup' data-rel='popup' data-position-to='window' data-transition='pop' onclick='setActiveServiceId(" + item.id + ")'>Remove Service</a></li>");
            $('#ubmsuite_modelSettings_myServices_ul').listview("refresh");
        })
        $('#ubmsuite_mcs_model_visual_content_services_ul').listview("refresh");
        $('#ubmsuite_modelSettings_myServices_ul').listview("refresh");

    });
    setTimeout(function() {
        $('#tiles').trigger('refreshWookmark'); //Layout items in Wookmark Grid
    }, 1000);
}

function getListofPossibleServices() { //Populates Customer Listview on Possible Customers Popup
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_getAll_Services.php?callback=?', { //JSONP Request
        key: window.key,

    }, function(res, status) {
        //						alert(status);
        $('#ubmsuite_modelSettings_services_popup_listview').empty();
        $.each(res, function(i, item) {
            $('#ubmsuite_modelSettings_services_popup_listview').append("<li><a href='#'><p style='white-space:normal;'>" + item.title + "</p></a><a href='#' onclick='addServiceToMyModel(" + item.id + ")'>Add Service</a></li>");
            $('#ubmsuite_modelSettings_services_popup_listview').listview("refresh");
        })
    });
}

function addServiceToMyModel(serviceId) { //Called when the user selects an item from the Customer Listview in the Possible Customer Popup
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_add_Service.php?callback=?', { //JSONP Request
        key: window.key,
        username: window.username,
        activeModelUUID: window.activeModelUUID,
        activeServiceId: serviceId
    }, function(res, status) {
        $().toastmessage('showSuccessToast', "A Service was added to your model");
        //alert(status);
    });
    getMyModelsServices();
}

function createNewServiceAddtoMyModel() { //Called when the user submits the create new Customer Form
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_create_Service.php?callback=?', { //JSONP Request
        key: window.key,
        activeModelUUID: window.activeModelUUID,
        serviceTitle: document.getElementById("ubmsuite_modelSettings_createService_popup_Service_title").value
    }, function(res, status) {
        if (status == "success") {
            $('#ubmsuite_modelSettings_createService_popup_form').each(function() {
                this.reset();
                $("#ubmsuite_modelSettings_createService_popup").popup('close');
                getMyModelsServices();
            });
        }
    });
}

function removeServiceFromMyModel() { //Called when the user selects the side button for each item in the My Models Has Core Values Listview
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_remove_Service.php?callback=?', { //JSONP Request
        key: window.key,
        username: window.username,
        activeModelUUID: window.activeModelUUID,
        activeServiceId: window.activeServiceId
    }, function(res, status) {
        //alert(status);
    });
    setTimeout(function() {
        getMyModelsServices();
    }, 300);


}