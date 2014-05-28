function setActiveCoreValueId(activeCoreValueId) {
    window.activeCoreValueId = activeCoreValueId;
}
//Model Core Values
function getMyModelsCoreValues() {
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_getCurrentModel_CoreValues.php?callback=?', { //JSONP Request
        username: window.username,
        key: window.key,
        activeModelUUID: window.activeModelUUID
    }, function(res, status) {
        //alert(status);
        $('#ubmsuite_modelSettings_myCoreValues_ul').empty();
        $('#ubmsuite_modelSettings_myCoreValues_ul').append("<li><a data-rel='popup' data-mini='true' data-transition='slideup' href='#ubmsuite_modelSettings_coreValues_popup' class='ui-btn ui-shadow'>UBM core values. </a></li>");
        $('#ubmsuite_modelSettings_myCoreValues_ul').append("<li><a data-rel='popup' data-transition='slideup' href='#ubmsuite_modelSettings_createCoreValue_popup' class='ui-btn ui-shadow'>Create new!</a></li>");
        //Visual Representation
        $('#ubmsuite_mcs_model_visual_content_core_values_ul').empty();
        $.each(res, function(i, item) {
            $('#ubmsuite_mcs_model_visual_content_core_values_ul').append("<li><a>" + item.value_title + "</a></li>");
            //$('#ubmsuite_mcs_model_visual_content_core_values_ul').listview().listview("refresh");
            $('#ubmsuite_modelSettings_myCoreValues_ul').append("<li><a data-mini='true' href='#'><h2 style='white-space:normal;'>" + item.value_title + "</h2><p style='white-space:normal;'>" + item.value_summary + "</p></a><a href='#ubmsuite_modelSettings_confirm_remove_CoreValue_popup' data-mini='true' data-rel='popup' data-position-to='window' data-transition='pop' onclick='setActiveCoreValueId(" + item.id + ")'>Remove Core Value</a></li>");
            $('#ubmsuite_modelSettings_myCoreValues_ul').listview().listview().listview("refresh");
        })
        $('#ubmsuite_modelSettings_myCoreValues_ul').listview().listview().listview("refresh");
        $('#ubmsuite_mcs_model_visual_content_core_values_ul').listview().listview().listview("refresh");
    });
    setTimeout(function() {
        $('#tiles').trigger('refreshWookmark'); //Layout items in Wookmark Grid
    }, 1000);

}

function getListofPossibleCoreValues() { //Populates Core Value Listview on Possible CoreValue Popup
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_getAll_CoreValues.php?callback=?', { //JSONP Request
        key: window.key,

    }, function(res, status) {
        //						alert(status);
        $('#ubmsuite_modelSettings_coreValues_popup_listview').empty();
        $.each(res, function(i, item) {
            $('#ubmsuite_modelSettings_coreValues_popup_listview').append("<li><a href='#'><p style='white-space:normal;'>" + item.value_title + "</p></a><a href='#' onclick='addCoreValueToMyModel(" + item.id + ")'>Add Core Value</a></li>");
            $('#ubmsuite_modelSettings_coreValues_popup_listview').listview().listview().listview("refresh");
        })
    });
}

function addCoreValueToMyModel(coreValueId) { //Called when the user selects an item from the Core Value Listview in the Possible CoreValues Popup
    //(coreValueId+" will be added to this model");
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_add_CoreValue.php?callback=?', { //JSONP Request
        key: window.key,
        username: window.username,
        activeModelUUID: window.activeModelUUID,
        activeCoreValueId: coreValueId
    }, function(res, status) {
        $().toastmessage('showSuccessToast', "A Core Value was added to your model");
        //alert(status);
    });
    getMyModelsCoreValues();
}

function createNewCoreValueAddtoMyModel() { //Called when the user submits the create new CoreValue Form
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_create_CoreValue.php?callback=?', { //JSONP Request
        key: window.key,
        coreValueTitle: document.getElementById("ubmsuite_modelSettings_createCoreValue_popup_createCoreValue_title").value,
        coreValueSummary: document.getElementById("ubmsuite_modelSettings_createCoreValue_popup_createCoreValue_summary").value,
        username: window.username,
        activeModelUUID: window.activeModelUUID
    }, function(res, status) {
        $().toastmessage('showSuccessToast', res.message);
        if (status == "success") {
            $('#ubmsuite_modelSettings_createCoreValue_popup_form').each(function() {
                this.reset();
                $("#ubmsuite_modelSettings_createCoreValue_popup").popup('close');

                getMyModelsProducts();
            });
        }
    });
    getMyModelsCoreValues();
}

function removeCorevalueFromMyModel() { //Called when the user selects the side button for each item in the My Models Has Core Values Listview
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_remove_CoreValue.php/callback=?', { //JSONP Request
        username: window.username,
        key: window.key,
        activeCoreValueId: window.activeCoreValueId,
        activeModelUUID: window.activeModelUUID
    }, function(res, status) {
        if (status == "success") {
            $().toastmessage('showSuccessToast', res.message);
            setTimeout(function() {
                getMyModelsCoreValues();
            }, 300);

        }
    });
}