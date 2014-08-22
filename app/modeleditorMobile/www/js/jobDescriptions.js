function setActiveJobDescriptionUUID(activeJobDescriptionUUID) { //Single Click Function
    //1. Set window variable: window.activeJobDescriptionUUID equal to activeJobDescriptionUUID.
    window.activeJobDescriptionUUID = activeJobDescriptionUUID;
    window.activeObjectUUID = activeJobDescriptionUUID;
    //alert("active JD is called" + window.activeJobDescriptionUUID);
}

function getMyModelsjobDescriptions(activeObjectUUID) {
    if (!activeObjectUUID) {
        activeObjectUUID = window.activePositionUUID;
        $('#jobDescriptions_list').empty();
        window.PS_counter = 1;
    } else {}
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_get_Direct_ElementPosterityTree.php?callback=?', {
        key: window.key,
        activeObjectUUID: activeObjectUUID
    }, function(res, status) {
        $.each(res, function(i, item) {
            if (item.jobDescription_id !== "0") {
                $('#jobDescriptions_list').append("<li><a href='#policies' onclick='setActiveJobDescriptionUUID(" + item.UUID + ")'><img  src='http://www.smithins.com/assets/images/employee%20appreciation%20plan2.jpg'><h2>" + item.title + "</h2><p style='white-space:normal; overflow-x:scroll'>Objective: " + item.objective + "</p></a><a href='#purchase' data-rel='popup' data-position-to='window' data-transition='pop'>Purchase album</a></li>");
                $('#jobDescriptions_list').listview().listview("refresh");
            }
        });
    });
}