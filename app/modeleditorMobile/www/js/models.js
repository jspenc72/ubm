function getMyModels() { //Get all models in database where current user is the creator.
    //showLoader();
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_getMyModels.php?callback=?', { //JSONP Request
        username: window.username,
        key: window.key
    }, function(res, status) {
        $('#myModels_list').empty();
        $('#myModels_list').append("<li data-role='list-divider'><center>Models I Created</center></li>");
        $('#myModels_list').listview().listview("refresh");
        $.each(res, function(i, item) {
            $('#myModels_list').append("<li id='creator_name_list_divider' data-role='list-divider' >Model Contact: " + item.creator_id + "</li>");
            $('#myModels_list').append("<li><a href='#models' onclick='setActiveModel(" + item.UUID + ")'></br></br></br><h2 style='white-space:normal;'>Title: " + item.title + "</h2><p><strong>Model Reference: " + item.reference + "</strong></p><p style='white-space:normal;'>" + item.description + "</p><p class='ui-li-aside'>Creation Date:</br> <strong>" + item.created_date + "</strong></p></a></li>");
            $('#myModels_list').listview().listview("refresh");
            //     $(".model_listItem").hover();
        });
        getSharedModels();
    });
}

function getSharedModels() { //Get all models in database where current user is the creator.
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_getSharedModels.php?callback=?', { //JSONP Request
        username: window.username,
        key: window.key
    }, function(res, status) {
        $('#sharedModels_list').empty();
        $('#sharedModels_list').append("<li data-role='list-divider'><center>Models Shared with Me</center></li>");
        $('#sharedModels_list').listview().listview("refresh");
        $.each(res, function(i, item) {
            if (window.username !== item.creator_id) {
                $('#sharedModels_list').append("<li data-role='list-divider' >Model Creator: " + item.creator_id + "</li>");
                $('#sharedModels_list').append("<li><a href='#models' onclick='setActiveModel(" + item.UUID + ")'></br></br></br><h2 style='white-space:normal;'>Title: " + item.title + "</h2><p><strong>Model Reference: " + item.reference + "</strong></p><p style='white-space:normal;'>" + item.description + "</p><p class='ui-li-aside'>Creation Date:</br> <strong>" + item.created_date + "</strong></p></a></li>");
                $('#sharedModels_list').listview().listview("refresh");
            }
        });
        // hideLoader();
    });
}

function setActiveModel(activeModelUUID) {
    $('.modelApp_title_header').empty();
    window.activeModelUUID = activeModelUUID;
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelCreationSuite_getModelName.php?callback=?', { //JSONP Request
        key: window.key,
        activeModelUUID: window.activeModelUUID,
    }, function(res, status) {
        $(".modelApp_title_header").append("Model / App Title: " + res + "");
        window.location = "#positions";
    });

}

function updateObject(updateSwitch) {
    //alert("This is a test: "+ window.activeUUID);
    var counter = 1;
    //1. Declare counter variable to keep track of the number of inputs in a given form.
    var errors = [];
    //2. Declare errors[] array to keep track of inputs that dont pass validation.      
    var objectArray = {};
    // Declare objectArray[] array to store all objects that are going to be submitted.  
    var elementId = '#' + window.activeubm_page + '_editObject_popup_content_container';
    $('jobDescriptions_editObject_popup_content_container :input').each(function() {
        alert("was called");
        var value = $(this).val();
        var columnName = $(this).attr('db-columnname');
        objectArray[columnName] = value;
        //tasksArray[key] = value;
        //alert($(this).val());
        if ($(this).val().length >= 1) {
            //3. Check to see if value has been entered into the input.

            //4. alert("Input: " + $(this).attr('placeholder') + " has value: " + this.value);
        } else {
            alert("Input: " + $(this).attr('placeholder') + " is required but has no value.");
            //5. Alert the user if the length of the inputs value is less than 1.
            errors.push($(this).attr('id'));
            //6. Add the input id to the errors array.
        }
        counter = counter + 1;
        //7. iterate the counter.
    });
    if (errors.length == 0 && objectArray.length != 0) {
        //8. If there are no errors, continue with the jsonp request.
        //alert (window.activeObjectUUID);
        $.getJSON('http://api.universalbusinessmodel.com/ubms_modelCreationSuite_updateObject.php?callback=?', { //JSONP Request
            key: window.key,
            username: window.username,
            activeModelUUID: window.activeModelUUID,
            activeObjectUUID: window.activeObjectUUID,
            objectArray: objectArray,
            updateSwitch: updateSwitch
        }, function(res, status) {
            //$().toastmessage('showNoticeToast', res.message);
        });
        $('.editObject_popup_content_container').each(function() {
            this.reset();
        });
    }
}

function editObject() {
    $(".ui-popup").popup("close");
    // showLoader();
    setTimeout(function() {
        $(".editObject_popup_content_container").empty();
        $(".editObjectTitle").children(".ui-collapsible-heading-toggle").not('.ui-collapsible-heading-status').empty();
        $(".header_editObjectTitle").empty();
        $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_get_OjectDetail.php?callback=?', {
            key: window.key,
            activeUUID: window.activeObjectUUID
        }, function(res, status) {
            //1. Open Popup
            //2. Append 1 input for each of the fields received from the API, set the value of each equal to the value of each field in the array.
            //3. 
            $.each(res, function(i, item) {
                if (item.object_type == "MD") {
                    var objectName = "Model";
                } else if (item.object_type == "PS") {
                    var objectName = "Position";
                } else if (item.object_type == "JD") {
                    var objectName = "Job Description";
                } else if (item.object_type == "PL") {
                    var objectName = "Policy";
                } else if (item.object_type == "PR") {
                    var objectName = "Procedure";
                } else if (item.object_type == "ST") {
                    var objectName = "Step";
                } else if (item.object_type == "TK") {
                    var objectName = "Task";
                } else {
                    console.log(item.object_type);
                }
                $(".editObjectTitle").children(".ui-collapsible-heading-toggle").prepend("Edit " + objectName + " : " + item.title);
                $(".header_editObjectTitle").append(objectName + " : " + item.title);
                $(".editObject_popup_content_container").append("<li class='ui-body ui-body-a'><fieldset class='ui-grid-a'><div class='ui-block-a'><a href='#' class='ui-shadow ui-btn ui-corner-all ui-btn-icon-left ui-icon-plus ui-btn-a' onclick='updateObject(1)' title='This will update all objects with the same name. You can only do this if you are the creator!'>Update All</a></div><div class='ui-block-b'><a href='#' onclick='updateObject(0)' class='ui-shadow ui-btn ui-corner-all ui-btn-icon-left ui-icon-delete ui-btn-a' title='Only this object will be changed.'>Update One</a></div></fieldset></li>");
                var key;
                // Add any column to keyArray that you do not want to show up in the editable popup
                var keyArray = ["id", "position_has_org_chart_level", "reports_to_id", "creation_date", "ads_ubm_h_ps_id", "ads_ubm_order_no", "adapted_from_id", "object_type", "object_type", "creator_username", "object_type", "created_by", "creation_date", "created_date", "sourceModel_reference", "ads_ubm_h_jd_id", "ads_jd_ref", "mfi_reference", "ads_ubm_h_pl_id", "ads_ubm_h_pr_id"];
                for (key in item) {
                    if (item.hasOwnProperty(key)) {
                        //checks the keyArray for the value
                        if (keyArray.indexOf(key) >= 0) {
                            console.log(key);
                            if (key == "object_type") {
                                var visKey = key.charAt(0).toUpperCase() + key.slice(1);
                                visKey = visKey.split('_').join(' ');
                                $(".editObject_popup_content_container").append("<label style='display:none' for='textarea'>   " + visKey + ":</label>");
                                $(".editObject_popup_content_container").append("<li style='display:none;' class='ui-field-contain'><textarea type='text' cols='40' rows='4' name='textarea' id='textarea' db-columnname='" + key + "' value='' placeholder='" + visKey + "'>" + item[key] + "</textarea></li>");
                            }
                        } else {
                            var visKey = key.charAt(0).toUpperCase() + key.slice(1);
                            visKey = visKey.split('_').join(' ');

                            $(".editObject_popup_content_container").append("<label for='textarea'>    " + visKey + ":</label>");
                            $(".editObject_popup_content_container").append("<li class='ui-field-contain'><textarea type='text' cols='40' rows='4' name='textarea' id='textarea' db-columnname='" + key + "' value='' placeholder='" + visKey + "'>" + item[key] + "</textarea></li>");
                        }
                    }
                }
            });
            // hideLoader();
        });
    }, 500);

}