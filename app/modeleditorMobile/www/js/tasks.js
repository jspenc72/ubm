function setActiveTaskUUID(activeTaskUUID) { //Single Click Function
    //1. Set window variable: window.activeStepUUID equal to activeStepUUID.
    window.activeTaskUUID = activeTaskUUID;
    window.activeObjectUUID = activeTaskUUID;

}

function getMyModelsTasks(activeObjectUUID) {
    if (!activeObjectUUID) {
        activeObjectUUID = window.activePositionUUID;
        $('#tasks_list').empty();
        window.PS_counter = 1;
    } else {}
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_get_Direct_ElementPosterityTree.php?callback=?', {
        key: window.key,
        activeObjectUUID: activeObjectUUID
    }, function(res, status) {
        $.each(res, function(i, item) {
            if (item.task_id !== "0") {
                $('#tasks_list').append("<li><a href='#' onclick='setActiveJobDescriptionUUID(" + item.UUID + ")'><img  src='http://www.smithins.com/assets/images/employee%20appreciation%20plan2.jpg'><h2>" + item.title + "</h2><p>Task Instruction: " + item.instruction + "</p></a><a href='#purchase' data-rel='popup' data-position-to='window' data-transition='pop'>Purchase album</a></li>");
                $('#tasks_list').listview().listview("refresh");
            }
        });
    });
}

function createNewTask(){
     alert("Task test");       
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_new_Task.php?callback=?', {
        key: window.key,
        activeObjectUUID: activeObjectUUID
    }, function(res, status) {
        $.each(res, function(i, item) {
            if (item.task_id !== "0") {
                $('#tasks_list').append("<li><a href='#' onclick='setActiveJobDescriptionUUID(" + item.UUID + ")'><img  src='http://www.smithins.com/assets/images/employee%20appreciation%20plan2.jpg'><h2>" + item.title + "</h2><p>Task Instruction: " + item.instruction + "</p></a><a href='#purchase' data-rel='popup' data-position-to='window' data-transition='pop'>Purchase album</a></li>");
                $('#tasks_list').listview().listview("refresh");
            }
        });
    });       
}