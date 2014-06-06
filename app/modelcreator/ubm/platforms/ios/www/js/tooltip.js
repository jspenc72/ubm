function showHierarchicalObjectTooltip() {
    alert("this is a test");
    //			window.activeUUID = 112;
    //Check to see that document is ready for manipulation
    //		tooltipContentCreator(111);
    //Call ajax function in tooltip.js
    $('.ajax_tooltip').tooltipster({
        content: 'Loading...',
        contentAsHTML: true,
        maxWidth: 1000,
        interactive: true,
        functionBefore: function(origin, continueTooltip) {
            //1. We'll make this function asynchronous and allow the tooltip to go ahead and show the loading notification while fetching our data
            continueTooltip();
            if (origin.data('ajax') !== 'cached') {
                //2. next, to avoid unnecessary AJAX calls, we check if our data has already been cached.
                $.ajax({
                    //3. Send AJAX call to UBMS API
                    type: 'GET',
                    dataType: "jsonp",
                    crossDomain: true,
                    //4. Set appropriate parameters for the request.
                    url: 'http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_get_OjectDetail.php?callback=?',
                    data: {
                        key: "YDoS20lf7Vrnr22h8Ma6NGUV5DblnVhueTPXS7gPynRvQ6U8optzfnMDs3UD",
                        activeUUID: window.activeUUID
                    },
                    //5. Pass the api key and the activeUUID to the api to authenticate the request.
                    success: function(res) {
                        //6. Function to call on success for the request, and pass the information from the api into the function as the object, res.
                        $.each(res, function(i, item) {
                            //7. The api documentation shows that the information returned is an array of jsonp arrays so we iterate through the parent array with $.each function
                            var updated_content = 0;
                            //8. We define a variable to hold the appropriate content for the tooltip.
                            if (item.object_type == "MD") {
                                //9. Check that the object_type is equal to Model.
                                updated_content = "<span><img src='puppy.jpg' style='width:100px; height:auto;' /> <table class='docutils field-list' frame='void' rules='none'><col class='tooltipster field-name' /><col class='field-body' /><tbody valign='top'><tr class='field-odd field'><th class='tooltipster field-name'>" + item.reference_prefix + "</th><td class='field-body'>" + item.reference + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Model " + item.title_prefix + "</th><td class='field-body'>" + item.title + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>" + item.description_prefix + "</th><td class='field-body'>" + item.description + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>" + item.scope_prefix + "</th><td class='field-body'>" + item.scope + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>" + item.purpose_prefix + "</th><td class='field-body'>" + item.purpose + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>" + item.creator_id_prefix + "</th><td class='field-body'>" + item.creator_id + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>" + item.created_date_prefix + "</th><td class='field-body'>" + item.created_date + "</td></tr></tbody></table></span>"
                                //10. Set the updated_content variable equal to a string of HTML format with the parameters from the api concatenated into the string.
                                //origin.tooltipster('content', updated_content).data('ajax', 'cached');
                                origin.tooltipster('content', updated_content);
                                //11. Update the content of the tooltip.										
                            } else if (item.object_type == "PS") {
                                //12. Check that the object_type is equal to Position.
                                updated_content = "<span><img src='puppy.jpg' style='width:100px; height:auto;' /> <table class='docutils field-list' frame='void' rules='none'><col class='tooltipster field-name' /><col class='field-body' /><tbody valign='top'><tr class='field-odd field'><th class='tooltipster field-name'>Position Title: </th><td class='field-body'>" + item.title + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Position Description: </th><td class='field-body'>" + item.description + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Position Summary: </th><td class='field-body'>" + item.summary + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Security Level: </th><td class='field-body'>" + item.security_level + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Age Requirement: </th><td class='field-body'>" + item.age_requirements + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Education Requirement: </th><td class='field-body'>" + item.education_requirements + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Physical Demands: </th><td class='field-body'>" + item.physical_demands + "</td></tr></tbody></table></span>"
                                //13. Set the updated_content variable equal to a string of HTML format with the parameters from the api concatenated into the string.
                                //origin.tooltipster('content', updated_content).data('ajax', 'cached');
                                origin.tooltipster('content', updated_content);
                                //14. Update the content of the tooltip.
                            } else if (item.object_type == "JD") {
                                //15. Check that the object_type is equal to Job Description.
                                updated_content = "<span><img src='puppy.jpg' style='width:100px; height:auto;' /> <table class='docutils field-list' frame='void' rules='none'><col class='tooltipster field-name' /><col class='field-body' /><tbody valign='top'><tr class='field-odd field'><th class='tooltipster field-name'>Job Description Title: </th><td class='field-body'>" + item.title + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Objective: </th><td class='field-body'>" + item.objective + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Essential Duties and Responsibilities: </th><td class='field-body'>" + item.essential_duties_and_responsibilities + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Age Requirement: </th><td class='field-body'>" + item.age_requirement + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Education Requirements: </th><td class='field-body'>" + item.education_requirements + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Qualifications: </th><td class='field-body'>" + item.qualifications + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Physical Demand: </th><td class='field-body'>" + item.physical_demand + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Work Environment: </th><td class='field-body'>" + item.work_environment + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Creator Id: </th><td class='field-body'>" + item.created_by + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Creation Date: </th><td class='field-body'>" + item.created_date + "</td></tr></tbody></table></span>"
                                //16. Set the updated_content variable equal to a string of HTML format with the parameters from the api concatenated into the string.
                                //origin.tooltipster('content', updated_content).data('ajax', 'cached');
                                origin.tooltipster('content', updated_content);
                                //17. Update the content of the tooltip.	
                            } else if (item.object_type == "PL") {
                                //18. Check that the object_type is equal to Policy.
                                updated_content = "<span><img src='puppy.jpg' style='width:100px; height:auto;'/><table class='docutils field-list' frame='void' rules='none'><col class='tooltipster field-name' /><col class='field-body' /><tbody valign='top'><tr class='field-odd field'><th class='tooltipster field-name'>Policy Title: </th><td class='field-body'>" + item.title + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Description: </th><td class='field-body'>" + item.description + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Purpose: </th><td class='field-body'>" + item.purpose + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Scope: </th><td class='field-body'>" + item.scope + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Creator Id: </th><td class='field-body'>" + item.created_by + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Creation Date: </th><td class='field-body'>" + item.created_date + "</td></tr></tbody></table></span>"
                                //19. Set the updated_content variable equal to a string of HTML format with the parameters from the api concatenated into the string.
                                //origin.tooltipster('content', updated_content).data('ajax', 'cached');
                                origin.tooltipster('content', updated_content);
                                //20. Update the content of the tooltip.
                            } else if (item.object_type == "PR") {
                                //21. Check that the object_type is equal to Procedure.
                                updated_content = "<span><img src='puppy.jpg' style='width:100px; height:auto;' /> <table class='docutils field-list' frame='void' rules='none'><col class='tooltipster field-name' /><col class='field-body' /><tbody valign='top'><tr class='field-odd field'><th class='tooltipster field-name'>Procedure Title: </th><td class='field-body'>" + item.title + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Description: </th><td class='field-body'>" + item.description + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Purpose: </th><td class='field-body'>" + item.purpose + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Scope: </th><td class='field-body'>" + item.scope + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Creator Id: </th><td class='field-body'>" + item.created_by + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Creation Date: </th><td class='field-body'>" + item.created_date + "</td></tr></tbody></table></span>"
                                //22. Set the updated_content variable equal to a string of HTML format with the parameters from the api concatenated into the string.
                                //origin.tooltipster('content', updated_content).data('ajax', 'cached');
                                origin.tooltipster('content', updated_content);
                                //23. Update the content of the tooltip.
                            } else if (item.object_type == "ST") {
                                //24. Check that the object_type is equal to Step.
                                updated_content = "<span><img src='puppy.jpg' style='width:100px; height:auto;' /> <table class='docutils field-list' frame='void' rules='none'><col class='tooltipster field-name' /><col class='field-body' /><tbody valign='top'><tr class='field-odd field'><th class='tooltipster field-name'>Step Title: </th><td class='field-body'>" + item.title + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Description: </th><td class='field-body'>" + item.description + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Purpose: </th><td class='field-body'>" + item.purpose + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Instruction: </th><td class='field-body'>" + item.instruction + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Creator Id: </th><td class='field-body'>" + item.created_by + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Creation Date: </th><td class='field-body'>" + item.creation_date + "</td></tr></tbody></table></span>"
                                //25. Set the updated_content variable equal to a string of HTML format with the parameters from the api concatenated into the string.
                                //origin.tooltipster('content', updated_content).data('ajax', 'cached');
                                origin.tooltipster('content', updated_content);
                                //26. Update the content of the tooltip.	
                            } else if (item.object_type == "TK") {
                                //27. Check that the object_type is equal to Task.
                                updated_content = "<span><img src='puppy.jpg' style='width:100px; height:auto;'/><table class='docutils field-list' frame='void' rules='none'><col class='tooltipster field-name' /><col class='field-body' /><tbody valign='top'><tr class='field-odd field'><th class='tooltipster field-name'>Task Title: </th><td class='field-body'>" + item.title + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Task Number: </th><td class='field-body'>" + item.task_number + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Instruction: </th><td class='field-body'>" + item.instruction + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Creator Id: </th><td class='field-body'>" + item.created_by + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Creation Date: </th><td class='field-body'>" + item.creation_date + "</td></tr></tbody></table></span>"
                                //28. Set the updated_content variable equal to a string of HTML format with the parameters from the api concatenated into the string.
                                //origin.tooltipster('content', updated_content).data('ajax', 'cached');
                                origin.tooltipster('content', updated_content);
                                //29. Update the content of the tooltip with our returned data and cache it	
                            }
                        });
                    }
                });
            }
        }
    });
}
/*
			$('.my-tooltipster').tooltipster({
				position: "top",
				contentAsHTML: true,
				delay: 200,
				content: $('.hidden_tooltip').html()
			});
		    var spinner = $( "#spinner" ).spinner();
		    $( "#spinner" ).keyup(function() {
		      window.activeUUID = spinner.spinner( "value" );
		    });


*/

//This function appends the contents of a json response into a hidden div whos contents are then used to populate the tooltipster tooltip.
function tooltipContentCreator(activeUUID) {
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_get_OjectDetail.php?callback=?', { //JSONP Request
        key: "YDoS20lf7Vrnr22h8Ma6NGUV5DblnVhueTPXS7gPynRvQ6U8optzfnMDs3UD",
        activeUUID: activeUUID
    }, function(res, status) {
        $(".hidden_tooltip").empty();
        $.each(res, function(i, item) {
            if (item.object_type == "MD") {
                $(".hidden_tooltip").append("<span><strong>UUID: </strong>" + activeUUID + "<br><strong>Title: </strong>" + item.title + "<br><strong>Description: </strong>" + item.description + "</span>");
            } else if (item.object_type == "PS") {
                $(".hidden_tooltip").append("<span><img src='puppy.jpg' style='width:100px; height:auto;' /> <table class='docutils field-list' frame='void' rules='none'><col class='tooltipster field-name' /><col class='field-body' /><tbody valign='top'><tr class='field-odd field'><th class='tooltipster field-name'>UUID:</th><td class='field-body'>" + activeUUID + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Title:</th><td class='field-body'>" + item.title + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Description:</th><td class='field-body'>" + item.description + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Age Requirements:</th><td class='field-body'>" + item.age_requirements + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Education Requirements:</th><td class='field-body'>" + item.education_requirements + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Qualifications:</th><td class='field-body'>" + item.qualifications + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Physical Demands:</th><td class='field-body'>" + item.physical_demands + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Work Environment:</th><td class='field-body'>" + item.work_environment + "</td></tr></tbody></table></span>");
            } else if (item.object_type == "JD") {
                $(".hidden_tooltip").append("<span><img src='puppy.jpg' style='width:100px; height:auto;' /> <table class='docutils field-list' frame='void' rules='none'><col class='tooltipster field-name' /><col class='field-body' /><tbody valign='top'><tr class='field-odd field'><th class='tooltipster field-name'>UUID:</th><td class='field-body'>" + activeUUID + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Title:</th><td class='field-body'>" + item.title + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Objective:</th><td class='field-body'>" + item.objective + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Essential Duties and Responsibilities:</th><td class='field-body'>" + item.essential_duties_and_responsibilities + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Age Requirements:</th><td class='field-body'>" + item.age_requirements + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Education Requirements:</th><td class='field-body'>" + item.education_requirements + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Qualifications:</th><td class='field-body'>" + item.qualifications + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Physical Demands:</th><td class='field-body'>" + item.physical_demands + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Work Environment:</th><td class='field-body'>" + item.work_environment + "</td></tr></tbody></table></span>");
            } else if (item.object_type == "PL") {
                $(".hidden_tooltip").append("<span><img src='puppy.jpg' style='width:100px; height:auto;' /> <table class='docutils field-list' frame='void' rules='none'><col class='tooltipster field-name' /><col class='field-body' /><tbody valign='top'><tr class='field-odd field'><th class='tooltipster field-name'>UUID:</th><td class='field-body'>" + activeUUID + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Title:</th><td class='field-body'>" + item.title + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Description:</th><td class='field-body'>" + item.description + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Purpose:</th><td class='field-body'>" + item.purpose + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Scope:</th><td class='field-body'>" + item.scope + "</td></tr></tbody></table></span>");
            } else if (item.object_type == "PR") {
                $(".hidden_tooltip").append("<span><img src='puppy.jpg' style='width:100px; height:auto;' /> <table class='docutils field-list' frame='void' rules='none'><col class='tooltipster field-name' /><col class='field-body' /><tbody valign='top'><tr class='field-odd field'><th class='tooltipster field-name'>UUID:</th><td class='field-body'>" + activeUUID + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Title:</th><td class='field-body'>" + item.title + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Description:</th><td class='field-body'>" + item.description + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Purpose:</th><td class='field-body'>" + item.purpose + "</td></tr></tbody></table></span>");
            } else if (item.object_type == "ST") {
                $(".hidden_tooltip").append("<span><img src='puppy.jpg' style='width:100px; height:auto;' /> <table class='docutils field-list' frame='void' rules='none'><col class='tooltipster field-name' /><col class='field-body' /><tbody valign='top'><tr class='field-odd field'><th class='tooltipster field-name'>UUID:</th><td class='field-body'>" + activeUUID + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Title:</th><td class='field-body'>" + item.title + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Description:</th><td class='field-body'>" + item.description + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Instruction:</th><td class='field-body'>" + item.instruction + "</td></tr></tbody></table></span>");
            } else if (item.object_type == "TK") {
                $(".hidden_tooltip").append("<span><img src='puppy.jpg' style='width:100px; height:auto;' /> <table class='docutils field-list' frame='void' rules='none'><col class='tooltipster field-name' /><col class='field-body' /><tbody valign='top'><tr class='field-odd field'><th class='tooltipster field-name'>UUID:</th><td class='field-body'>" + activeUUID + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Title:</th><td class='field-body'>" + item.title + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Task Number:</th><td class='field-body'>" + item.task_number + "</td></tr><tr class='field-even field'><th class='tooltipster field-name'>Instruction:</th><td class='field-body'>" + item.instruction + "</td></tr></tbody></table></span>");
            }
        });
    });
}