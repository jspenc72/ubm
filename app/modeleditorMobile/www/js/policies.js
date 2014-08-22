function setActivePolicyUUID(activePolicyUUID) { //Single Click Function
    //1. Set window variable: window.activePolicyUUID equal to activePolicyUUID.
    window.activePolicyUUID = activePolicyUUID;
    window.activeObjectUUID = activePolicyUUID;

}

function getMyModelsPolicies(activeObjectUUID) {
    if (!activeObjectUUID) {
        activeObjectUUID = window.activePositionUUID;
        $('#policies_list').empty();
        window.PS_counter = 1;
    } else {}
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_get_Direct_ElementPosterityTree.php?callback=?', {
        key: window.key,
        activeObjectUUID: activeObjectUUID
    }, function(res, status) {
        $.each(res, function(i, item) {
            if (item.policy_id !== "0") {
                $('#policies_list').append("<li><a href='#procedures' onclick='setActiveJobDescriptionUUID(" + item.UUID + ")'><img  src='http://www.smithins.com/assets/images/employee%20appreciation%20plan2.jpg'><h2>" + item.title + "</h2><p>Purpose: " + item.purpose + "</p></a><a href='#purchase' data-rel='popup' data-position-to='window' data-transition='pop'>Purchase album</a></li>");
                $('#policies_list').listview().listview("refresh");
            }
        });
    });
}