function setActivePhysicalFacilityId(activePhysicalFacilityId) {
    window.activePhysicalFacilityId = activePhysicalFacilityId;
}

function getMyModelsPhysicalFacilities() { //Populates Customer  Listview on Model Settings Page
    //alert("Customers was called");
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_getCurrentModel_PhysicalFacilities.php?callback=?', { //JSONP Request
        username: window.username,
        key: window.key,
        activeModelUUID: window.activeModelUUID
    }, function(res, status) {
        //						alert(status);
        $('#ubmsuite_mcs_model_visual_content_physical_facilitiei_ul').empty();
        $('#ubmsuite_modelSettings_myPhysicalFacilities_ul').empty();
        $('#ubmsuite_modelSettings_myPhysicalFacilities_ul').append("<li><a data-rel='popup' data-transition='slideup' href='#ubmsuite_modelSettings_physicalfacilities_popup' class='ui-btn ui-shadow'>UBM Physical Facilities. </a></li>");
        $('#ubmsuite_modelSettings_myPhysicalFacilities_ul').append("<li><a data-rel='popup' data-transition='slideup' href='#ubmsuite_modelSettings_createPhysicalFacility_popup' class='ui-btn ui-shadow'>Create new!</a></li>");
        $.each(res, function(i, item) {
            $('#ubmsuite_mcs_model_visual_content_physical_facilitiei_ul').append("<li><a>" + item.facility_title + "</a></li>");
            //$('#ubmsuite_mcs_model_visual_content_physical_facilitiei_ul').listview().listview("refresh");
            $('#ubmsuite_modelSettings_myPhysicalFacilities_ul').append("<li><a href='#'> <h2 style='white-space:normal;'>" + item.facility_title + "</h2><p>" + item.id + "</p></a><a href='#ubmsuite_modelSettings_confirm_remove_PhysicalFacility_popup' data-rel='popup' data-position-to='window' data-transition='pop' onclick='setActivePhysicalFacilityId(" + item.id + ")'>Remove Physical Facility</a></li>");
            $('#ubmsuite_modelSettings_myPhysicalFacilities_ul').listview().listview("refresh");
        });
        $('#ubmsuite_mcs_model_visual_content_physical_facilitiei_ul').listview().listview("refresh");
        $('#ubmsuite_modelSettings_myPhysicalFacilities_ul').listview().listview("refresh");
        getMyModelsStrategicAlliances();
    });
    getListofPossiblePhysicalFacilities();
}

function getListofPossiblePhysicalFacilities() { //Populates Customer Listview on Possible Customers Popup
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_getAll_PhysicalFacilities.php?callback=?', { //JSONP Request
        key: window.key,
    }, function(res, status) {
        //						alert(status);
        $('#ubmsuite_modelSettings_physicalfacilities_popup_listview').empty();
        $.each(res, function(i, item) {
            $('#ubmsuite_modelSettings_physicalfacilities_popup_listview').append("<li><a href='#'><p style='white-space:normal;'>" + item.facility_title + "</p></a><a href='#' onclick='addPhysicalFacilitiesToMyModel(" + item.id + ")'>Add Physical Facility</a></li>");
            $('#ubmsuite_modelSettings_physicalfacilities_popup_listview').listview().listview("refresh");
        })
    });
}

function addPhysicalFacilitiesToMyModel(physicalFacilityId) { //Called when the user selects an item from the Customer Listview in the Possible Customer Popup
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_add_PhysicalFacility.php?callback=?', { //JSONP Request
        key: window.key,
        activeModelUUID: window.activeModelUUID,
        activePhysicalFacilityId: physicalFacilityId
    }, function(res, status) {
        $().toastmessage('showSuccessToast', "A Physical Facility was added to your model");
        //alert(status);
    });
    getMyModelsPhysicalFacilities();
}

function createNewPhysicalFacilityAddtoMyModel() { //Called when the user submits the create new Customer Form
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_create_PhysicalFacility.php?callback=?', { //JSONP Request
        key: window.key,
        activeModelUUID: window.activeModelUUID,
        physicalFacilityTitle: document.getElementById("ubmsuite_modelSettings_createPhysicalFacility_popup_PhysicalFacility_title").value,
        physicalFacilityAssociatedCost: document.getElementById("ubmsuite_modelSettings_createPhysicalFacility_popup_PhysicalFacility_associated_cost").value
    }, function(res, status) {
        if (status == "success") {
            $('#ubmsuite_modelSettings_createPhysicalFacility_popup_form').each(function() {
                this.reset();
                $("#ubmsuite_modelSettings_createPhysicalFacility_popup").popup('close');
            });
            getMyModelsPhysicalFacilities();
        }
    });
}

function removePhysicalFacilityFromMyModel() { //Called when the user selects the side button for each item in the My Models Has Core Values Listview
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_remove_PhysicalFacility.php?callback=?', { //JSONP Request
        key: window.key,
        activeModelUUID: window.activeModelUUID,
        activePhysicalFacilityId: window.activePhysicalFacilityId
    }, function(res, status) {
        //alert(status);
    });
    setTimeout(function() {
        getMyModelsPhysicalFacilities();
    }, 300);

}