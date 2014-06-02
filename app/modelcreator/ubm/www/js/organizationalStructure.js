function setActiveOrganizationalStructureId(activeOrganizationalStructureId) {
    window.activeOrganizationalStructureId = activeOrganizationalStructureId;
}

function getMyModelsOrganizationalStructures() { //Populates Customer  Listview on Model Settings Page
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_getCurrentModel_OrganizationalStructures.php?callback=?', { //JSONP Request
        username: window.username,
        key: window.key,
        activeModelUUID: window.activeModelUUID
    }, function(res, status) {
        //						alert(status);
        $('#ubmsuite_mcs_model_visual_content_organizational_structure_ul').empty();
        $('#ubmsuite_modelSettings_myOrganizationalStructure_ul').empty();
        $('#ubmsuite_modelSettings_myOrganizationalStructure_ul').append("<li><a data-rel='popup' data-transition='slideup' href='#ubmsuite_modelSettings_organizationalstructure_popup' class='ui-btn ui-shadow'>UBM Organizational Structure. </a></li>");
        $('#ubmsuite_modelSettings_myOrganizationalStructure_ul').append("<li><a data-rel='popup' data-transition='slideup' href='#ubmsuite_modelSettings_createOrganizationalStructure_popup' class='ui-btn ui-shadow'>Create new!</a></li>");
        $.each(res, function(i, item) {
            $('#ubmsuite_mcs_model_visual_content_organizational_structure_ul').append("<li><a>" + item.structure_title + "</a></li>");
            //$('#ubmsuite_mcs_model_visual_content_organizational_structure_ul').listview().listview("refresh");
            $('#ubmsuite_modelSettings_myOrganizationalStructure_ul').append("<li><a href='#'> <h2 style='white-space:normal;'>" + item.structure_title + "</h2><p>" + item.id + "</p></a><a href='#ubmsuite_modelSettings_confirm_remove_OrganizationalStructure_popup' data-rel='popup' data-position-to='window' data-transition='pop' onclick='setActiveOrganizationalStructureId(" + item.id + ")'>Remove Organizational Structure</a></li>");
            $('#ubmsuite_modelSettings_myOrganizationalStructure_ul').listview().listview("refresh");
        })
        $('#ubmsuite_mcs_model_visual_content_contact_ul').listview().listview("refresh");
        $('#ubmsuite_modelSettings_myOrganizationalStructure_ul').listview().listview("refresh");
        hideLoader();
    });

    getListofPossibleOrganizationalStructures();
}

function getListofPossibleOrganizationalStructures() { //Populates Customer Listview on Possible Customers Popup
    $.getJSON('http://api.universalbusinessmodel.com/ubm_modelcreationsuite_model_getAll_OrganizationalStructures.php?callback=?', { //JSONP Request
        key: window.key,
    }, function(res, status) {
        //						alert(status);
        $('#ubmsuite_modelSettings_organizationalstructure_popup_listview').empty();
        $.each(res, function(i, item) {
            $('#ubmsuite_modelSettings_organizationalstructure_popup_listview').append("<li><a href='#'><p style='white-space:normal;'>" + item.structure_title + "</p></a><a href='#' onclick='addOrganizationalStructureToMyModel(" + item.id + ")'>Add Organizational Structure</a></li>");
            $('#ubmsuite_modelSettings_organizationalstructure_popup_listview').listview().listview("refresh");
        })
    });
}

function addOrganizationalStructureToMyModel(organizationalStructureId) { //Called when the user selects an item from the Customer Listview in the Possible Customer Popup
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_add_OrganizationalStructure.php?callback=?', { //JSONP Request
        key: window.key,
        activeModelUUID: window.activeModelUUID,
        organizationalStructureId: organizationalStructureId
    }, function(res, status) {
        $().toastmessage('showSuccessToast', "An Organizational Structure was added to your model");
        //alert(status);
    });
    getMyModelsOrganizationalStructures();
}

function createNewOrganizationalStructureAddtoMyModel() { //Called when the user submits the create new Customer Form
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_create_OrganizationalStructure.php?callback=?', { //JSONP Request
        key: window.key,
        activeModelUUID: window.activeModelUUID,
        organizationalStructureTitle: document.getElementById("ubmsuite_modelSettings_createOrganizationalStructure_popup_OrganizationalStructure_title").value,
        organizationalStructureTitleReportsTo: document.getElementById("ubmsuite_modelSettings_createOrganizationalStructure_popup_OrganizationalStructure_reports_to").value
    }, function(res, status) {
        if (status == "success") {
            $('#ubmsuite_modelSettings_createOrganizationalStructure_popup_form').each(function() {
                this.reset();
                $("#ubmsuite_modelSettings_createOrganizationalStructure_popup").popup('close');
                getMyModelsOrganizationalStructures();
            });
        }
    });
}

function removeOrganizationalStructureFromMyModel() { //Called when the user selects the side button for each item in the My Models Has Core Values Listview
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_remove_OrganiztionalStructure.php?callback=?', { //JSONP Request
        key: window.key,
        activeModelUUID: window.activeModelUUID,
        activeOrganizationalStructureId: window.activeOrganizationalStructureId
    }, function(res, status) {
        //alert(status);
    });
    setTimeout(function() {
        getMyModelsOrganizationalStructures();
    }, 300);

}