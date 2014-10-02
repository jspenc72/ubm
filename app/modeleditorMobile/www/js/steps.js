function setActiveStepUUID(activeStepUUID) { //Single Click Function
    //1. Set window variable: window.activePolicyUUID equal to activePolicyUUID.
    window.activeStepUUID = activeStepUUID;
    window.activeObjectUUID = activeStepUUID;
}

function getMyModelsSteps(activeObjectUUID) {
    if (!activeObjectUUID) {
        activeObjectUUID = window.activePositionUUID;
        $('#steps_list').empty();
        window.PS_counter = 1;
    } else {}
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_get_Direct_ElementPosterityTree.php?callback=?', {
        key: window.key,
        activeObjectUUID: activeObjectUUID
    }, function(res, status) {
        $.each(res, function(i, item) {
            if (item.step_id !== "0") {
                $('#steps_list').append("<li><a href='#tasks' onclick='setActiveJobDescriptionUUID(" + item.UUID + ")'><img  src='http://www.smithins.com/assets/images/employee%20appreciation%20plan2.jpg'><h2>" + item.title + "</h2><p>Step Instruction: " + item.instruction + "</p></a><a href='#purchase' data-rel='popup' data-position-to='window' data-transition='pop'>Purchase album</a></li>");
                $('#steps_list').listview().listview("refresh");
            }
        });
    });
}

function createNewStep(){
//1. Validate Input
    var counter=1;
    //1. Declare counter variable to keep track of the number of inputs in a given form.
    var errors = [];
    //2. Declare errors[] array to keep track of inputs that dont pass validation.      
    var objectArray = {};   
    // Declare objectArray[] array to store all objects that are going to be submitted.     
    $('#newStep_popup_form :input').each(function() {
        var value = $(this).val();
        var columnName = $(this).attr('db-columnname');
        objectArray[columnName] = value;
        //tasksArray[key] = value;
        //alert($(this).val());
        if($(this).val().length>=1){
            //3. Check to see if value has been entered into the input.
            if($(this).prop('type')=='number'){
                    console.log("Input: " + $(this).attr('placeholder') + " should contain a numerical value.");
            }
            //4. alert("Input: " + $(this).attr('placeholder') + " has value: " + this.value);
        }else{
            alert("Input: " + $(this).attr('placeholder') + " is required but has no value.");
            //5. Alert the user if the length of the inputs value is less than 1.
            errors.push($(this).attr('id'));
            //6. Add the input id to the errors array.
        }
        counter = counter+1;
            //7. iterate the counter.
    });
    if(errors.length==0){
        if(window.activeChecklistUUID){
//2. Validate that an active checklist has been selected.
            $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_checklist_create_Step.php?callback=?', {
                key: window.key,
                username: window.username,
                activeChecklistUUID: window.activeChecklistUUID,
                stepTitle: $("#step_title").val(),
                stepInstruction: $("#step_instruction").val(),
                stepAlertType: $("#step_alert_type").val(),
                stepAlertText: $("#step_alert_text").val(),
                allottedTimeHrs: $("#step_allotted_time_hrs").val(),
                allottedTimeMin: $("#step_allotted_time_min").val()
            }, function(res, status) {
                alert(res.message);
                $('#newStep_popup_form').each(function() {
                    this.reset();        
                });
                $("#newStep").popup("close");
                GetChecklistAttachments();
            });         
        }else{
            alert("You must select a checklist before creating a new procedure step or task.");
        }
    }else{
        console.log("The form was not submitted due to the errors found in your input.");
    }
}