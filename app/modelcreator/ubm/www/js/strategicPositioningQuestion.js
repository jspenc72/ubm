function setActiveStrategicPositioningQuestionId(activeStrategicPositioningId) {
    window.activeStrategicPositioningId = activeStrategicPositioningId;
}

function getMyModelsStrategicPositioningQuestions() { //Populates Customer  Listview on Model Settings Page
    //alert("Customers was called");
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_getCurrentModel_StrategicPositioning.php?callback=?', { //JSONP Request
        username: window.username,
        key: window.key,
        activeModelUUID: window.activeModelUUID
    }, function(res, status) {
        //						alert(status);
        $('#ubmsuite_mcs_model_visual_content_strategic_positioning_questions_ul').empty();
        $('#ubmsuite_modelSettings_myStrategicPositioningQuestions_ul').empty();
        $('#ubmsuite_modelSettings_myStrategicPositioningQuestions_ul').append("<li><a data-rel='popup' data-transition='slideup' href='#ubmsuite_modelSettings_strategicpositioningquestions_popup' class='ui-btn ui-shadow'>UBM Strategic Positioning Question. </a></li>");
        $('#ubmsuite_modelSettings_myStrategicPositioningQuestions_ul').append("<li><a data-rel='popup' data-transition='slideup' href='#ubmsuite_modelSettings_createStrategicPositioningQuestion_popup' class='ui-btn ui-shadow'>Create new!</a></li>");
        $.each(res, function(i, item) {

            $('#ubmsuite_mcs_model_visual_content_strategic_positioning_questions_ul').append("<li><a>" + item.id + "</a></li>");


            $('#ubmsuite_modelSettings_myStrategicPositioningQuestions_ul').append("<li><a href='#'> <h2 style='white-space:normal;'>" + item.question + "</h2><p>" + item.id + "</p></a><a href='#ubmsuite_modelSettings_confirm_remove_StrategicPositioningQuestion_popup' data-rel='popup' data-position-to='window' data-transition='pop' onclick='setActiveStrategicPositioningQuestionId(" + item.id + ")'>Remove Strategic Positioning Question</a></li>");
            $('#ubmsuite_modelSettings_myStrategicPositioningQuestions_ul').listview().listview().listview("refresh");
        })
        $('#ubmsuite_mcs_model_visual_content_strategic_positioning_questions_ul').listview().listview().listview("refresh");
        $('#ubmsuite_modelSettings_myStrategicPositioningQuestions_ul').listview().listview().listview("refresh");
    });
    $('#tiles').trigger('refreshWookmark'); //Layout items in Wookmark Grid
}

function getListofPossibleStrategicPositioningQuestions() { //Populates Customer Listview on Possible Customers Popup
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_getAll_StrategicPositioning.php?callback=?', { //JSONP Request
        key: window.key,
    }, function(res, status) {
        //						alert(status);
        $('#ubmsuite_modelSettings_strategicpositioningquestions_popup_listview').empty();
        $.each(res, function(i, item) {
            $('#ubmsuite_modelSettings_strategicpositioningquestions_popup_listview').append("<li><a href='#'><p style='white-space:normal;'>" + item.question + "</p></a><a href='#' onclick='addStrategicPositioningQuestionToMyModel(" + item.id + ")'>Add Strategic Positioning Question</a></li>");
            $('#ubmsuite_modelSettings_strategicpositioningquestions_popup_listview').listview().listview().listview("refresh");
        })
    });
}

function addStrategicPositioningQuestionToMyModel(activeStrategicPositioningId) { //Called when the user selects an item from the Customer Listview in the Possible Customer Popup
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_add_StrategicPositioning.php?callback=?', { //JSONP Request
        key: window.key,
        activeModelUUID: window.activeModelUUID,
        activeStrategicPositioningId: activeStrategicPositioningId
    }, function(res, status) {
        $().toastmessage('showSuccessToast', "Strategic Positioning Question was added to your model");
        //alert(status);
    });
    getMyModelsStrategicPositioningQuestions();
}

function createNewStrategicPositioningQuestionAddtoMyModel() { //Called when the user submits the create new Customer Form
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_create_StrategicPositioning.php?callback=?', { //JSONP Request
        key: window.key,
        activeModelUUID: window.activeModelUUID,
        strategicPosistionQuestion: document.getElementById("ubmsuite_modelSettings_createStrategicPositioningQuestion_popup_StrategicPositioningQuestion_question").value,
    }, function(res, status) {
        if (status == "success") {
            $('#ubmsuite_modelSettings_createStrategicPositioningQuestion_popup_form').each(function() {
                this.reset();
                $("#ubmsuite_modelSettings_createStrategicPositioningQuestion_popup").popup('close');
            });
            getMyModelsStrategicPositioningQuestions();
        }
    });
}

function removeStrategicPositioningQuestionFromMyModel() { //Called when the user selects the side button for each item in the My Models Has Core Values Listview
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_remove_StrategicPositioning.php?callback=?', { //JSONP Request
        key: window.key,
        activeModelUUID: window.activeModelUUID,
        activeStrategicPositioningId: window.activeStrategicPositioningId
    }, function(res, status) {
        //alert(status);
    });
    setTimeout(function() {
        getMyModelsStrategicPositioningQuestions();
    }, 300);

}