
function NewChecklist(){
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_user_create_Checklist.php?callback=?', { //JSONP Request
        key: window.key,
        username: window.username,
        checklist_title: $("#checklist_title").val(),
        checklist_description: $("#checklist_description").val(),
        checklist_purpose: $("#checklist_purpose").val()
    }, function(res, status) {
        alert(res.message);
        getChecklistsCreatedByUser();
    }); 
}
function SaveChecklist(){
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_user_save_Checklist.php?callback=?', { //JSONP Request
        key: window.key,
        username: window.username,
        checklist_title: $("#checklist_title").val(),
        checklist_description: $("#checklist_description").val(),
        checklist_purpose: $("#checklist_purpose").val(),
        activeChecklistUUID: window.activeChecklistUUID
    }, function(res, status) {
        alert(res.message);
        getChecklistsCreatedByUser();
    }); 
}

function saveAsNewChecklist(){

}

function ViewGeneratedChecklist(){
    generateChecklistSubmit();
}

function GetChecklistAttachments(){
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_checklist_get_Direct_ElementPosterityTree.php?callback=?', { //JSONP Request
        key: window.key,
        username: window.username,
        activeObjectUUID: window.activeChecklistUUID
    }, function(res, status) {
        var isFirst = 100;
        var PR_count = 0;
        var ST_count = 0;
        var TK_count = 0;
        var fileInput = "";
        var textInput = "";
        var checkboxInput = "";

        $('#checklist_preview').empty();

        $.each(res, function(i, item) {    
            isFirst = i;   
            //Get the values of the acceptable submission types.
            if(item.item_type_fileInput=="TRUE"){
                fileInput = "checked";
            }else{
                fileInput = "";
            }
            if(item.item_type_textInput=="TRUE"){
                textInput = "checked";
            }else{
                textInput = "";
            }
            if(item.item_type_YN=="TRUE"){
                checkboxInput = "checked";
            }else{
                checkboxInput = "";
            }
            if(item.object_type=="PR"){
                PR_count += 1;
                $('#checklist_preview').append("<li data-role='collapsible' data-iconpos=right data-shadow='false' data-corners='false'><h2>Procedure " + PR_count + ": " + item.title + "</h2><form><a style='color:red; float:right; white-space:normal;' onclick='removeItemFromChecklist("+item.UUID+")' class='ui-btn'>Remove</a><fieldset data-role='controlgroup' data-type='vertical'><label>Photo Upload<input type='checkbox' data-thisItemUUID='" + item.UUID + "' name='CL_Builder_PU_Checkbox_" + item.UUID + "' id='CL_Builder_PU_Checkbox_" + item.UUID + "' "+fileInput+"></label><label>Text Input<input type='checkbox' data-thisItemUUID='" + item.UUID + "' name='CL_Builder_TI_Checkbox_" + item.UUID + "' id='CL_Builder_TI_Checkbox_" + item.UUID + "' "+textInput+"></label><label>Checkbox Completion<input type='checkbox' data-thisItemUUID='" + item.UUID + "' name='CL_Builder_CC_Checkbox_" + item.UUID + "' id='CL_Builder_CC_Checkbox_" + item.UUID + "' "+checkboxInput+"></label></fieldset></form><ul data-role='listview' data-shadow='false' data-inset='true' data-corners='false'><a style='color:blue; float:right; white-space:normal;' onclick='addProcedureStepsToChecklist("+item.UUID+")' class='ui-btn'>Add Steps</a><li data-iconpos='right' data-shadow='false' data-corners='false'><h2>Steps: </h2><ul data-role='listview' data-shadow='false' data-inset='true' data-corners='false'><li>Tasks: </li></ul></li></ul></li>");
                $('#checklist_preview').listview("refresh").trigger("create");
                            
            }else if (item.object_type=="ST"){
                ST_count += 1;
                $('#checklist_preview').append("<li data-role='collapsible' data-iconpos=right data-shadow='false' data-corners='false'><h2>Step " + ST_count + ": " + item.title + "</h2><a style='color:red; float:right; white-space:normal;' onclick='removeItemFromChecklist("+item.UUID+")' class='ui-btn'>Remove</a><form><fieldset data-role='controlgroup' data-type='vertical'><label>Photo Upload<input type='checkbox' data-thisItemUUID='" + item.UUID + "' name='CL_Builder_PU_Checkbox_" + item.UUID + "' id='CL_Builder_PU_Checkbox_" + item.UUID + "' "+fileInput+"></label><label>Text Input<input type='checkbox' data-thisItemUUID='" + item.UUID + "' name='CL_Builder_TI_Checkbox_" + item.UUID + "' id='CL_Builder_TI_Checkbox_" + item.UUID + "' "+textInput+"></label><label>Checkbox Completion<input type='checkbox' data-thisItemUUID='" + item.UUID + "' name='CL_Builder_CC_Checkbox_" + item.UUID + "' id='CL_Builder_CC_Checkbox_" + item.UUID + "' "+checkboxInput+"></label></fieldset><a style='color:blue; float:right; white-space:normal;' onclick='addProcedureTasksToChecklist("+item.UUID+")' class='ui-btn'>Add Tasks</a></form><ul data-role='listview' data-shadow='false' data-inset='true' data-corners='false'><li data-iconpos='right' data-shadow='false' data-corners='false'><h2>Tasks: </h2></li></ul></li>");
                $('#checklist_preview').listview("refresh").trigger("create");
            }else if (item.object_type=="TK"){
                TK_count += 1;
                $('#checklist_preview').append("<li data-role='collapsible' data-iconpos=right data-shadow='false' data-corners='false'><h2>Task " + TK_count + ": " + item.title + "</h2><a style='color:red; float:right; white-space:normal;' onclick='removeItemFromChecklist("+item.UUID+")' class='ui-btn'>Remove</a><form><fieldset data-role='controlgroup' data-type='vertical'><label>Photo Upload<input type='checkbox' data-thisItemUUID='" + item.UUID + "' name='CL_Builder_PU_Checkbox_" + item.UUID + "' id='CL_Builder_PU_Checkbox_" + item.UUID + "' "+fileInput+"></label><label>Text Input<input type='checkbox' data-thisItemUUID='" + item.UUID + "' name='CL_Builder_TI_Checkbox_" + item.UUID + "' id='CL_Builder_TI_Checkbox_" + item.UUID + "' "+textInput+"></label><label>Checkbox Completion<input type='checkbox' data-thisItemUUID='" + item.UUID + "' name='CL_Builder_CC_Checkbox_" + item.UUID + "' id='CL_Builder_CC_Checkbox_" + item.UUID + "' "+checkboxInput+"></label></fieldset></form></li>");
                $('#checklist_preview').listview("refresh").trigger("create");
            }
        });
        if($('#checklist_preview').children().length==0){
            alert("Procedures, steps and tasks may be used to generate a checklist... However none of those objects seem to be attached to the current checklist. You may search and select items to the right to add them to your checklist.");
            $('#checklist_preview').append("<li><p>This checklist has nothing attached to it. Click one of the + buttons to the right to begin your search for available attachments.</p></li>");
            $('#checklist_preview').listview("refresh").trigger("create");
        }else{}
    });    
    $(document).on('change', 'input[name^="CL_Builder_PU_Checkbox_"]', function() {
        var allowableInput;
        if($(this).is(":checked")) {
            allowableInput = "TRUE";
            $(this).prop("checked", true).checkboxradio("refresh");

        }else{
            allowableInput = "FALSE";
            $(this).prop("checked", false).checkboxradio("refresh");
        }
        var activeItemUUID = $(this).attr("data-thisItemUUID");

        modifyItemInputMethod(activeItemUUID,allowableInput,"fileInput");
    }); 
    $(document).on('change', 'input[name^="CL_Builder_TI_Checkbox_"]', function() {
        var allowableInput;
        if($(this).is(":checked")) {
            allowableInput = "TRUE";
            $(this).prop("checked", true).checkboxradio("refresh");

        }else{
            allowableInput = "FALSE";
            $(this).prop("checked", false).checkboxradio("refresh");
        }
        var activeItemUUID = $(this).attr("data-thisItemUUID");

        modifyItemInputMethod(activeItemUUID,allowableInput,"textInput");
    }); 
    $(document).on('change', 'input[name^="CL_Builder_CC_Checkbox_"]', function() {
        var allowableInput;
        if($(this).is(":checked")) {
            allowableInput = "TRUE";
            $(this).prop("checked", true).checkboxradio("refresh");

        }else{
            allowableInput = "FALSE";
            $(this).prop("checked", false).checkboxradio("refresh");
        }
        var activeItemUUID = $(this).attr("data-thisItemUUID");

        modifyItemInputMethod(activeItemUUID,allowableInput,"CheckboxCompletion");
    }); 
}
function modifyItemInputMethod(activeChecklistItemUUID,allowableInput,inputType){

    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_checklist_modify_Item_inputMethod.php?callback=?', { //JSONP Request
        key: window.key,
        username: window.username,
        activeChecklistItemUUID: activeChecklistItemUUID,
        allowableInput: allowableInput,
        inputType: inputType
    }, function(res, status) {
        $.each(res, function(i, item) {  
            console.log(item.message);  
        });
    });
}
function removeItemFromChecklist(activeItemUUID){
    alert("Testing, Item to be Removed: "+activeItemUUID);
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_checklist_remove_Item.php?callback=?', { //JSONP Request
        key: window.key,
        username: window.username,
        activeUUID: activeItemUUID
    }, function(res, status) {
        alert(res.message);
        GetChecklistAttachments();
    });  
}

function addProcedureStepsToChecklist(activeItemUUID){
    alert("Testing, Item that steps should be added to: "+activeItemUUID);
}
function addProcedureTasksToChecklist(activeItemUUID){
    alert("Testing, Item that tasks should be added to: "+activeItemUUID);
}
function getChecklistsCreatedByUser(){
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_user_getChecklists.php?callback=?', { //JSONP Request
        key: window.key,
        username: window.username,
    }, function(res, status) {
    	$('#my_checklists').empty();
        $.each(res, function(i, item) {
			$('#my_checklists').append("<li><a onclick='displayChecklist(" + item.UUID + ")'><img  src='http://www.smithins.com/assets/images/employee%20appreciation%20plan2.jpg'></br></br><h2 style='white-space:normal;'>" + item.title + "</h2><p style='white-space:normal;'>" + item.description + "</p><p style='white-space:normal;'>" + item.purpose + "</p><p class='ui-li-aside'>Creation Date:</br> <strong >" + item.created_date + "</strong></p></a><a href='#purchase' data-rel='popup' data-position-to='window' data-transition='pop'></a></li>");
        	$('#my_checklists').listview().listview("refresh");
		});
    });  	
}

function displayChecklist(checklistUUID){
	window.activeChecklistUUID = checklistUUID;
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_get_OjectDetail.php?callback=?', { //JSONP Request
        key: window.key,
        username: window.username,
        activeUUID: checklistUUID
    }, function(res, status) {
    	$('#my_checklists').empty();
        $.each(res, function(i, item) {
        	$("#checklist_title").val(""+item.title+"");
        	$("#checklist_description").val(""+item.description+"");
        	$("#checklist_purpose").val(item.purpose);
		});
		getChecklistsCreatedByUser();
        GetChecklistAttachments();
    });
}

function GetAttachableObjectsforChecklist(){
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_getAll_Procedures.php?callback=?', {
        key: window.key
    }, function(res, status) {
    	var PRlist = "";
        $.each(res, function(i, item) {
            PRlist += "<li><a href='#steps' onclick='setActiveProcedureId(" + item.id + ")'><img  src='http://www.smithins.com/assets/images/employee%20appreciation%20plan2.jpg'><h2 style='white-space:normal;'>" + item.title + "</h2><p style='white-space:normal;'>" + item.purpose + "</p></a><a onclick='AddUBMProcedureToChecklist(" + item.id + ")' data-rel='popup' data-icon='plus' data-position-to='window' data-transition='pop'>Add Item</a></li>";
        });
        $('#ubm_procedures').listview("refresh");
        $('#ubm_procedures').append(""+PRlist+"");
		$("#ubm_procedures").filterable( "option", "filterReveal", true );
    });
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_getAll_Steps.php?callback=?', {
        key: window.key
    }, function(res, status) {
    	var STlist = "";
        $.each(res, function(i, item) {
        	STlist += "<li><a href='#steps' onclick='setActiveStepId(" + item.id + ")'><img  src='http://www.smithins.com/assets/images/employee%20appreciation%20plan2.jpg'><h2 style='white-space:normal;'>" + item.title + "</h2><p style='white-space:normal;'>" + item.instruction + "</p></a><a onclick='AddUBMStepToChecklist(" + item.id + ")' data-rel='popup' data-icon='plus' data-position-to='window' data-transition='pop'>Add Item</a></li>";
        });
        $('#ubm_steps').append(STlist);
	    $('#ubm_steps').listview("refresh");
		$("#ubm_steps").filterable( "option", "filterReveal", true );
    });  
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_getAll_Tasks.php?callback=?', {
        key: window.key
    }, function(res, status) {
    	var TKlist = "";
        $.each(res, function(i, item) {
	        	TKlist += "<li><a href='#tasks' onclick='setActiveTaskId(" + item.id + ")'><img  src='http://www.smithins.com/assets/images/employee%20appreciation%20plan2.jpg'><h2 style='white-space:normal;'>" + item.title + "</h2><p style='white-space:normal;'>" + item.instruction + "</p></a><a onclick='AddUBMTaskToChecklist(" + item.id + ")' data-rel='popup' data-icon='plus' data-position-to='window' data-transition='pop'>Add Item</a></li>";
		});
        $('#ubm_tasks').append(TKlist);
        $('#ubm_tasks').listview("refresh");
		$("#ubm_tasks").filterable( "option", "filterReveal", true );    
    });       
}

function AddUBMProcedureToChecklist(PRId){
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_checklist_add_Procedure.php?callback=?', {
        key: window.key,
        username: window.username,
        activeProcedureId: PRId,
        activeChecklistUUID: window.activeChecklistUUID
    }, function(res, status) {
        GetChecklistAttachments();
    });
}

function AddUBMStepToChecklist(STId){
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_checklist_add_Step.php?callback=?', {
        key: window.key,
        username: window.username,
        activeStepId: STId,
        activeChecklistUUID: window.activeChecklistUUID
    }, function(res, status) {
        GetChecklistAttachments();
    });
}

function AddUBMTaskToChecklist(TKId){
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_checklist_add_Task.php?callback=?', {
        key: window.key,
        username: window.username,
        activeTaskId: TKId,
        activeChecklistUUID: window.activeChecklistUUID
    }, function(res, status) {
        GetChecklistAttachments();
    });
}

function AddProcedureInstToChecklist(PRUUID){
    alert(PRUUID);
}

function AddStepInstToChecklist(STUUID){
    alert(STUUID);

}

function AddTaskInstToChecklist(TKUUID){
    alert(TKUUID);

}