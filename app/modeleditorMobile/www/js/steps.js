function setActiveStepUUID(activeStepUUID) { //Single Click Function
    //1. Set window variable: window.activePolicyUUID equal to activePolicyUUID.
    window.activeStepUUID = activeStepUUID;
    window.activeObjectUUID = activeStepUUID;
}

function getMyModelsSteps(activeObjectUUID) {
    if (!activeObjectUUID) {
        activeObjectUUID = window.activePositionUUID;
        $('#steps_list').empty();
        window.PS_counter = 1;
    } else {}
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_get_Direct_ElementPosterityTree.php?callback=?', {
        key: window.key,
        activeObjectUUID: activeObjectUUID
    }, function(res, status) {
        $.each(res, function(i, item) {
            if (item.step_id !== "0") {
                $('#steps_list').append("<li><a href='#tasks' onclick='setActiveJobDescriptionUUID(" + item.UUID + ")'><img  src='http://www.smithins.com/assets/images/employee%20appreciation%20plan2.jpg'><h2>" + item.title + "</h2><p>Step Instruction: " + item.instruction + "</p></a><a href='#purchase' data-rel='popup' data-position-to='window' data-transition='pop'>Purchase album</a></li>");
                $('#steps_list').listview().listview("refresh");
            }
        });
    });
}

function createNewStep(){
    alert("Test");
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_checklist_create_Step.php?callback=?', {
        key: window.key,
        stepTitle: $("#step_title").val(),
        stepInstruction: $("#step_instruction").val(),
        stepAlertType: $("#step_alert_type").val(),
        stepAlertText: $("#step_alert_text").val(),
        allottedTimeHrs: $("#allotted_time_hrs").val(),
        allottedTimeMin: $("#allotted_time_min").val()
    }, function(res, status) {

    });

}