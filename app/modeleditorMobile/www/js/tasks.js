function setActiveTaskUUID(activeTaskUUID) { //Single Click Function
    //1. Set window variable: window.activeStepUUID equal to activeStepUUID.
    window.activeTaskUUID = activeTaskUUID;
    window.activeObjectUUID = activeTaskUUID;

}

function getMyModelsTasks(activeObjectUUID) {
    if (!activeObjectUUID) {
        activeObjectUUID = window.activePositionUUID;
        $('#tasks_list').empty();
        window.PS_counter = 1;
    } else {}
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_get_Direct_ElementPosterityTree.php?callback=?', {
        key: window.key,
        activeObjectUUID: activeObjectUUID
    }, function(res, status) {
        $.each(res, function(i, item) {
            if (item.task_id !== "0") {
                $('#tasks_list').append("<li><a href='#' onclick='setActiveJobDescriptionUUID(" + item.UUID + ")'><img  src='http://www.smithins.com/assets/images/employee%20appreciation%20plan2.jpg'><h2>" + item.title + "</h2><p>Task Instruction: " + item.instruction + "</p></a><a href='#purchase' data-rel='popup' data-position-to='window' data-transition='pop'>Purchase album</a></li>");
                $('#tasks_list').listview().listview("refresh");
            }
        });
    });
}

function createNewTask(){
//1. Validate Input
    var counter=1;
    //1. Declare counter variable to keep track of the number of inputs in a given form.
    var errors = [];
    //2. Declare errors[] array to keep track of inputs that dont pass validation.      
    var objectArray = {};   
    // Declare objectArray[] array to store all objects that are going to be submitted.     
    $('#newTask_popup_form :input').each(function() {
        var value = $(this).val();
        var columnName = $(this).attr('db-columnname');
        objectArray[columnName] = value;
        //tasksArray[key] = value;
        //alert($(this).val());
        if($(this).val().length>=1){
            //3. Check to see if value has been entered into the input.
            if($(this).prop('type')=='number'){
                if($(this).val()){
                   // alert("Input: " + $(this).attr('placeholder') + " should contain a numerical value.");
                }else{
                    alert("Input: " + $(this).attr('placeholder') + " should contain a numerical value.");
                }
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
            $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_checklist_create_Task.php?callback=?', {
                key: window.key,
                username: window.username,
                activeChecklistUUID: window.activeChecklistUUID,
                taskTitle: $("#task_title").val(),
                taskInstruction: $("#task_instruction").val(),
                taskAlertType: $("#task_alert_type").val(),
                taskAlertText: $("#task_alert_text").val(),
                allottedTimeHrs: $("#task_allotted_time_hrs").val(),
                allottedTimeMin: $("#task_allotted_time_min").val()
            }, function(res, status) {
                alert(res.message);
                $('#newTask_popup_form').each(function() {
                    this.reset();        
                });
                $("#newTask").popup("close");

            });         
        }else{
            alert("You must select a checklist before creating a new procedure step or task.");
        }
    }else{
        console.log("The form was not submitted due to the errors found in your input.");
    }

}