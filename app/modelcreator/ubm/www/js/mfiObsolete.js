function getMasterFileIndexItems00() {
    $.getJSON('http://api.universalbusinessmodel.com/ubm_modelcreationsuite_getMasterFileIndexItems_00.php?callback=?', { //JSONP Request
        activeModelUUID: window.activeModelUUID
    }, function(res, status) {
        $.each(res, function(i, item) {
            $('#mfi_firstChild_1').append("<li><input type='checkbox'/><span>" + item.name + "</span></li>");
        });
    });

}

function getMasterFileIndexItems01() {
    $.getJSON('http://api.universalbusinessmodel.com/ubm_modelcreationsuite_getMasterFileIndexItems_01.php?callback=?', { //JSONP Request
        activeModelUUID: window.activeModelUUID
    }, function(res, status) {
        $.each(res, function(i, item) {
            $('#mfi_firstChild_2').append("<li><input type='checkbox'/><span>" + item.name + "</span></li>");
        });

    });
}

function getMasterFileIndexItems() {
    $.getJSON('http://api.universalbusinessmodel.com/ubm_modelcreationsuite_getMasterFileIndexItems.php?callback=?', { //JSONP Request
        activeModelUUID: window.activeModelUUID
    }, function(res, status) {
        $('#ubmsuite_mcs_master_file_index_tree').empty();
        $.each(res, function(i, item) {
            if (item.ubm_required == "yes") {
                $('#ubmsuite_mcs_master_file_index_tree').append("<li><input disabled='' type='checkbox' checked/><a>" + item.mfi_ref + "&nbsp &nbsp " + item.title + "</a> <ul id='mfi_firstChild_" + item.id + "'></ul></li>");
            } else {
                $('#ubmsuite_mcs_master_file_index_tree').append("<li><input type='checkbox'/><a>" + item.mfi_ref + " &nbsp &nbsp " + item.title + " </a><ul id='mfi_firstChild_" + item.id + "'></ul></li>");
            }
        });
        getMasterFileIndexItems01();
        getMasterFileIndexItems00();
        coolify();
    });
}