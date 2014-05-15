function newCalculatedRisk() { //Calculates the Product of 
    var sum = 0;
    var risk = 0;
    var probability = 0;
    var impact = 0;
    var thisRow = $(this).closest('tr');
    //iterate through each input and add to sum
    $(thisRow).find("td:not(.total) .probability_col_num").each(function() {
        probability = parseFloat(this.value);
    });
    $(thisRow).find("td:not(.total) .impact_col_num").each(function() {
        impact = parseFloat(this.value);
    });
    risk = probability * impact / 100;
    //change value of Risk
    var risk_input = $(thisRow).find(".risk_col_num");
    risk_input.html(risk + '%');


}

function getListofInvestmentsforRiskAnalysis() { //Populates the Investment Picker at the top of the risk_analysis page.
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_getCurrentModel_Investments.php?callback=?', { //JSONP Request
        key: window.key,
        activeModelUUID: window.activeModelUUID
    }, function(res, status) {
        $('#risk_analysis_investment_select_menu').empty();
        $('#risk_analysis_investment_select_menu').append("<option>Choose an Investment</option>");
        $.each(res, function(i, item) {
            $('#risk_analysis_investment_select_menu').append("<option value='" + item.id + "'>Investment " + item.id + " : " + item.title + "</option>");
            $('#risk_analysis_investment_select_menu').selectmenu('refresh', true);
        });
    });
    //$('#risk_analysis_investment_select_menu_container').trigger("refresh");
}

function addRisktoMyInvestment(activeRiskId) {
    showLoader();
    $().toastmessage('showNoticeToast', window.activeModelInvestmentId);
    $().toastmessage('showNoticeToast', "Risk # " + activeRiskId + " will be added to the active investment.");
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_investment_add_Risk.php?callback=?', { //JSONP Request
        key: window.key,
        activeInvestmentId: window.activeModelInvestmentId,
        activeRiskId: activeRiskId,
        username: window.username
    }, function(res, status) {
        $().toastmessage('showNoticeToast', res.message);
        hideLoader();
        if (status == "success") {
            getListofRisksforRiskAnalysisTable();
        }
    });
}

function getListofRisksforSearchBars() {
    $("#risk_analysis_load_search_progressbar").show();

    setTimeout(function() {
        $("#risk_analysis_load_search_progressbar").progressbar({
            value: 5
        });
    }, 50);
    showLoader();
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_getAll_Risks.php?callback=?', { //JSONP Request
        key: window.key,
    }, function(res, status) {
        setTimeout(function() {
            $("#risk_analysis_load_search_progressbar").progressbar({
                value: 10
            });
            setTimeout(function() {
                $("#risk_analysis_load_search_progressbar").progressbar({
                    value: 20
                });
                setTimeout(function() {
                    $("#risk_analysis_load_search_progressbar").progressbar({
                        value: 30
                    });
                    setTimeout(function() {
                        $("#risk_analysis_load_search_progressbar").progressbar({
                            value: 40
                        });
                        setTimeout(function() {
                            $("#risk_analysis_load_search_progressbar").progressbar({
                                value: 50
                            });
                        }, 10);
                    }, 10);
                }, 10);
            }, 10);
        }, 10);
        $(".risk_analysis_search").empty();
        $.each(res, function(i, item) {
            $("#risk_analysis_load_search_progressbar").progressbar({
                value: 90 * item.id / res.length
            });
            $(".risk_analysis_search").append("<li><a href='#'><h2>Risk Category: " + item.category + "</h2><p>Risk: " + item.description + "</p></a><a href='#purchase'  onclick='addRisktoMyInvestment(" + item.id + ")'>Add Risk</a></li>");
        });
        $("#risk_analysis_search_containter1").append("<li><a href='#'>Cant find the risk you are looking for? Click Here to define a new one.</a></li>");
        $("#risk_analysis_search_containter2").append("<li><a href='#'>Cant find the risk you are looking for? Click Here to define a new one.</a></li>");

        $(".risk_analysis_search").listview("refresh");
        //					$( ".risk_analysis_search" ).filterable({ filterReveal: true, input: "#input-for-filterable" });

        $(".risk_analysis_search").listview("refresh");
        setTimeout(function() {
            $("#risk_analysis_load_search_progressbar").progressbar({
                value: 100
            });
            hideLoader();
            $("#risk_analysis_load_search_progressbar").hide();
        }, 1000);
    });
}

function getListofRisksforRiskAnalysisTable() {
    showLoader();
    var i = 0;
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_investment_get_Risks.php?callback=?', { //JSONP Request
        key: window.key,
        activeModelUUID: window.activeModelUUID,
        username: window.username
    }, function(res, status) {
        $('#risk_analysis_table_body').empty()
        $.each(res, function(i, item) {
            if (item.investment_id == window.activeModelInvestmentId) {
                i = i + 1;
                $('#risk_analysis_table_body').append("<tr><td><a href='#' onclick='removeRiskFromInvestment(" + item.id + ")'><span class='trashico'></span></a></td><td class='tg-031e'>" + i + "</td><td class='tg-031e'>" + item.investment_id + "</td><td class='tg-031e'>" + item.description + "</td><td class='tg-031e'><input class='probability_col_num col_num' value = '" + item.probability + "'/></td><td class='tg-031e'><input class='impact_col_num col_num' value = '" + item.impact + "'/></td><td class='tg-031e risk_col_num'></td><td class='tg-031e'  ><fieldset class='retain_full_risk_radio' data-role='controlgroup' data-type='vertical' data-mini='true'><input type='radio' class='retain_full_risk_radio' name='radio-choice-b" + i + "' id='radio-choice-c" + i + "' value='Yes' checked='checked'><label class='retain_full_risk_radio' for='radio-choice-c" + i + "'>Yes</label><input class='retain_full_risk_radio' type='radio' name='radio-choice-b" + i + "' id='radio-choice-d" + i + "' value=' No '><label class='retain_full_risk_radio' for='radio-choice-d" + i + "'>No</label></fieldset></td><td class='tg-031e' style='max-width:150px;'><select name='select-choice-8' id='select-choice-8" + i + "' multiple='multiple' data-native-menu='false' data-icon='grid' data-iconpos='left'><option>Select the measures your will take:</option><option value='Policies and Procedures' selected=''>Policies and Procedures</option><optgroup label='Insurance'><option value='Property and Causality'>Property and Causality</option><option value='Auto'>Auto</option><option value='General Liability'>General Liability</option></optgroup><optgroup label='Others'><option value='Other'>Other</option><option value='Out Source'>Out Source</option></optgroup></select></td><td class='tg-031e'><input class='low_col_num' value = '" + item.amount + "'/></td><td class='tg-031e'><input class='low_col_num' value = '" + item.reference + "'/></td><td class='tg-031e'><textarea cols='20' rows='3' name='textarea' id='textarea'>" + item.preventative_measures_explanation + "</textarea></td><td><a id='saveRiskAnalysisButton_" + item.id + "' href='#' class='ui-btn save_risk_analysis_button risk_analysis_table' >Save Analysis</a></td></tr>");
                $('#risk_analysis_table_body').trigger("create");
                $('.retain_full_risk_radio').trigger("create");
            } else {
                //$('#').append("...");
            }
        });

    });
    setTimeout(function() {
        $(".col_num").each(function() { //The Class of the Input element that triggers the calculation			
            $(this).change(function() { //Call the newSum function each time a keystroke is activated in any of the inputs with col_num as the class.
                newCalculatedRisk.call(this);
            });
        });
        $(".save_risk_analysis_button").each(function() { //The Class of the Input element that triggers the calculation			
            $(this).bind('click', function() {
                alert("this is a test");

                saveRiskAnalysis.call(this);

            });

        });
        hideLoader();
    }, 2500);
}

function saveRiskAnalysis() {
    $().toastmessage('showNoticeToast', parseInt($(this).attr('id')));
    // var reg_username = reg_email.split("@", 1).toString();
    /*** /

			    var impact = 0;
			    var thisRow = $(this).closest('tr');
			    //iterate through each input and add to sum
			    $(thisRow).find("td:not(.total) .probability_col_num").each(function() {
			            probability = parseFloat(this.value);  
			    }); 
			    $(thisRow).find("td:not(.total) .impact_col_num").each(function() {
			            impact = parseFloat(this.value);                     
			    }); 
			    risk = probability*impact/100;
			    //change value of Risk
			    var risk_input = $(thisRow).find(".risk_col_num");
			    risk_input.html(risk + '%');			
			    /***/
    $().toastmessage('showNoticeToast', "Risk Analysis will now be saved.");
}

function removeRiskFromInvestment(activeRiskId) {
    alert("this is a test " + activeRiskId)
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_investment_remove_Risk.php?callback=?', { //JSONP Request
        key: window.key,
        activeModelInvestmentId: window.activeModelInvestmentId,
        activeRiskId: activeRiskId
    }, function(res, status) {
        $().toastmessage('showNoticeToast', res.message);
    });
    getListofRisksforRiskAnalysisTable();
}

function createNewRiskaddToActiveInvestment() {
    event.preventDefault();
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_investment_create_Risk.php?callback=?', { //JSONP Request
        key: window.key,
        riskDescription: document.getElementById('risk_analysis_define_new_risk_popup_form_description').value,
        riskCategory: document.getElementById('risk_analysis_define_new_risk_popup_form_category').value,
        username: window.username,
        activeModelInvestmentId: window.activeModelInvestmentId
    }, function(res, status) {
        $().toastmessage('showNoticeToast', res.message);
        if (status == "success") {
            setTimeout(function() {
                $('#risk_analysis_define_new_risk_popup').popup('close');
                getListofRisksforRiskAnalysisTable();
            }, 1000);
            $('#risk_analysis_define_new_risk_popup_form').each(function() {
                this.reset();
            });
        }
    });
}