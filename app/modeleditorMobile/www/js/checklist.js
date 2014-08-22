$(function(){
	$(".Uchecklist").sortable({
		start: function(event, ui) {
		    ui.item.startPos = ui.item.index();
		},
		stop: function(event, ui) {
		    console.log("Start position: " + ui.item.startPos);
		    console.log("New position: " + ui.item.index());
    	}		
	});	
});

function generateChecklistSubmit(){
	$.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_checklist_create_submitEvent.php?callback=?', { //JSONP Request
		key: window.key,
		username: window.username,
		activeChecklistUUID: window.activeChecklistUUID
	}, function(res, status) {
		$.each(res, function(i, item) {  
				alert(item.message);
				$("#checklist_container").attr( "data-submiteventId", item.eventId )
				$("#checklist_container").attr( "data-submiteventString", item.eventString )
				console.log(item.eventString);
				console.log(item.eventId);
		});
	}); 	
}

function getNewChecklistforCompletion(){
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
       $('#Uchecklist').empty();
        $.each(res, function(i, item) {    
            if(item.object_type=="PR"){
				PR_count += 1;
				$('#Uchecklist').append("<li data-thisItemUUID='"+item.UUID+"' data-thisOrder='"+item.UUID+"' id='PR-"+item.UUID+"'><div class='item procedure'><fieldset data-role='collapsible' style='width:50%; margin-left:auto; margin-right:auto;' data-theme='b'><legend>Procedure: " + item.title + "</legend><fieldset data-role='controlgroup' ><input type='checkbox' name='checkbox_" + item.UUID + "' id='checkbox_" + item.UUID + "' data-thisItemUUID='" + item.UUID + "' class='UBMChecklistITEM Procedure_Checkbox'><label for='checkbox_" + item.UUID + "'>Mark As Complete</label></fieldset><input type='file' data-clear-btn='true' name='file-2' id='file-2' value=''><div class='ui-field-contain'><textarea placeholder='text submission' data-mini='true' cols='40' rows='8' name='ckTextInputItem_" + item.UUID + "' id='ckTextInputItem_" + item.UUID + "'></textarea></div><fieldset data-role='collapsible' data-collapsed='false' data-theme='b'><legend>Steps To Complete</legend><ul class='Uchecklist prchild'></ul></fieldset></fieldset></div></li>");
           		$("#PR-"+item.UUID).trigger('create');
            }else if (item.object_type=="ST"){
                ST_count += 1;
                $('#Uchecklist').append("<li data-thisItemUUID='"+item.UUID+"' data-thisOrder='"+item.UUID+"' id='ST-"+item.UUID+"'><div class='item step'><fieldset data-role='collapsible' style='width:50%; margin-left:auto; margin-right:auto;'><legend>Step: " + item.title + "</legend><fieldset data-role='controlgroup' ><input type='checkbox' name='checkbox_" + item.UUID + "' id='checkbox_" + item.UUID + "' data-thisItemUUID='" + item.UUID + "' class='UBMChecklistITEM Step_Checkbox'><label for='checkbox_" + item.UUID + "'>Mark As Complete</label></fieldset><input type='file' data-clear-btn='true' name='file-2' id='file-2' value=''><div class='ui-field-contain'><textarea placeholder='text submission' data-mini='true' cols='40' rows='8' name='ckTextInputItem_" + item.UUID + "' id='ckTextInputItem_" + item.UUID + "'></textarea></div><fieldset data-role='collapsible' data-collapsed='false' data-theme='b'><legend>Tasks To Complete</legend><ul class='Uchecklist stchild'></ul></fieldset></fieldset></div></li>");
	           	$("#Uchecklist").find("li").trigger('create');
            }else if (item.object_type=="TK"){
                TK_count += 1;
                $('#Uchecklist').append("<li data-thisItemUUID='"+item.UUID+"' data-thisOrder='"+item.UUID+"' id='TK-"+item.UUID+"'><div class='item task'><fieldset data-role='collapsible' style='width:50%; margin-left:auto; margin-right:auto;'><legend>Task: " + item.title + "</legend><p class='navbar-text navbar-right'>Signed in as <a href='#' class='navbar-link'>Mark Otto</a></p><fieldset data-role='controlgroup' ><input type='checkbox' name='checkbox_" + item.UUID + "' id='checkbox_" + item.UUID + "' data-thisItemUUID='" + item.UUID + "' class='UBMChecklistITEM Task_Checkbox'><label for='checkbox_" + item.UUID + "'>Mark As Complete</label></fieldset><input type='file' data-clear-btn='true' name='file-2' id='file-2' value=''><div class='ui-field-contain'><textarea placeholder='text submission' data-mini='true' cols='40' rows='8' name='ckTextInputItem_" + item.UUID + "' id='ckTextInputItem_" + item.UUID + "'></textarea></div></fieldset></div></li>");
	           	$("#Uchecklist").find("li").trigger('create');
            }
        });
    }); 	
	$(document).on('change', 'input[name^="checkbox_"]', function() {
		var completeStatus;
		if($(this).is(":checked")) {
			completeStatus = 1;
			$(this).prop("checked", true).checkboxradio("refresh");

		}else{
			completeStatus = 0;
			$(this).prop("checked", false).checkboxradio("refresh");
		}
			//alert($(this).attr("id"));
		var activeItemUUID = $(this).attr("data-thisItemUUID");
		var textInputVal = ""; 
		if($("#ckTextInputItem_"+activeItemUUID)){
			//Test whether or not a text input for this item exists.
			textInputVal = $("#ckTextInputItem_"+activeItemUUID).val();
			if(textInputVal.length==0){
				console.log("Input Length: "+textInputVal.length+" Default of 'No Response Provided will be used.'");
				textInputVal = "No Response Provided";
			}else{ 

			}
		}else{
			alert("Not There");
		}
		submitChecklistItem(activeItemUUID,textInputVal,completeStatus);
	}); 
}

function getChecklistwithPreviousSubmit(){
	//User selects from a list of Previous Submissions and is able to resume or revise a checklist that was submitted.
}

function submitChecklistItem(activeItemUUID, textInputVal, completeStatus){
	// alert("Done! "+activeItemUUID + textInputVal);
	$.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_checklist_submit_Item.php?callback=?', { //JSONP Request
		key: window.key,
		username: window.username,
		activeChecklistUUID: window.activeChecklistUUID,
		activeSubmitEventId: $("#checklist_container").attr( "data-submiteventId" ),
		activeSubmitEventString: $("#checklist_container").attr( "data-submiteventString" ),
		activeChecklistItemUUID: activeItemUUID,
		activeChecklistItemTextInput: textInputVal,
		activeChecklistItemYN: completeStatus
	}, function(res, status) {
		$.each(res, function(i, item) {  
				console.log(item.message);
		});
	}); 	
}