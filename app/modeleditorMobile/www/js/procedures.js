function setActiveProcedureUUID(activeProcedureUUID) { //Single Click Function
    //1. Set window variable: window.activeProcedureUUID equal to activeProcedureUUID.
    window.activeProcedureUUID = activeProcedureUUID;
    window.activeObjectUUID = activeProcedureUUID;
}

function getMyModelsProcedures(activeObjectUUID) {
    if (!activeObjectUUID) {
        activeObjectUUID = window.activePositionUUID;
        $('#procedures_list').empty();
        window.PS_counter = 1;
    } else {}
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_get_Direct_ElementPosterityTree.php?callback=?', {
        key: window.key,
        activeObjectUUID: activeObjectUUID
    }, function(res, status) {
        $.each(res, function(i, item) {
            if (item.procedure_id !== "0") {
                $('#procedures_list').append("<li><a href='#steps' onclick='setActiveJobDescriptionUUID(" + item.UUID + ")'><img  src='http://www.smithins.com/assets/images/employee%20appreciation%20plan2.jpg'><h2>" + item.title + "</h2><p>" + item.purpose + "</p></a><a href='#purchase' data-rel='popup' data-position-to='window' data-transition='pop'>Add Item</a></li>");
                $('#procedures_list').listview().listview("refresh");
            }
        });
    });
}