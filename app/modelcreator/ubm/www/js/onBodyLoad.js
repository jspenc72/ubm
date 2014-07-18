function onLoadBody() {
    window.setInterval(function() {
        var hashname = window.location.hash;
        var hashLength = window.location.hash.length;
        if (!window.username && window.location.hash.length > 17) {
            window.location.hash = "";
            console.log(hashname);
            console.log(hashLength);

            alert("You have been logged out. Please do not use the browsers refresh button while this app is in development.");
        }
    }, 5000);
    window.key = "YDoS20lf7Vrnr22h8Ma6NGUV5DblnVhueTPXS7gPynRvQ6U8optzfnMDs3UD"; //BMCL Application Key.
    //  alert("This is an Alert!");
    $('.back_btn').click(function() {
        parent.history.back();
        return false;
    });
    $(".ubm_page").on("pageremove", function(event) {
        //alert("beforeshow!");
    });
    $(".ubm_page").on("pageshow", function(event) { //bind to a ubm page change event!
        var str = window.location.hash;
        //get current page from window as a string
        var strarray = str.split("#", 2);
        //spli the string to remove the hash
        window.activeubm_page = strarray[1];
        if (strarray[1] == "gettingStarted") {
            var link = document.getElementById("openItem_popup_button");
            //Get the popup on the current page.
            link.setAttribute("href", '#gettingStarted_openItem_popup');
            //Set the Attribute of the open item button to the popup on the current page.
        } else {
            if (strarray[1] == "ubmsuite_table_of_contents") {
                var link = document.getElementById("openItem_popup_button");
                //Get the popup on the current page.
                link.setAttribute("href", '#ubmsuite_table_of_contents_openItem_popup');
                //Set the Attribute of the open item button to the popup on the current page.
            } else {
                if (strarray[1] == "creator_table_of_contents") {
                    var link = document.getElementById("openItem_popup_button");
                    //Get the popup on the current page.
                    link.setAttribute("href", '#creator_table_of_contents_openItem_popup');
                    //Set the Attribute of the open item button to the popup on the current page.
                } else {
                    if (strarray[1] == "identification_setup") {
                        var link = document.getElementById("openItem_popup_button");
                        //Get the popup on the current page.
                        link.setAttribute("href", '#identification_setup_openItem_popup');
                        //Set the Attribute of the open item button to the popup on the current page.
                    } else {
                        if (strarray[1] == "primary_objects_setup_table") {
                            var link = document.getElementById("openItem_popup_button");
                            //Get the popup on the current page.
                            link.setAttribute("href", '#primary_objects_setup_table_openItem_popup');
                            //Set the Attribute of the open item button to the popup on the current page.
                        } else {
                            if (strarray[1] == "possible_alternatives") {
                                var link = document.getElementById("openItem_popup_button");
                                //Get the popup on the current page.
                                link.setAttribute("href", '#possible_alternatives_openItem_popup');
                                //Set the Attribute of the open item button to the popup on the current page.
                            } else {
                                if (strarray[1] == "mcs_setup_checklist_setup") {
                                    var link = document.getElementById("openItem_popup_button");
                                    //Get the popup on the current page.
                                    link.setAttribute("href", '#mcs_setup_checklist_setup_openItem_popup');
                                    //Set the Attribute of the open item button to the popup on the current page.
                                } else {
                                    if (strarray[1] == "mcs_setup_checklist_CS") {
                                        var link = document.getElementById("openItem_popup_button");
                                        //Get the popup on the current page.
                                        link.setAttribute("href", '#mcs_setup_checklist_CS_openItem_popup');
                                        //Set the Attribute of the open item button to the popup on the current page.
                                    } else {
                                        if (strarray[1] == "mcs_setup_checklist_p1") {
                                            var link = document.getElementById("openItem_popup_button");
                                            //Get the popup on the current page.
                                            link.setAttribute("href", '#mcs_setup_checklist_p1_openItem_popup');
                                            //Set the Attribute of the open item button to the popup on the current page.
                                        } else {
                                            if (strarray[1] == "mcs_setup_checklist_p2") {
                                                var link = document.getElementById("openItem_popup_button");
                                                //Get the popup on the current page.
                                                link.setAttribute("href", '#mcs_setup_checklist_p2_openItem_popup');
                                                //Set the Attribute of the open item button to the popup on the current page.
                                            } else {
                                                if (strarray[1] == "mcs_setup_checklist_p3") {
                                                    var link = document.getElementById("openItem_popup_button");
                                                    //Get the popup on the current page.
                                                    link.setAttribute("href", '#mcs_setup_checklist_p3_openItem_popup');
                                                    //Set the Attribute of the open item button to the popup on the current page.
                                                } else {
                                                    if (strarray[1] == "mcs_setup_checklist_p4_b1") {
                                                        var link = document.getElementById("openItem_popup_button");
                                                        //Get the popup on the current page.
                                                        link.setAttribute("href", '#mcs_setup_checklist_p4_b1_openItem_popup');
                                                        //Set the Attribute of the open item button to the popup on the current page.
                                                    } else {
                                                        if (strarray[1] == "mcs_setup_checklist_p4_b2") {
                                                            var link = document.getElementById("openItem_popup_button");
                                                            //Get the popup on the current page.
                                                            link.setAttribute("href", '#mcs_setup_checklist_p4_b2_openItem_popup');
                                                            //Set the Attribute of the open item button to the popup on the current page.
                                                        } else {
                                                            if (strarray[1] == "mcs_setup_checklist_p5") {
                                                                var link = document.getElementById("openItem_popup_button");
                                                                //Get the popup on the current page.
                                                                link.setAttribute("href", '#mcs_setup_checklist_p5_openItem_popup');
                                                                //Set the Attribute of the open item button to the popup on the current page.
                                                            } else {
                                                                if (strarray[1] == "mcs_setup_checklist_p6") {
                                                                    var link = document.getElementById("openItem_popup_button");
                                                                    //Get the popup on the current page.
                                                                    link.setAttribute("href", '#mcs_setup_checklist_p6_openItem_popup');
                                                                    //Set the Attribute of the open item button to the popup on the current page.
                                                                } else {
                                                                    if (strarray[1] == "mcs_setup_checklist_p7") {
                                                                        var link = document.getElementById("openItem_popup_button");
                                                                        //Get the popup on the current page.
                                                                        link.setAttribute("href", '#mcs_setup_checklist_p7_openItem_popup');
                                                                        //Set the Attribute of the open item button to the popup on the current page.
                                                                    } else {
                                                                        if (strarray[1] == "mcs_setup_checklist_p8") {
                                                                            var link = document.getElementById("openItem_popup_button");
                                                                            //Get the popup on the current page.
                                                                            link.setAttribute("href", '#mcs_setup_checklist_p8_openItem_popup');
                                                                            //Set the Attribute of the open item button to the popup on the current page.
                                                                        } else {
                                                                            if (strarray[1] == "open_points_action_items") {
                                                                                var link = document.getElementById("openItem_popup_button");
                                                                                //Get the popup on the current page.
                                                                                link.setAttribute("href", '#open_points_action_items_openItem_popup');
                                                                                //Set the Attribute of the open item button to the popup on the current page.
                                                                            } else {
                                                                                if (strarray[1] == "ubmsuite_SelectBusinessModel") {
                                                                                    var link = document.getElementById("openItem_popup_button");
                                                                                    //Get the popup on the current page.
                                                                                    link.setAttribute("href", '#ubmsuite_SelectBusinessModel_openItem_popup');
                                                                                    //Set the Attribute of the open item button to the popup on the current page.
                                                                                } else {
                                                                                    if (strarray[1] == "ubmsuite_modelDashboard") {
                                                                                        var link = document.getElementById("openItem_popup_button");
                                                                                        //Get the popup on the current page.
                                                                                        link.setAttribute("href", '#ubmsuite_modelDashboard_openItem_popup');
                                                                                        //Set the Attribute of the open item button to the popup on the current page.                                                                                                   
                                                                                    } else {
                                                                                        if (strarray[1] == "ubmsuite_mcs_my_organizational_chart") {
                                                                                            var link = document.getElementById("openItem_popup_button");
                                                                                            //Get the popup on the current page.
                                                                                            link.setAttribute("href", '#ubmsuite_mcs_my_organizational_chart_openItem_popup');
                                                                                            //Set the Attribute of the open item button to the popup on the current page.
                                                                                        } else {
                                                                                            if (strarray[1] == "ubmsuite_mcs_model_visual") {
                                                                                                var link = document.getElementById("openItem_popup_button");
                                                                                                //Get the popup on the current page.
                                                                                                link.setAttribute("href", '#ubmsuite_mcs_model_visual_openItem_popup');
                                                                                                //Set the Attribute of the open item button to the popup on the current page.
                                                                                            } else {
                                                                                                if (strarray[1] == "ubmsuite_mcs_model_review") {
                                                                                                    var link = document.getElementById("openItem_popup_button");
                                                                                                    //Get the popup on the current page.
                                                                                                    link.setAttribute("href", '#ubmsuite_mcs_model_review_openItem_popup');
                                                                                                    //Set the Attribute of the open item button to the popup on the current page.
                                                                                                } else {
                                                                                                    if (strarray[1] == "possible_alternatives") {
                                                                                                        var link = document.getElementById("openItem_popup_button");
                                                                                                        //Get the popup on the current page.
                                                                                                        link.setAttribute("href", '#possible_alternatives_openItem_popup');
                                                                                                        //Set the Attribute of the open item button to the popup on the current page.
                                                                                                    } else {
                                                                                                        if (strarray[1] == "ubmsuite_modelSettings") {
                                                                                                            var link = document.getElementById("openItem_popup_button");
                                                                                                            //Get the popup on the current page.
                                                                                                            link.setAttribute("href", '#ubmsuite_modelSettings_openItem_popup');
                                                                                                            //Set the Attribute of the open item button to the popup on the current page.
                                                                                                        } else {
                                                                                                            if (strarray[1] == "risk_analysis") {
                                                                                                                var link = document.getElementById("openItem_popup_button");
                                                                                                                //Get the popup on the current page.
                                                                                                                link.setAttribute("href", '#risk_analysis_openItem_popup');
                                                                                                                //Set the Attribute of the open item button to the popup on the current page.
                                                                                                            } else {
                                                                                                                if (strarray[1] == "return_on_investment") {
                                                                                                                    var link = document.getElementById("openItem_popup_button");
                                                                                                                    //Get the popup on the current page.
                                                                                                                    link.setAttribute("href", '#return_on_investment_openItem_popup');
                                                                                                                    //Set the Attribute of the open item button to the popup on the current page.
                                                                                                                } else {
                                                                                                                    if (strarray[1] == "projected_financial_statement") {
                                                                                                                        var link = document.getElementById("openItem_popup_button");
                                                                                                                        //Get the popup on the current page.
                                                                                                                        link.setAttribute("href", '#projected_financial_statement_openItem_popup');
                                                                                                                        //Set the Attribute of the open item button to the popup on the current page.
                                                                                                                    } else {
                                                                                                                        if (strarray[1] == "license_agreement_verification") {
                                                                                                                            var link = document.getElementById("openItem_popup_button");
                                                                                                                            //Get the popup on the current page.
                                                                                                                            link.setAttribute("href", '#license_agreement_verification_openItem_popup');
                                                                                                                            //Set the Attribute of the open item button to the popup on the current page.
                                                                                                                        } else {
                                                                                                                            if (strarray[1] == "account_verification") {
                                                                                                                                var link = document.getElementById("openItem_popup_button");
                                                                                                                                //Get the popup on the current page.
                                                                                                                                link.setAttribute("href", '#account_verification_openItem_popup');
                                                                                                                                //Set the Attribute of the open item button to the popup on the current page.
                                                                                                                            }
                                                                                                                        }
                                                                                                                    }
                                                                                                                }
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        //      alert(window.location.hash);                                    //outputs the original hash
        //alert(strarray[1]);                                               //outputs the split string which has the hash removed
        $.getJSON('http://api.universalbusinessmodel.com/getubmpagereference.php?callback=?', { //JSONP Request to the app_pages table.
            key: window.key,
            pageid: strarray[1] // sends the current page to the server.
        }, function(res, status) {
            //  alert("json returned successfully! "+ status);
            //  alert(res.message); // Alerts the current page which was sent in the call back from the server.
        });
    });
    $("#si_email").focus();
}