function createNewCalendarEvent() {
    $.getJSON('http://www.findmydriver.com/ubm_modelcreationsuite_commandCenter_createPositionEvent.php?callback=?', { //JSONP Request
        key: window.key,
    }, function(res, status) {
        $('#ubmsuite_mcs_my_organizational_chart_content_createNewPositionPopUp_form_UBMRepository').empty();
        $.each(res, function(i, item) {

        });
    });
}

function getPositionsCalendarEvents() {
    $.getJSON('http://www.findmydriver.com/ubm_modelcreationsuite_commandCenter_getPositionsEvent.php?callback=?', { //JSONP Request
        key: window.key,
    }, function(res, status) {
        $('#ubmsuite_mcs_my_organizational_chart_content_createNewPositionPopUp_form_UBMRepository').empty();
        $.each(res, function(i, item) {

        });
    });
}

function deleteCurrentEvent() {
    $.getJSON('http://www.findmydriver.com/ubm_modelcreationsuite_commandCenter_deletePositionEvent.php?callback=?', { //JSONP Request
        key: window.key,
    }, function(res, status) {
        $('#ubmsuite_mcs_my_organizational_chart_content_createNewPositionPopUp_form_UBMRepository').empty();
        $.each(res, function(i, item) {

        });
    });
}