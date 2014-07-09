$(function() {
    $('.sortable').sortable();
});

function reorderTasks() {
    showLoader();
    $("#ubmsuite_mcs_my_organizational_chart_content_mangeStepPopUp").popup('close');
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelCreationSuite_getMyModel_taskOrder.php?callback=?', { //JSONP Request
        activeModelUUID: window.activeModelUUID,
        key: window.key
    }, function(res, status) {
        $('#sortableTasks').empty();
        $.each(res, function(i, item) {
            $('#sortableTasks').append("<li><span>" + (i+1) + "</span> " + item.instruction + "</li>");
        });
        $("#reorderTasksPopup").popup('open');
        hideLoader();
    });
}

function reorderSteps() {
    showLoader();
    $("#ubmsuite_mcs_my_organizational_chart_content_mangeProcedurePopUp").popup('close');
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelCreationSuite_getMyModel_stepOrder.php?callback=?', { //JSONP Request
        activeModelUUID: window.activeModelUUID,
        key: window.key
    }, function(res, status) {
        $('#sortableSteps').empty();
        $.each(res, function(i, item) {
            $('#sortableSteps').append("<li><span>" + (i+1) + "</span> " + item.instruction + "</li>");
        });
        $("#reorderStepsPopup").popup('open');
        hideLoader();
    });
}

function submitTaskOrder() {
    var stepsArray = [];
    $("#sortableSteps li").each(function() {
        stepsArray.push($(this).text());
    });
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelCreationSuite_getMyModel_stepOrder.php?callback=?', { //JSONP Request
        activeModelUUID: window.activeModelUUID,
        key: window.key
    }, function(res, status) {
        $("#reorderStepsPopup").popup('close');
    });
}

$('.sortable').sortable().bind('sortupdate', function() {
    $(".sortable li").each(function() {
        var index = $(this).index() + 1;
        $(this).find("span").text(index);
    });
});