function showLoader() {
    //Show Loader Message
    var $this = $("#page_loading_message"),
        theme = $this.jqmData("theme") || $.mobile.loader.prototype.options.theme,
        msgText = $this.jqmData("msgtext") || $.mobile.loader.prototype.options.text,
        textVisible = $this.jqmData("textvisible") || $.mobile.loader.prototype.options.textVisible,
        textonly = !! $this.jqmData("textonly");
    html = $this.jqmData("html") || "";
    $.mobile.loading("show", {
        text: msgText,
        textVisible: textVisible,
        theme: theme,
        textonly: textonly,
        html: html
    });
    //End Show Loader Message				
}

function hideLoader() {
    $.mobile.loading("hide");
}
//Open Item Functions
function confirmCloseOpenItem(id) {
    $("#mcs_open_points_action_items_closeitem_popup").popup('open');
    window.openitemid = id;
}

function closeOpenItem() {
    $().toastmessage('showSuccessToast', "This item will now be closed: " + window.openitemid + "");
    $("#mcs_open_points_action_items_closeitem_popup").popup('close');
    $.getJSON('http://api.universalbusinessmodel.com/ubm_modelcreationsuite_openitem_markasclosed.php?callback=?', { //JSONP Request
        openitemid: window.openitemid,
        username: window.username
    }, function(res, status) {
        $().toastmessage('showSuccessToast', "json request returned: " + status + "");
    });
}

function refreshOpenItemsList() {
    //Show Loader Message
    var $this = $("#page_loading_message"),
        theme = $this.jqmData("theme") || $.mobile.loader.prototype.options.theme,
        msgText = $this.jqmData("msgtext") || $.mobile.loader.prototype.options.text,
        textVisible = $this.jqmData("textvisible") || $.mobile.loader.prototype.options.textVisible,
        textonly = !! $this.jqmData("textonly");
    html = $this.jqmData("html") || "";
    $.mobile.loading("show", {
        text: msgText,
        textVisible: textVisible,
        theme: theme,
        textonly: textonly,
        html: html
    });
    //End Show Loader Message
    $.getJSON('http://api.universalbusinessmodel.com/ubmopenitemsonlystatusopenitems.php?callback=?', { //JSONP Request
    }, function(res, status) {
        //	alert("request for open items was a success!");
        $('#mcs_open_points_action_items_table_body').empty();
        $.each(res, function(i, item) {
            if (window.accounttype == "admin") { //If user accounttype is admin, allow user to add new resolutions. If not, only allow them to view existing resolutions.
                if (window.username.toUpperCase() == item.opened_by.toUpperCase()) { //if current window.username is the same as the user who created the review point insert a button to allow user to mark the review point as closed.
                    //alert(window.accounttype);
                    if (item.number_resolutions !== "0") { //If item doesnt have any resolutions associated with it, use theme a for the "View" Resolutions button
                        $('#mcs_open_points_action_items_table_body').append("<tr ><th class='label'>" + item.id + "</th><td>" + item.form_ref + "</td><td>" + item.priority + "</td><td>" + item.opened_by + "<a href='#' onclick='confirmCloseOpenItem(" + item.id + ")' class='ui-btn ui-btn-inline ui-icon-delete ui-btn-icon-left' data-mini='true' >Close <br> Item</a></td><td>" + item.date_opened + "</td><td>" + item.action_required + "</td><td>" + item.assigned_to + "</td><td>" + item.date_opened + "</td><td>" + item.due_date + "</td><td>b</td><td>c</td><td>d</td><td><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-comment ui-btn-icon-left ui-btn-b' onclick='viewResolutions(" + item.id + ")'>View &nbsp&nbsp&nbsp&nbsp<span class='ui-li-has-count ui-btn-up-c ui-btn-corner-all'>" + item.number_resolutions + "</span></a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addResolutions(" + item.id + ")'>Resolve &nbsp&nbsp&nbsp&nbsp</a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addItemComment(" + item.id + ")'>Comment &nbsp&nbsp&nbsp&nbsp</a></td></tr>");
                        $("#mcs_open_points_action_items_table").table("refresh");
                    } else {
                        $('#mcs_open_points_action_items_table_body').append("<tr ><th class='label'>" + item.id + "</th><td>" + item.form_ref + "</td><td>" + item.priority + "</td><td>" + item.opened_by + "<a href='#' onclick='confirmCloseOpenItem(" + item.id + ")' class='ui-btn ui-btn-inline ui-icon-delete ui-btn-icon-left' data-mini='true' >Close <br> Item</a></td><td>" + item.date_opened + "</td><td>" + item.action_required + "</td><td>" + item.assigned_to + "</td><td>" + item.date_opened + "</td><td>" + item.due_date + "</td><td>b</td><td>c</td><td>d</td><td><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-comment ui-btn-icon-left ui-btn-a' onclick='viewResolutions(" + item.id + ")'>View &nbsp&nbsp&nbsp&nbsp<span class='ui-li-has-count ui-btn-up-c ui-btn-corner-all'>" + item.number_resolutions + "</span></a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addResolutions(" + item.id + ")'>Resolve &nbsp&nbsp&nbsp&nbsp</a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addItemComment(" + item.id + ")'>Comment &nbsp&nbsp&nbsp&nbsp</a></td></tr>");
                        $("#mcs_open_points_action_items_table").table("refresh");
                    }
                } else {
                    //alert(window.accounttype);
                    if (item.number_resolutions !== "0") { //If item doesnt have any resolutions associated with it, use theme a for the "View" Resolutions button
                        $('#mcs_open_points_action_items_table_body').append("<tr ><th class='label'>" + item.id + "</th><td>" + item.form_ref + "</td><td>" + item.priority + "</td><td>" + item.opened_by + "</td><td>" + item.date_opened + "</td><td>" + item.action_required + "</td><td>" + item.assigned_to + "</td><td>" + item.date_opened + "</td><td>" + item.due_date + "</td><td>b</td><td>c</td><td>d</td><td><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-comment ui-btn-icon-left ui-btn-b' onclick='viewResolutions(" + item.id + ")'>View &nbsp&nbsp&nbsp&nbsp<span class='ui-li-has-count ui-btn-up-c ui-btn-corner-all'>" + item.number_resolutions + "</span></a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addResolutions(" + item.id + ")'>Resolve &nbsp&nbsp&nbsp&nbsp</a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addItemComment(" + item.id + ")'>Comment &nbsp&nbsp&nbsp&nbsp</a></td></tr>");
                        $("#mcs_open_points_action_items_table").table("refresh");
                    } else {
                        $('#mcs_open_points_action_items_table_body').append("<tr ><th class='label'>" + item.id + "</th><td>" + item.form_ref + "</td><td>" + item.priority + "</td><td>" + item.opened_by + "</td><td>" + item.date_opened + "</td><td>" + item.action_required + "</td><td>" + item.assigned_to + "</td><td>" + item.date_opened + "</td><td>" + item.due_date + "</td><td>b</td><td>c</td><td>d</td><td><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-comment ui-btn-icon-left ui-btn-a' onclick='viewResolutions(" + item.id + ")'>View &nbsp&nbsp&nbsp&nbsp<span class='ui-li-has-count ui-btn-up-c ui-btn-corner-all'>" + item.number_resolutions + "</span></a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addResolutions(" + item.id + ")'>Resolve &nbsp&nbsp&nbsp&nbsp</a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addItemComment(" + item.id + ")'>Comment &nbsp&nbsp&nbsp&nbsp</a></td></tr>");
                        $("#mcs_open_points_action_items_table").table("refresh");
                    }
                }
            } else { //If user accounttype is not admin,	dont allow user to add new resolutions.
                if (window.username.toUpperCase() == item.opened_by.toUpperCase()) { //if current window.username is the same as the user who created the review point insert a button to allow user to close the review point.
                    //alert(window.accounttype);
                    if (item.number_resolutions !== "0") { //If item doesnt have any resolutions associated with it, use theme a for the "View" Resolutions button
                        $('#mcs_open_points_action_items_table_body').append("<tr ><th class='label'>" + item.id + "</th><td>" + item.form_ref + "</td><td>" + item.priority + "</td><td>" + item.opened_by + "<a href='#' onclick='confirmCloseOpenItem(" + item.id + ")' class='ui-btn ui-btn-inline ui-icon-delete ui-btn-icon-left' data-mini='true' >Close <br> Item</a></td><td>" + item.date_opened + "</td><td>" + item.action_required + "</td><td>" + item.assigned_to + "</td><td>" + item.date_opened + "</td><td>" + item.due_date + "</td><td>b</td><td>c</td><td>d</td><td><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-comment ui-btn-icon-left ui-btn-b' onclick='viewResolutions(" + item.id + ")'>View &nbsp&nbsp&nbsp&nbsp<span class='ui-li-has-count ui-btn-up-c ui-btn-corner-all'>" + item.number_resolutions + "</span></a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addResolutions(" + item.id + ")'>Resolve &nbsp&nbsp&nbsp&nbsp</a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addItemComment(" + item.id + ")'>Comment &nbsp&nbsp&nbsp&nbsp</a></td></tr>");
                    } else {
                        $('#mcs_open_points_action_items_table_body').append("<tr ><th class='label'>" + item.id + "</th><td>" + item.form_ref + "</td><td>" + item.priority + "</td><td>" + item.opened_by + "<a href='#' onclick='confirmCloseOpenItem(" + item.id + ")' class='ui-btn ui-btn-inline ui-icon-delete ui-btn-icon-left' data-mini='true' >Close <br> Item</a></td><td>" + item.date_opened + "</td><td>" + item.action_required + "</td><td>" + item.assigned_to + "</td><td>" + item.date_opened + "</td><td>" + item.due_date + "</td><td>b</td><td>c</td><td>d</td><td><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-comment ui-btn-icon-left ui-btn-a' onclick='viewResolutions(" + item.id + ")'>View &nbsp&nbsp&nbsp&nbsp<span class='ui-li-has-count ui-btn-up-c ui-btn-corner-all'>" + item.number_resolutions + "</span></a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addResolutions(" + item.id + ")'>Resolve &nbsp&nbsp&nbsp&nbsp</a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addItemComment(" + item.id + ")'>Comment &nbsp&nbsp&nbsp&nbsp</a></td></tr>");
                        $("#mcs_open_points_action_items_table").table("refresh");
                    }
                } else {
                    //alert(window.accounttype);
                    if (item.number_resolutions !== "0") { //If item doesnt have any resolutions associated with it, use theme a for the "View" Resolutions button
                        $('#mcs_open_points_action_items_table_body').append("<tr ><th class='label'>" + item.id + "</th><td>" + item.form_ref + "</td><td>" + item.priority + "</td><td>" + item.opened_by + "</td><td>" + item.date_opened + "</td><td>" + item.action_required + "</td><td>" + item.assigned_to + "</td><td>" + item.date_opened + "</td><td>" + item.due_date + "</td><td>b</td><td>c</td><td>d</td><td><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-comment ui-btn-icon-left ui-btn-b' onclick='viewResolutions(" + item.id + ")'>View &nbsp&nbsp&nbsp&nbsp<span class='ui-li-has-count ui-btn-up-c ui-btn-corner-all'>" + item.number_resolutions + "</span></a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addResolutions(" + item.id + ")'>Resolve &nbsp&nbsp&nbsp&nbsp</a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addItemComment(" + item.id + ")'>Comment &nbsp&nbsp&nbsp&nbsp</a></td></tr>");
                    } else {
                        $('#mcs_open_points_action_items_table_body').append("<tr ><th class='label'>" + item.id + "</th><td>" + item.form_ref + "</td><td>" + item.priority + "</td><td>" + item.opened_by + "</td><td>" + item.date_opened + "</td><td>" + item.action_required + "</td><td>" + item.assigned_to + "</td><td>" + item.date_opened + "</td><td>" + item.due_date + "</td><td>b</td><td>c</td><td>d</td><td><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-comment ui-btn-icon-left ui-btn-a' onclick='viewResolutions(" + item.id + ")'>View &nbsp&nbsp&nbsp&nbsp<span class='ui-li-has-count ui-btn-up-c ui-btn-corner-all'>" + item.number_resolutions + "</span></a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addResolutions(" + item.id + ")'>Resolve &nbsp&nbsp&nbsp&nbsp</a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addItemComment(" + item.id + ")'>Comment &nbsp&nbsp&nbsp&nbsp</a></td></tr>");
                        $("#mcs_open_points_action_items_table").table("refresh");
                    }
                }
            }
            //Start Hide Loading Message
            $.mobile.loading("hide");
            //End Hide Loading Message
        })
        $("#mcs_open_points_action_items_table").trigger("create");
    });
}

function getOnlyStatusClosedItems() {
    $.getJSON('http://api.universalbusinessmodel.com/ubmopenitemsonlystatuscloseditems.php?callback=?', { //JSONP Request
    }, function(res, status) {
        //	alert("request for open items was a success!");
        $('#mcs_open_points_action_items_table_body').empty();
        $.each(res, function(i, item) {
            if (window.accounttype == "admin") { //If user accounttype is admin, allow user to add new resolutions. If not, only allow them to view existing resolutions.
                if (window.username.toUpperCase() == item.opened_by.toUpperCase()) { //if current window.username is the same as the user who created the review point insert a button to allow user to mark the review point as closed.
                    //alert(window.accounttype);
                    if (item.number_resolutions !== "0") { //If item doesnt have any resolutions associated with it, use theme a for the "View" Resolutions button
                        $('#mcs_open_points_action_items_table_body').append("<tr ><th class='label'>" + item.id + "</th><td>" + item.form_ref + "</td><td>" + item.priority + "</td><td>" + item.date_opened + "</td><td>" + item.action_required + "</td><td>" + item.assigned_to + "</td><td>" + item.date_opened + "</td><td>" + item.due_date + "</td><td>b</td><td>c</td><td>d</td><td><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-comment ui-btn-icon-left ui-btn-b' onclick='viewResolutions(" + item.id + ")'>View &nbsp&nbsp&nbsp&nbsp<span class='ui-li-has-count ui-btn-up-c ui-btn-corner-all'>" + item.number_resolutions + "</span></a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addResolutions(" + item.id + ")'>Resolve &nbsp&nbsp&nbsp&nbsp</a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addItemComment(" + item.id + ")'>Comment &nbsp&nbsp&nbsp&nbsp</a></td></tr>");
                        $("#mcs_open_points_action_items_table").table("refresh");
                    } else {
                        $('#mcs_open_points_action_items_table_body').append("<tr ><th class='label'>" + item.id + "</th><td>" + item.form_ref + "</td><td>" + item.priority + "</td><td>" + item.date_opened + "</td><td>" + item.action_required + "</td><td>" + item.assigned_to + "</td><td>" + item.date_opened + "</td><td>" + item.due_date + "</td><td>b</td><td>c</td><td>d</td><td><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-comment ui-btn-icon-left ui-btn-a' onclick='viewResolutions(" + item.id + ")'>View &nbsp&nbsp&nbsp&nbsp<span class='ui-li-has-count ui-btn-up-c ui-btn-corner-all'>" + item.number_resolutions + "</span></a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addResolutions(" + item.id + ")'>Resolve &nbsp&nbsp&nbsp&nbsp</a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addItemComment(" + item.id + ")'>Comment &nbsp&nbsp&nbsp&nbsp</a></td></tr>");
                        $("#mcs_open_points_action_items_table").table("refresh");
                    }
                } else {
                    //alert(window.accounttype);
                    if (item.number_resolutions !== "0") { //If item doesnt have any resolutions associated with it, use theme a for the "View" Resolutions button
                        $('#mcs_open_points_action_items_table_body').append("<tr ><th class='label'>" + item.id + "</th><td>" + item.form_ref + "</td><td>" + item.priority + "</td><td>" + item.opened_by + "</td><td>" + item.date_opened + "</td><td>" + item.action_required + "</td><td>" + item.assigned_to + "</td><td>" + item.date_opened + "</td><td>" + item.due_date + "</td><td>b</td><td>c</td><td>d</td><td><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-comment ui-btn-icon-left ui-btn-b' onclick='viewResolutions(" + item.id + ")'>View &nbsp&nbsp&nbsp&nbsp<span class='ui-li-has-count ui-btn-up-c ui-btn-corner-all'>" + item.number_resolutions + "</span></a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addResolutions(" + item.id + ")'>Resolve &nbsp&nbsp&nbsp&nbsp</a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addItemComment(" + item.id + ")'>Comment &nbsp&nbsp&nbsp&nbsp</a></td></tr>");
                        $("#mcs_open_points_action_items_table").table("refresh");
                    } else {
                        $('#mcs_open_points_action_items_table_body').append("<tr ><th class='label'>" + item.id + "</th><td>" + item.form_ref + "</td><td>" + item.priority + "</td><td>" + item.opened_by + "</td><td>" + item.date_opened + "</td><td>" + item.action_required + "</td><td>" + item.assigned_to + "</td><td>" + item.date_opened + "</td><td>" + item.due_date + "</td><td>b</td><td>c</td><td>d</td><td><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-comment ui-btn-icon-left ui-btn-a' onclick='viewResolutions(" + item.id + ")'>View &nbsp&nbsp&nbsp&nbsp<span class='ui-li-has-count ui-btn-up-c ui-btn-corner-all'>" + item.number_resolutions + "</span></a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addResolutions(" + item.id + ")'>Resolve &nbsp&nbsp&nbsp&nbsp</a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addItemComment(" + item.id + ")'>Comment &nbsp&nbsp&nbsp&nbsp</a></td></tr>");
                        $("#mcs_open_points_action_items_table").table("refresh");
                    }
                }
            } else { //If user accounttype is not admin,	dont allow user to add new resolutions.
                if (window.username.toUpperCase() == item.opened_by.toUpperCase()) { //if current window.username is the same as the user who created the review point insert a button to allow user to close the review point.
                    //alert(window.accounttype);
                    if (item.number_resolutions !== "0") { //If item doesnt have any resolutions associated with it, use theme a for the "View" Resolutions button
                        $('#mcs_open_points_action_items_table_body').append("<tr ><th class='label'>" + item.id + "</th><td>" + item.form_ref + "</td><td>" + item.priority + "</td><td>" + item.date_opened + "</td><td>" + item.action_required + "</td><td>" + item.assigned_to + "</td><td>" + item.date_opened + "</td><td>" + item.due_date + "</td><td>b</td><td>c</td><td>d</td><td><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-comment ui-btn-icon-left ui-btn-b' onclick='viewResolutions(" + item.id + ")'>View &nbsp&nbsp&nbsp&nbsp<span class='ui-li-has-count ui-btn-up-c ui-btn-corner-all'>" + item.number_resolutions + "</span></a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addResolutions(" + item.id + ")'>Resolve &nbsp&nbsp&nbsp&nbsp</a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addItemComment(" + item.id + ")'>Comment &nbsp&nbsp&nbsp&nbsp</a></td></tr>");
                    } else {
                        $('#mcs_open_points_action_items_table_body').append("<tr ><th class='label'>" + item.id + "</th><td>" + item.form_ref + "</td><td>" + item.priority + "</td><td>" + item.date_opened + "</td><td>" + item.action_required + "</td><td>" + item.assigned_to + "</td><td>" + item.date_opened + "</td><td>" + item.due_date + "</td><td>b</td><td>c</td><td>d</td><td><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-comment ui-btn-icon-left ui-btn-a' onclick='viewResolutions(" + item.id + ")'>View &nbsp&nbsp&nbsp&nbsp<span class='ui-li-has-count ui-btn-up-c ui-btn-corner-all'>" + item.number_resolutions + "</span></a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addResolutions(" + item.id + ")'>Resolve &nbsp&nbsp&nbsp&nbsp</a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addItemComment(" + item.id + ")'>Comment &nbsp&nbsp&nbsp&nbsp</a></td></tr>");
                        $("#mcs_open_points_action_items_table").table("refresh");
                    }
                } else {
                    //alert(wi/ndow.accounttype);
                    if (item.number_resolutions !== "0") { //If item doesnt have any resolutions associated with it, use theme a for the "View" Resolutions button
                        $('#mcs_open_points_action_items_table_body').append("<tr ><th class='label'>" + item.id + "</th><td>" + item.form_ref + "</td><td>" + item.priority + "</td><td>" + item.opened_by + "</td><td>" + item.date_opened + "</td><td>" + item.action_required + "</td><td>" + item.assigned_to + "</td><td>" + item.date_opened + "</td><td>" + item.due_date + "</td><td>b</td><td>c</td><td>d</td><td><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-comment ui-btn-icon-left ui-btn-b' onclick='viewResolutions(" + item.id + ")'>View &nbsp&nbsp&nbsp&nbsp<span class='ui-li-has-count ui-btn-up-c ui-btn-corner-all'>" + item.number_resolutions + "</span></a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addResolutions(" + item.id + ")'>Resolve &nbsp&nbsp&nbsp&nbsp</a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addItemComment(" + item.id + ")'>Comment &nbsp&nbsp&nbsp&nbsp</a></td></tr>");
                    } else {
                        $('#mcs_open_points_action_items_table_body').append("<tr ><th class='label'>" + item.id + "</th><td>" + item.form_ref + "</td><td>" + item.priority + "</td><td>" + item.opened_by + "</td><td>" + item.date_opened + "</td><td>" + item.action_required + "</td><td>" + item.assigned_to + "</td><td>" + item.date_opened + "</td><td>" + item.due_date + "</td><td>b</td><td>c</td><td>d</td><td><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-comment ui-btn-icon-left ui-btn-a' onclick='viewResolutions(" + item.id + ")'>View &nbsp&nbsp&nbsp&nbsp<span class='ui-li-has-count ui-btn-up-c ui-btn-corner-all'>" + item.number_resolutions + "</span></a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addResolutions(" + item.id + ")'>Resolve &nbsp&nbsp&nbsp&nbsp</a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addItemComment(" + item.id + ")'>Comment &nbsp&nbsp&nbsp&nbsp</a></td></tr>");
                        $("#mcs_open_points_action_items_table").table("refresh");
                    }
                }
            }
            //Start Hide Loading Message
            $.mobile.loading("hide");
            //End Hide Loading Message
        })
        $("#mcs_open_points_action_items_table").trigger("create");
    });
}

function getMyOpenItems() {
    $.getJSON('http://api.universalbusinessmodel.com/ubms_openItems_statusOpen_currentUser.php?callback=?', { //JSONP Request
        key: window.key,
        username: window.username
    }, function(res, status) {
        //	alert("request for open items was a success!");
        $('#mcs_open_points_action_items_table_body').empty();
        $.each(res, function(i, item) {
            if (window.accounttype == "admin") { //If user accounttype is admin, allow user to add new resolutions. If not, only allow them to view existing resolutions.
                if (window.username.toUpperCase() == item.opened_by.toUpperCase()) { //if current window.username is the same as the user who created the review point insert a button to allow user to mark the review point as closed.
                    //alert(window.accounttype);
                    if (item.number_resolutions !== "0") { //If item doesnt have any resolutions associated with it, use theme a for the "View" Resolutions button
                        $('#mcs_open_points_action_items_table_body').append("<tr ><th class='label'>" + item.id + "</th><td>" + item.form_ref + "</td><td>" + item.priority + "</td><td>" + item.opened_by + "<a href='#' onclick='confirmCloseOpenItem(" + item.id + ")' class='ui-btn ui-btn-inline ui-icon-delete ui-btn-icon-left' data-mini='true'>Close <br> Item</a></td><td>" + item.date_opened + "</td><td>" + item.action_required + "</td><td>" + item.assigned_to + "</td><td>" + item.date_opened + "</td><td>" + item.due_date + "</td><td>b</td><td>c</td><td>d</td><td><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-comment ui-btn-icon-left ui-btn-b' onclick='viewResolutions(" + item.id + ")'>View &nbsp&nbsp&nbsp&nbsp<span class='ui-li-has-count ui-btn-up-c ui-btn-corner-all'>" + item.number_resolutions + "</span></a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addResolutions(" + item.id + ")'>Resolve &nbsp&nbsp&nbsp&nbsp</a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addItemComment(" + item.id + ")'>Comment &nbsp&nbsp&nbsp&nbsp</a></td></tr>");
                        $("#mcs_open_points_action_items_table").table("refresh");
                    } else {
                        $('#mcs_open_points_action_items_table_body').append("<tr ><th class='label'>" + item.id + "</th><td>" + item.form_ref + "</td><td>" + item.priority + "</td><td>" + item.opened_by + "<a href='#' onclick='confirmCloseOpenItem(" + item.id + ")' class='ui-btn ui-btn-inline ui-icon-delete ui-btn-icon-left' data-mini='true'>Close <br> Item</a></td><td>" + item.date_opened + "</td><td>" + item.action_required + "</td><td>" + item.assigned_to + "</td><td>" + item.date_opened + "</td><td>" + item.due_date + "</td><td>b</td><td>c</td><td>d</td><td><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-comment ui-btn-icon-left ui-btn-a' onclick='viewResolutions(" + item.id + ")'>View &nbsp&nbsp&nbsp&nbsp<span class='ui-li-has-count ui-btn-up-c ui-btn-corner-all'>" + item.number_resolutions + "</span></a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addResolutions(" + item.id + ")'>Resolve &nbsp&nbsp&nbsp&nbsp</a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addItemComment(" + item.id + ")'>Comment &nbsp&nbsp&nbsp&nbsp</a></td></tr>");
                        $("#mcs_open_points_action_items_table").table("refresh");
                    }
                } else {
                    //alert(window.accounttype);
                    if (item.number_resolutions !== "0") { //If item doesnt have any resolutions associated with it, use theme a for the "View" Resolutions button
                        $('#mcs_open_points_action_items_table_body').append("<tr ><th class='label'>" + item.id + "</th><td>" + item.form_ref + "</td><td>" + item.priority + "</td><td>" + item.opened_by + "</td><td>" + item.date_opened + "</td><td>" + item.action_required + "</td><td>" + item.assigned_to + "</td><td>" + item.date_opened + "</td><td>" + item.due_date + "</td><td>b</td><td>c</td><td>d</td><td><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-comment ui-btn-icon-left ui-btn-b' onclick='viewResolutions(" + item.id + ")'>View &nbsp&nbsp&nbsp&nbsp<span class='ui-li-has-count ui-btn-up-c ui-btn-corner-all'>" + item.number_resolutions + "</span></a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addResolutions(" + item.id + ")'>Resolve &nbsp&nbsp&nbsp&nbsp</a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addItemComment(" + item.id + ")'>Comment &nbsp&nbsp&nbsp&nbsp</a></td></tr>");
                        $("#mcs_open_points_action_items_table").table("refresh");
                    } else {
                        $('#mcs_open_points_action_items_table_body').append("<tr ><th class='label'>" + item.id + "</th><td>" + item.form_ref + "</td><td>" + item.priority + "</td><td>" + item.opened_by + "</td><td>" + item.date_opened + "</td><td>" + item.action_required + "</td><td>" + item.assigned_to + "</td><td>" + item.date_opened + "</td><td>" + item.due_date + "</td><td>b</td><td>c</td><td>d</td><td><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-comment ui-btn-icon-left ui-btn-a' onclick='viewResolutions(" + item.id + ")'>View &nbsp&nbsp&nbsp&nbsp<span class='ui-li-has-count ui-btn-up-c ui-btn-corner-all'>" + item.number_resolutions + "</span></a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addResolutions(" + item.id + ")'>Resolve &nbsp&nbsp&nbsp&nbsp</a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addItemComment(" + item.id + ")'>Comment &nbsp&nbsp&nbsp&nbsp</a></td></tr>");
                        $("#mcs_open_points_action_items_table").table("refresh");
                    }
                }
            } else { //If user accounttype is not admin,	dont allow user to add new resolutions.
                if (window.username.toUpperCase() == item.opened_by.toUpperCase()) { //if current window.username is the same as the user who created the review point insert a button to allow user to close the review point.
                    //alert(window.accounttype);
                    if (item.number_resolutions !== "0") { //If item doesnt have any resolutions associated with it, use theme a for the "View" Resolutions button
                        $('#mcs_open_points_action_items_table_body').append("<tr ><th class='label'>" + item.id + "</th><td>" + item.form_ref + "</td><td>" + item.priority + "</td><td>" + item.opened_by + "<a href='#' onclick='confirmCloseOpenItem(" + item.id + ")' class='ui-btn ui-btn-inline ui-icon-delete ui-btn-icon-left'data-mini='true' >Close <br> Item</a></td><td>" + item.date_opened + "</td><td>" + item.action_required + "</td><td>" + item.assigned_to + "</td><td>" + item.date_opened + "</td><td>" + item.due_date + "</td><td>b</td><td>c</td><td>d</td><td><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-comment ui-btn-icon-left ui-btn-b' onclick='viewResolutions(" + item.id + ")'>View &nbsp&nbsp&nbsp&nbsp<span class='ui-li-has-count ui-btn-up-c ui-btn-corner-all'>" + item.number_resolutions + "</span></a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addResolutions(" + item.id + ")'>Resolve &nbsp&nbsp&nbsp&nbsp</a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addItemComment(" + item.id + ")'>Comment &nbsp&nbsp&nbsp&nbsp</a></td></tr>");
                    } else {
                        $('#mcs_open_points_action_items_table_body').append("<tr ><th class='label'>" + item.id + "</th><td>" + item.form_ref + "</td><td>" + item.priority + "</td><td>" + item.opened_by + "<a href='#' onclick='confirmCloseOpenItem(" + item.id + ")' class='ui-btn ui-btn-inline ui-icon-delete ui-btn-icon-left'data-mini='true' >Close <br> Item</a></td><td>" + item.date_opened + "</td><td>" + item.action_required + "</td><td>" + item.assigned_to + "</td><td>" + item.date_opened + "</td><td>" + item.due_date + "</td><td>b</td><td>c</td><td>d</td><td><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-comment ui-btn-icon-left ui-btn-a' onclick='viewResolutions(" + item.id + ")'>View &nbsp&nbsp&nbsp&nbsp<span class='ui-li-has-count ui-btn-up-c ui-btn-corner-all'>" + item.number_resolutions + "</span></a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addResolutions(" + item.id + ")'>Resolve &nbsp&nbsp&nbsp&nbsp</a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addItemComment(" + item.id + ")'>Comment &nbsp&nbsp&nbsp&nbsp</a></td></tr>");
                        $("#mcs_open_points_action_items_table").table("refresh");
                    }
                } else {
                    //alert(window.accounttype);
                    if (item.number_resolutions !== "0") { //If item doesnt have any resolutions associated with it, use theme a for the "View" Resolutions button
                        $('#mcs_open_points_action_items_table_body').append("<tr ><th class='label'>" + item.id + "</th><td>" + item.form_ref + "</td><td>" + item.priority + "</td><td>" + item.opened_by + "</td><td>" + item.date_opened + "</td><td>" + item.action_required + "</td><td>" + item.assigned_to + "</td><td>" + item.date_opened + "</td><td>" + item.due_date + "</td><td>b</td><td>c</td><td>d</td><td><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-comment ui-btn-icon-left ui-btn-b' onclick='viewResolutions(" + item.id + ")'>View &nbsp&nbsp&nbsp&nbsp<span class='ui-li-has-count ui-btn-up-c ui-btn-corner-all'>" + item.number_resolutions + "</span></a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addResolutions(" + item.id + ")'>Resolve &nbsp&nbsp&nbsp&nbsp</a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addItemComment(" + item.id + ")'>Comment &nbsp&nbsp&nbsp&nbsp</a></td></tr>");
                    } else {
                        $('#mcs_open_points_action_items_table_body').append("<tr ><th class='label'>" + item.id + "</th><td>" + item.form_ref + "</td><td>" + item.priority + "</td><td>" + item.opened_by + "</td><td>" + item.date_opened + "</td><td>" + item.action_required + "</td><td>" + item.assigned_to + "</td><td>" + item.date_opened + "</td><td>" + item.due_date + "</td><td>b</td><td>c</td><td>d</td><td><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-comment ui-btn-icon-left ui-btn-a' onclick='viewResolutions(" + item.id + ")'>View &nbsp&nbsp&nbsp&nbsp<span class='ui-li-has-count ui-btn-up-c ui-btn-corner-all'>" + item.number_resolutions + "</span></a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addResolutions(" + item.id + ")'>Resolve &nbsp&nbsp&nbsp&nbsp</a><a href='#' data-rel='popup' data-transition='slideup' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a' onclick='addItemComment(" + item.id + ")'>Comment &nbsp&nbsp&nbsp&nbsp</a></td></tr>");
                        $("#mcs_open_points_action_items_table").table("refresh");
                    }
                }
            }
            //Start Hide Loading Message
            $.mobile.loading("hide");
            //End Hide Loading Message
        })
        $("#mcs_open_points_action_items_table").trigger("create");
    });

}

function addItemComment(id) {
    window.openitemid = id;
    $("#mcs_open_points_action_items_submitcomment_popup").popup('open');
}

function submitComment() {
    $.getJSON('http://api.universalbusinessmodel.com/ubm_modelcreationsuite_openitem_createcomment.php?callback=?', { //JSONP Request
        openitemid: window.openitemid,
        author: window.username,
        comment: document.getElementById("open_points_action_items_submitComment_form_comment").value,
        type: document.getElementById("open_points_action_items_submitComment_form_type").value
    }, function(res, status) {
        $().toastmessage('showSuccessToast', "Comment Submission Status! " + status + "");
        $('#open_points_action_items_submitComment_form').each(function() {
            this.reset();
        });
        $('mcs_open_points_action_items_submitcomment_popup').popup("close");
    });

}

function addResolutions(id) {
    window.openitemid = id;
    $("#mcs_open_points_action_items_submitresolution_popup").popup('open');
    //window.openitemid = id;
    //submitResolution();
}

function submitResolution() {
    $.getJSON('http://api.universalbusinessmodel.com/ubm_modelcreationsuite_openitem_createresolutions1.php?callback=?', { //JSONP Request
        openitemid: window.openitemid,
        username: window.username,
        disposition: document.getElementById("open_points_action_items_submitResolution_form_disposition").value,
        githuburl: document.getElementById("open_points_action_items_submitResolution_form_githuturl").value
    }, function(res, status) {
        if (status = "SUCCESS") { //If request is successful, empty the form.
            $('#open_points_action_items_submitResolution_form').each(function() {
                this.reset();
                $("#mcs_open_points_action_items_submitresolution_popup").popup("close");
            });
        }
    });
    setTimeout(function() {}, 1500);
}

function viewResolutions(id) {
    showLoader();
    $.getJSON('http://api.universalbusinessmodel.com/ubm_selectallresolutions.php?callback=?', { //JSONP Request
        openitemid: id,
        username: window.username
    }, function(res, status) {
        //alert("json returned successfully! " + status);
        $('#mcs_open_points_action_items_resolution_popup_ul').empty();
        $.each(res, function(i, item) {
            //alert(item.disposition);
            $('#mcs_open_points_action_items_resolution_popup_ul').append("<li><a href='#' data-rel='popup' data-position-to='window' data-transition='pop'><h1>" + item.closed_by + "</h1><p style='white-space:normal;'>" + item.disposition + "</p><p class='ui-li-aside'>Resolution Date:</br> <strong>" + item.resolution_date + "</strong></p></a></li>");
            $('#mcs_open_points_action_items_resolution_popup_ul').append("<li data-role='list-divider' >" + item.githuburl + "</p></li>");
            //$('#mcs_open_points_action_items_resolution_popup_ul').append("<div style='height:200px; width:200px; text-wrap: normal;'>New Resolution: " + item.disposition + "</div>");
            $('#mcs_open_points_action_items_resolution_popup_ul').listview("refresh");
        })
    });
    $.getJSON('http://api.universalbusinessmodel.com/ubm_select_allActiveOpenItemComments.php?callback=?', { //JSONP Request
        openitemid: id,
        username: window.username
    }, function(res, status) {
        //alert("json returned successfully! " + status);
        $('#mcs_open_points_action_items_comment_popup_ul').empty();

        $.each(res, function(i, item) {
            //alert(item.disposition);
            $('#mcs_open_points_action_items_comment_popup_ul').append("<li><a href='#' data-rel='popup' data-position-to='window' data-transition='pop'><h1>" + item.author + "</h1><p style='white-space:normal;'>" + item.comment + "</p><p class='ui-li-aside'>Comment Date:</br> <strong>" + item.date_added + "</strong></p></a></li>");
            //$('#mcs_open_points_action_items_resolution_popup_ul').append("<div style='height:200px; width:200px; text-wrap: normal;'>New Resolution: " + item.disposition + "</div>");
            $('#mcs_open_points_action_items_comment_popup_ul').listview("refresh");
        })
    });


    $('#mcs_open_points_action_items_resolution_popup_ul').listview("refresh");
    setTimeout(function() {
        $("#mcs_open_points_action_items_resolution_popup").popup('open');
        hideLoader();
    }, 1500);
}