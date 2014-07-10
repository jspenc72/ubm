$(function() {
    $('.sortable').sortable();
});

$('.sortable').sortable().bind('sortupdate', function() {
    $(".sortable li").each(function() {
        var index = $(this).index() + 1;
        $(this).find("span").text(index);
    });
});

function reorderTasks() {
    $("#ubmsuite_mcs_my_organizational_chart_content_manageStepPopUp").popup('close');
    showLoader();
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelCreationSuite_getMyModel_taskOrder.php?callback=?', { //JSONP Request
        activeStepUUID: window.activeStepUUID,
        key: window.key
    }, function(res, status) {
        $('#sortableTasks').empty();
        $.each(res, function(i, item) {
            $('#sortableTasks').append("<li id=" + item.UUID + "><span>" + (i + 1) + "</span> " + item.instruction + "</li>");
        });
        $("#reorderTasksPopup").popup('open');
        hideLoader();
    });
}

function reorderSteps() {
    showLoader();
    $("#ubmsuite_mcs_my_organizational_chart_content_manageProcedurePopUp").popup('close');
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelCreationSuite_getMyModel_stepOrder.php?callback=?', { //JSONP Request
        activeProcedureUUID: window.activeProcedureUUID,
        key: window.key
    }, function(res, status) {
        $('#sortableSteps').empty();
        $.each(res, function(i, item) {
            $('#sortableSteps').append("<li id=" + item.UUID + "><span>" + (i + 1) + "</span> " + item.instruction + "</li>");
        });
        $("#reorderStepsPopup").popup('open');
        hideLoader();
    });
}

function submitStepsOrder() {
    var stepsArray = {};
    $("#sortableSteps li").each(function() {
        var value = $(this).index() + 1;
        var key = this.id;
        stepsArray[key] = value;
    });

    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelCreationSuite_submit_stepOrder.php?callback=?', { //JSONP Request
        stepOrder: stepsArray,
        key: window.key
    }, function(res, status) {
        $("#reorderStepsPopup").popup('close');
    });
}

function submitTasksOrder() {
    var tasksArray = {};
    $("#sortableTasks li").each(function() {
        var value = $(this).index() + 1;
        var key = this.id;
        tasksArray[key] = value;
    });

    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelCreationSuite_submit_taskOrder.php?callback=?', { //JSONP Request
        taskOrder: tasksArray,
        key: window.key
    }, function(res, status) {
        $("#reorderTasksPopup").popup('close');
    });
}