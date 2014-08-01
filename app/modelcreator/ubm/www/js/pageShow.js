$(document).on("pageshow", "#creator_table_of_contents", function() {
    walkthrough('creator_table_of_contents', function(status) {
        if (status == 0) {
            introJs('#creator_table_of_contents').start().oncomplete(function() {
                setWalkthroughAsComplete('creator_table_of_contents');
            });
        }
    });
});
$(document).on("pageshow", "#ubmsuite_modelDashboard", function() {
    $('#ubmsuite_modelSettings_editModel_popup_form').each(function() {
        this.reset();
    });
    getModelCreationSuiteChecklistItems();

    walkthrough('ubmsuite_modelDashboard', function(status) {
        if (status == 0) {
            introJs('#ubmsuite_modelDashboard').start().oncomplete(function() {
                setWalkthroughAsComplete('ubmsuite_modelDashboard');
            });
        }
    });
});
$(document).on("pageshow", "#ubmsuite_SelectBusinessModel", function() {
    walkthrough('ubmsuite_SelectBusinessModel', function(status) {
        if (status == 0) {
            introJs('#ubmsuite_SelectBusinessModel').start().oncomplete(function() {
                setWalkthroughAsComplete('ubmsuite_SelectBusinessModel');
            });
        }
    });
    setTimeout(function() {
        getMyModels();
        while (window.globalCounter == 0) {
            greetUser();
            window.globalCounter++;
        }
    }, 1000);
    $('.modelApp_title_header').empty();
    $(".modelApp_title_header").append("Model / App Title: Automated Model Creation Suite");
});
$(document).on("pageshow", "#return_on_investment", function() {
    getListofAlternativesforReturnOnInvestment();
    $("#return_on_investment_alternative_select_menu").bind("change", function(event, ui) {
        window.activeModelAlternativeId = $("#return_on_investment_alternative_select_menu option:selected").val();
        $("#anchor_for_return_on_investment_createNewInvestment_popup").show();
        setTimeout(function() {
            getAlternativesInvestments();
        }, 500);
    });
    $("#return_on_investment_alternative_select_investment_menu").bind("change", function(event, ui) {
        window.activeModelInvestmentId = $("#return_on_investment_alternative_select_investment_menu option:selected").val();
        $("#anchor_for_return_on_investment_createNewCostDriver_popup").show();
        $("#anchor_for_return_on_investment_createNewIncomeDriver_popup").show();
        setTimeout(function() {
            getActiveInvestmentIncomeDrivers();
            getActiveInvestmentCostDrivers();
        }, 500);
    });
    walkthrough('return_on_investment', function(status) {
        if (status == 0) {
            introJs('#return_on_investment').start().oncomplete(function() {
                setWalkthroughAsComplete('return_on_investment');
            });
        }
    });
});
$(document).on("pageshow", "#ubmsuite_mcs_model_review", function() {
    getModelSetupSummary(2);
    walkthrough('ubmsuite_mcs_model_review', function(status) {
        if (status == 0) {
            introJs('#ubmsuite_mcs_model_review').start().oncomplete(function() {
                setWalkthroughAsComplete('ubmsuite_mcs_model_review');
            });
        }
    });
});
$(document).on("pageshow", "#ubmsuite_mcs_master_file_index", function() {
    getMasterFileIndexItems();
    setTimeout(function() {

    }, 500);
});
$(document).on("pageshow", "#mcs_setup_checklist_setup", function() {
    walkthrough('mcs_setup_checklist_setup', function(status) {
        if (status == 0) {
            introJs('#mcs_setup_checklist_setup').start().oncomplete(function() {
                setWalkthroughAsComplete('mcs_setup_checklist_setup');
            });
        }
    });
});


$(document).on("pageshow", "#sign_in_sign_up", function() {
    window.username = null;
    $("#si_submit").removeClass("ui-btn ui-shadow ui-corner-all")
});

$(document).on("pageshow", "#open_points_action_items", function() {
    new Tablesort(document.getElementById('mcs_open_points_action_items_table'), {
        descending: true
    });
    open_points_action_items();
    walkthrough('open_points_action_items', function(status) {
        if (status == 0) {
            introJs('#open_points_action_items').start().oncomplete(function() {
                setWalkthroughAsComplete('open_points_action_items');
            });
        }
    });
});
$(document).on("pageshow", "#mcs_setup_checklist_p4_b1", function() {
    fillTodaysDate();
});
$(document).on("pageshow", "#ubmsuite_mcs_management_reporting", function() {
    getMyModelsPositions();
});
$(document).on("pageshow", "#ubmsuite_swotAnalysis", function() {
    $('area').on('click', function()open_points_action_items {
        if ($(this).attr('title') == 'strength') {
            $("#ubmsuite_swotAnalysis_add_strength_popup").popup("open");
        }
        if ($(this).attr('title') == 'weakness') {
            $("#ubmsuite_swotAnalysis_add_weakness_popup").popup("open");
        }
        if ($(this).attr('title') == 'opportunity') {
            $("#ubmsuite_swotAnalysis_add_opportunity_popup").popup("open");
        }
        if ($(this).attr('title') == 'threat') {
            $("#ubmsuite_swotAnalysis_add_threat_popup").popup("open");
        }
    });
});
$(document).on("pageshow", "#risk_analysis", function() {
    $("#risk_analysis_define_new_risk_popup_defineRisk_button").hide();
    //var value =$( "#risk_analysis_investment_select_menu option:selected" ).text();							
    $("#risk_analysis_investment_select_menu").bind("change", function(event, ui) {
        window.activeModelInvestmentId = $("#risk_analysis_investment_select_menu option:selected").val();
        setTimeout(function() {
            getListofRisksforRiskAnalysisTable();
            getListofRisksforSearchBars();
            $("#risk_analysis_define_new_risk_popup_defineRisk_button").show();
            $("#risk_analysis_load_search_progressbar").show();
        }, 500);
    });

    setTimeout(function() {
        getListofInvestmentsforRiskAnalysis();
    }, 10);
    walkthrough('risk_analysis', function(status) {
        if (status == 0) {
            introJs('#risk_analysis').start().oncomplete(function() {
                setWalkthroughAsComplete('risk_analysis');
            });
        }
    });
});

$(document).on("pageshow", "#ubmsuite_mcs_my_organizational_chart", function() {
    //initializeTooltipsterItem();
    /*** /$( "#heirarchyObjectTree_container_frame" ).draggable().resizable({
				      maxHeight: 550,
				      maxWidth: $( window ).width()*2,
				      minHeight: 250,
				      minWidth: 200
				    });/***/
    $("#ubmsuite_mcs_my_organizational_chart_content_managePolicyPopUp").draggable();
    $("#ubmsuite_mcs_my_organizational_chart_content_manageProcedurePopUp").draggable();
    $("#ubmsuite_mcs_my_organizational_chart_content_manageJobDescriptionPopUp").draggable();
    $("#ubmsuite_mcs_my_organizational_chart_content_manageStepPopUp").draggable();
    $("#ubmsuite_mcs_my_organizational_chart_content_manageTask").draggable();
    $('#chart').empty();
    getMyModelsOrgChart();
    getObjectsforBackboneTable();
    setTimeout(function() {
        walkthrough('ubmsuite_mcs_my_organizational_chart', function(status) {
            if (status == 0) {
                introJs('#ubmsuite_mcs_my_organizational_chart').start().oncomplete(function() {
                    setWalkthroughAsComplete('ubmsuite_mcs_my_organizational_chart');
                });
            }
        });
    }, 500);
});
$(document).on("pageshow", "#possible_alternatives", function() {
    getMyModelsListofAlternatives();
    walkthrough('possible_alternatives', function(status) {
        if (status == 0) {
            introJs('#possible_alternatives').start().oncomplete(function() {
                setWalkthroughAsComplete('possible_alternatives');
            });
        }
    });
});
$(document).on("pageshow", "#ubmsuite_mcs_position_strategic_command_center", function() {

    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();

    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        editable: true,
        events: [{
            title: 'All Day Event',
            start: new Date(y, m, 1)
        }, {
            title: 'Long Event',
            start: new Date(y, m, d - 5),
            end: new Date(y, m, d - 2)
        }, {
            id: 999,
            title: 'Repeating Event',
            start: new Date(y, m, d - 3, 16, 0),
            allDay: false
        }, {
            id: 999,
            title: 'Repeating Event',
            start: new Date(y, m, d + 4, 16, 0),
            allDay: false
        }, {
            title: 'Meeting',
            start: new Date(y, m, d, 10, 30),
            allDay: false
        }, {
            title: 'Lunch',
            start: new Date(y, m, d, 12, 0),
            end: new Date(y, m, d, 14, 0),
            allDay: false
        }, {
            title: 'Birthday Party',
            start: new Date(y, m, d + 1, 19, 0),
            end: new Date(y, m, d + 1, 22, 30),
            allDay: false
        }, {
            title: 'Click for Google',
            start: new Date(y, m, 28),
            end: new Date(y, m, 29),
            url: 'http://google.com/'
        }]
    });
});
$(document).on("pagehide", "#ubmsuite_mcs_position_strategic_command_center", function() {
    $("#calendar").empty()
});
$(document).on("pageshow", "#ubmsuite_mcs_my_applications", function() {
    getMyModelsListofApplications();
});
$(document).on("pagehide", "#projected_financial_statement", function() {
    $("#projected_financial_statement_iframe_container").empty()
});
$(document).on("pageshow", "#projected_financial_statement", function() {
    //1. Load the iframe with src directed to the application on Bluehost, Pass the active model id to the iframe. When the Page Loads
    showLoader();
    $('iframe').remove();
    $('<iframe id="projected_financial_statement_iframe" src="http://application.universalbusinessmodel.com/P3/?activeModelUUID=' + window.activeModelUUID + '&username=' + window.username + '" width="100%" height="700px" seamless=""></iframe>').appendTo('#projected_financial_statement_iframe_container');
    setTimeout(function() {
        hideLoader();
    }, 2000);
    //2. Reload the iframe with src directed to the application on Bluehost, Pass the active model id to the iframe. When the something inside the iframe container but outside the iframe is clicked.
    $('#projected_financial_statement_iframe_container').on('click', function() {
        showLoader();
        $('iframe').remove();
        $('<iframe id="projected_financial_statement_iframe" src="http://application.universalbusinessmodel.com/P3/?activeModelUUID=' + window.activeModelUUID + '&username=' + window.username + '" width="100%" height="700px" seamless=""></iframe>').appendTo('#projected_financial_statement_iframe_container');
        setTimeout(function() {
            hideLoader();
        }, 2000);
    });
    walkthrough('projected_financial_statement', function(status) {
        if (status == 0) {
            introJs('#projected_financial_statement').start().oncomplete(function() {
                setWalkthroughAsComplete('projected_financial_statement');
            });
        }
    });
});
$('.currency').keyup(function() {
    //alert('test'); 
    $('.currency').currency();
});
$(document).on("pageshow", "#ubmsuite_modelSettings", function() {
    getModelInformation();
    model_getuserswithaccess();
    setTimeout(function() {
        $('#tiles').trigger('refreshWookmark'); //Layout items in Wookmark Grid
        $("#ubmsuite_modelSettings_createProduct_popup").draggable({
            handle: "h1"
        });
        $("#ubmsuite_modelSettings_createFeature_popup_form").draggable({
            handle: "h1"
        });
        $("#ubmsuite_modelSettings_createStrategicPositioningQuestion_popup").draggable({
            handle: "h1"
        });
        $("#ubmsuite_modelSettings_createStrategicAlliance_popup").draggable({
            handle: "h1"
        });
        $("#ubmsuite_modelSettings_createPhysicalFacility_popup").draggable({
            handle: "h1"
        });
        $("#ubmsuite_modelSettings_createOrganizationalStructure_popup").draggable({
            handle: "h1"
        });
        $("#ubmsuite_modelSettings_createCoreValue_popup").draggable({
            handle: "h1"
        });
        $("#ubmsuite_modelSettings_createService_popup").draggable({
            handle: "h1"
        });
        $("#ubmsuite_modelSettings_createCustomer_popup").draggable({
            handle: "h1"
        });
        $("#ubmsuite_modelSettings_coreValues_popup").draggable({
            handle: "h1"
        });
        $("#ubmsuite_modelSettings_customers_popup").draggable({
            handle: "h1"
        });
        $("#ubmsuite_modelSettings_products_popup").draggable({
            handle: "h1"
        });
        $("#ubmsuite_modelSettings_services_popup").draggable({
            handle: "h1"
        });
        $("#ubmsuite_modelSettings_organizationalstructure_popup").draggable({
            handle: "h1"
        });
        $("#ubmsuite_modelSettings_physicalfacilities_popup").draggable({
            handle: "h1"
        });
        $("#ubmsuite_modelSettings_strategicalliances_popup").draggable({
            handle: "h1"
        });
        $("#ubmsuite_modelSettings_strategicpositioningquestions_popup").draggable({
            handle: "h1"
        });
        $("#ubmsuite_modelSettings_features_popup").draggable({
            handle: "h1"
        });
        $("#ubmsuite_modelSettings_requestedapplications_popup").draggable({
            handle: "h1"
        });
    }, 2000);
    getMyModelsCoreValues();
    walkthrough('ubmsuite_modelSettings', function(status) {
        if (status == 0) {
            introJs('#ubmsuite_modelSettings').start().oncomplete(function() {
                setWalkthroughAsComplete('ubmsuite_modelSettings');
            });
        }
    });
});
$(document).on("pageshow", ".ubm_page", function() {
    PieMenuInit();
    setTimeout(function() {
        $(".draggable").draggable();
        $(".draggable_popup").draggable({
            handle: "h1"
        });
        $("#sign_in_sign_up_openItem_popup").draggable({
            handle: "h1"
        });
        $("#mcs_setup_checklist_p2_openItem_popup").draggable({
            handle: "h1"
        });
        $("#ubmsuite_SelectBusinessModel_openItem_popup").draggable({
            handle: "h1"
        });
        $("#ubmsuite_table_of_contents_openItem_popup").draggable({
            handle: "h1"
        });
        $("#ubmsuite_modelDashboard_openItem_popup").draggable({
            handle: "h1"
        });
        $("#ubmsuite_sharedModelDashboard_openItem_popup").draggable({
            handle: "h1"
        });
        $("#gettingStarted_openItem_popup").draggable({
            handle: "h1"
        });
        $("#ubmsuite_modelSettings_openItem_popup").draggable({
            handle: "h1"
        });
        $("#ubmsuite_modelSettings_shareModel_popup").draggable({
            handle: "h1"
        });
        $("#mcs_setup_checklist_setup_openItem_popup").draggable({
            handle: "h1"
        });
        $("#mcs_setup_checklist_CS_openItem_popup").draggable({
            handle: "h1"
        });
        $("#mcs_setup_checklist_p1_userGuide_popup").draggable({
            handle: "h1"
        });
        $("#mcs_setup_checklist_p1_openItem_popup").draggable({
            handle: "h1"
        });
        $("#mcs_setup_checklist_p2_userGuide_popup").draggable({
            handle: "h1"
        });
        $("#mcs_setup_checklist_p3_userGuide_popup").draggable({
            handle: "h1"
        });
        $("#mcs_setup_checklist_p3_openItem_popup").draggable({
            handle: "h1"
        });
        $("#mcs_setup_checklist_p4_b1_userGuide_popup").draggable({
            handle: "h1"
        });
        $("#mcs_setup_checklist_p4_b1_openItem_popup").draggable({
            handle: "h1"
        });
        $("#mcs_setup_checklist_p4_b2_userGuide_popup").draggable({
            handle: "h1"
        });
        $("#mcs_setup_checklist_p4_b2_openItem_popup").draggable({
            handle: "h1"
        });
        $("#mcs_setup_checklist_p4_b3_userGuide_popup").draggable({
            handle: "h1"
        });
        $("#mcs_setup_checklist_p4_b3_openItem_popup").draggable({
            handle: "h1"
        });
        $("#mcs_setup_checklist_p4_b4_userGuide_popup").draggable({
            handle: "h1"
        });
        $("#mcs_setup_checklist_p4_b4_openItem_popup").draggable({
            handle: "h1"
        });
        $("#mcs_setup_checklist_p4_b5_userGuide_popup").draggable({
            handle: "h1"
        });
        $("#mcs_setup_checklist_p4_b5_openItem_popup").draggable({
            handle: "h1"
        });
        $("#mcs_setup_checklist_p4_b6_userGuide_popup").draggable({
            handle: "h1"
        });
        $("#mcs_setup_checklist_p4_b6_openItem_popup").draggable({
            handle: "h1"
        });
        $("#mcs_setup_checklist_p4_b7_userGuide_popup").draggable({
            handle: "h1"
        });
        $("#mcs_setup_checklist_p4_b7_openItem_popup").draggable({
            handle: "h1"
        });
        $("#mcs_setup_checklist_p4_b8_userGuide_popup").draggable({
            handle: "h1"
        });
        $("#mcs_setup_checklist_p4_b8_openItem_popup").draggable({
            handle: "h1"
        });
        $("#mcs_setup_checklist_p4_b9_userGuide_popup").draggable({
            handle: "h1"
        });
        $("#mcs_setup_checklist_p4_b9_openItem_popup").draggable({
            handle: "h1"
        });
        $("#mcs_setup_checklist_p4_b10_userGuide_popup").draggable({
            handle: "h1"
        });
        $("#mcs_setup_checklist_p4_b10_openItem_popup").draggable({
            handle: "h1"
        });
        $("#mcs_setup_checklist_p4_b11_userGuide_popup").draggable({
            handle: "h1"
        });
        $("#mcs_setup_checklist_p4_b11_openItem_popup").draggable({
            handle: "h1"
        });
        $("#mcs_setup_checklist_p4_b12_userGuide_popup").draggable({
            handle: "h1"
        });
        $("#mcs_setup_checklist_p4_b12_openItem_popup").draggable({
            handle: "h1"
        });
        $("#mcs_setup_checklist_p5_userGuide_popup").draggable({
            handle: "h1"
        });
        $("#mcs_setup_checklist_p5_openItem_popup").draggable({
            handle: "h1"
        });
        $("#mcs_setup_checklist_p6_userGuide_popup").draggable({
            handle: "h1"
        });
        $("#mcs_setup_checklist_p6_openItem_popup").draggable({
            handle: "h1"
        });
        $("#mcs_setup_checklist_p7_openItem_popup").draggable({
            handle: "h1"
        });
        $("#mcs_setup_checklist_p7_openItem_popup").draggable({
            handle: "h1"
        });
        $("#mcs_setup_checklist_p8_userGuide_popup").draggable({
            handle: "h1"
        });
        $("#mcs_setup_checklist_p8_openItem_popup").draggable({
            handle: "h1"
        });
        $("#open_points_action_items_openItem_popup").draggable({
            handle: "h1"
        });
        $("#mcs_setup_checklist_p4_b1_NewBusinessAccount_popup").draggable({
            handle: "h1"
        });
        $("#ubmsuite_mcs_my_organizational_chart_content_modifyPositionPopUp").draggable({
            handle: "h1"
        });

    }, 2000);
    //alert(window.activeubm_page);
    $.getJSON('http://api.universalbusinessmodel.com/ubm_get_page_ref.php?callback=?', { //JSONP Request
        activeubm_page: window.activeubm_page
    }, function(res, status) {
        $.each(res, function(i, item) {
            //alert(item.headerRecord_right_formref);
            $('#headerRecord_right_formref').empty();
            $('#headerRecord_right_formref').append(item.headerRecord_right_formref);

            window.activeUbmPageReference = item.headerRecord_right_formref;
        })
        //alert("jsonp request returned: " + status);
    });

    setTimeout(function() {

        //checkConnection();
    }, 3000);
});
app.initialize();