function setActivePositionUUID(activePositionUUID) { //Single Click Function
    //1. Set window variable: window.activePositionUUID equal to activePositionUUID.
    window.activePositionUUID = activePositionUUID;
    window.activeObjectUUID = activePositionUUID;
    // alert("active PS is called" + window.activePositionUUID);
}

function getMyModelsOwners(callback) {
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_getActiveModelOwnerforOrgChart.php?callback=?', { //JSONP Request 
        key: window.key,
        activeModelUUID: window.activeModelUUID
    }, function(res, status) {
        $('#positions_list').empty();
        $.each(res, function(i, item) {
            if (!item.name) {
                item.name = 'Vacant';
            } else {
                console.log("Unknown else condition was met");
            }
            if (item.title == "Owners") {
                window.activeModelOwnersUUID = item.UUID;
                $('#positions_list').prepend("<li><a href='#jobDescriptions' onclick='setActivePositionUUID(" + item.UUID + ")'><img  src='http://www.smithins.com/assets/images/employee%20appreciation%20plan2.jpg'><h2>" + item.title + "</h2><p>" + item.name + "</p></a><a href='#purchase' data-rel='popup' data-position-to='window' data-transition='pop'>Purchase album</a></li>");
                $('#positions_list').listview().listview("refresh");
                //3. New Append an Empty UL with the highest positions UUID in the id, so that additional positions may be added later.
                //4. Empty chart Div
            } else {
                console.log("Unknown else condition was met");
            }
        });
    });
    if (callback) {
        callback();
    }
}

function getMyModelsPositions() {
    getMyModelsOwners(function() {
        setTimeout(function() {
            $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_getActiveModelPositionsforOrgChart.php?callback=?', { //JSONP Request
                key: window.key,
                activeModelOwnersUUID: window.activeModelOwnersUUID
            }, function(res, status) {
                $.each(res, function(i, item) {
                    if (!item.name) {
                        item.name = 'Vacant';
                    } else {
                        console.log("Unknown else condition was met");
                    }
                    $('#positions_list').append("<li><a href='#jobDescriptions' onclick='setActivePositionUUID(" + item.UUID + ")'><img  src='http://www.smithins.com/assets/images/employee%20appreciation%20plan2.jpg'><h2>" + item.title + "</h2><p>" + item.name + "</p></a><a href='#purchase' data-rel='popup' data-position-to='window' data-transition='pop'>Purchase album</a></li>");
                    $('#positions_list').listview().listview("refresh");
                });
            });
        }, 2000);
    });
}