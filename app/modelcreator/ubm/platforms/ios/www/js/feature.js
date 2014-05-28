function setActiveFeatureId(activeFeatureId) {
    window.activeFeatureId = activeFeatureId;
}

function getMyModelsFeatures() { //Populates Customer  Listview on Model Settings Page
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_getCurrentModel_Features.php?callback=?', { //JSONP Request
        username: window.username,
        key: window.key,
        activeModelUUID: window.activeModelUUID
    }, function(res, status) {
        //						alert(status);
        $('#ubmsuite_mcs_model_visual_content_features_ul').empty();
        $('#ubmsuite_modelSettings_myFeatures_ul').empty();
        $('#ubmsuite_modelSettings_myFeatures_ul').append("<li><a data-rel='popup' data-transition='slideup' href='#ubmsuite_modelSettings_features_popup' class='ui-btn ui-shadow'>UBM Features. </a></li>");
        $('#ubmsuite_modelSettings_myFeatures_ul').append("<li><a data-rel='popup' data-transition='slideup' href='#ubmsuite_modelSettings_createFeature_popup' class='ui-btn ui-shadow'>Create new!</a></li>");
        $.each(res, function(i, item) {
            $('#ubmsuite_mcs_model_visual_content_features_ul').append("<li><a>" + item.feature_title + "</a></li>");
            //$('#ubmsuite_mcs_model_visual_content_features_ul').listview().listview("refresh");
            $('#ubmsuite_modelSettings_myFeatures_ul').append("<li><a href='#'> <h2 style='white-space:normal;'>" + item.feature_title + "</h2><p>" + item.feature_description + "</p></a><a href='#ubmsuite_modelSettings_confirm_remove_Feature_popup' data-rel='popup' data-position-to='window' data-transition='pop' onclick='setActiveFeatureId(" + item.id + ")'>Remove Feature</a></li>");
            $('#ubmsuite_modelSettings_myFeatures_ul').listview().listview().listview("refresh");
        })
        $('#ubmsuite_mcs_model_visual_content_features_ul').listview().listview().listview("refresh");
        $('#ubmsuite_modelSettings_myFeatures_ul').listview().listview().listview("refresh");
    });
    $('#tiles').trigger('refreshWookmark'); //Layout items in Wookmark Grid
}

function getListofPossibleFeatures() { //Populates Customer Listview on Possible Customers Popup
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_getAll_Features.php?callback=?', { //JSONP Request
        key: window.key,
    }, function(res, status) {
        //						alert(status);
        $('#ubmsuite_modelSettings_features_popup_listview').empty();
        $.each(res, function(i, item) {
            $('#ubmsuite_modelSettings_features_popup_listview').append("<li><a href='#'><p>" + item.feature_title + "</p></a><a href='#' onclick='addFeatureToMyModel(" + item.id + ")'>Add Feature</a></li>");
            $('#ubmsuite_modelSettings_features_popup_listview').listview().listview().listview("refresh");
        })
    });
}

function addFeatureToMyModel(featureId) { //Called when the user selects an item from the Customer Listview in the Possible Customer Popup
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_add_Feature.php?callback=?', { //JSONP Request
        key: window.key,
        activeModelUUID: window.activeModelUUID,
        activeFeatureId: featureId
    }, function(res, status) {
        $().toastmessage('showSuccessToast', "Feature was added to your model");
        //alert(status);
    });
    getMyModelsFeatures();
}

function createNewFeatureAddtoMyModel() { //Called when the user submits the create new Customer Form
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_create_Feature.php?callback=?', { //JSONP Request
        key: window.key,
        activeModelUUID: window.activeModelUUID,
        featureDescription: document.getElementById("ubmsuite_modelSettings_createFeature_popup_Feature_description").value,
        featureTitle: document.getElementById("ubmsuite_modelSettings_createFeature_popup_Feature_title").value

    }, function(res, status) {
        if (status == "success") {
            $('#ubmsuite_modelSettings_createFeature_popup_form').each(function() {
                this.reset();
                $("#ubmsuite_modelSettings_createFeature_popup").popup('close');
            });
            getMyModelsFeatures();
        }
    });
}

function removeFeatureFromMyModel() { //Called when the user selects the side button for each item in the My Models Has Core Values Listview
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_remove_Feature.php?callback=?', { //JSONP Request
        key: window.key,
        activeModelUUID: window.activeModelUUID,
        activeFeatureId: window.activeFeatureId
    }, function(res, status) {
        //alert(status);
    });
    setTimeout(function() {
        getMyModelsFeatures();
    }, 100);

}