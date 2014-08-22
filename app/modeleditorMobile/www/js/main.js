window.key = "J6ktdKDhsXSmvpTepZYQDXmKqnGFcOD0mJSTHvrIKUmoGjltv4QACtAYpZH5"; //Initialize BMCL Application Key.
$(document).on("pageshow", ".ubm_page", function() {
    var str = window.location.hash;
    //get current page from window as a string
    var strarray = str.split("#", 2);
    //spli the string to remove the hash
    window.activeubm_page = strarray[1];
});
$(document).on("pageshow", "#checklist_creator", function() {
    getChecklistsCreatedByUser();
    GetAttachableObjectsforChecklist(); 
});
$(document).on("pageshow", "#checklist_interface", function() {
    getNewChecklistforCompletion();
    
});
$(document).on("pageshow", "#models", function() {
    // alert("Welcome " + window.username);
    getMyModels();
    getUsersProfile();
});
$(document).on("pageshow", "#positions", function() {
    // alert("Welcome " + window.username);
    window.scrolltop = false;
    window.scrollbottom = false;

    getMyModelsPositions();
    $(window).scroll(function() {
        if ($(window).scrollTop() < -20 && window.scrolltop == false) {
            window.scrolltop = true;
            getMyModelsPositions();
        }
        if ($(window).scrollTop() + $(window).height() > $(document).height() + 20 && window.scrollbottom == false) {
            window.scrollbottom = true;
            getMyModelsPositions();
        }
    });
});
$(document).on("pageshow", "#jobDescriptions", function() {
    var str = window.location.hash;
    //get current page from window as a string
    var strarray = str.split("#", 2);
    //spli the string to remove the hash
    window.activeubm_page = strarray[1];
    // alert("Welcome " + window.username);
    window.scrolltop = false;
    window.scrollbottom = false;
    getMyModelsjobDescriptions();
    editObject();
    $(window).scroll(function() {
        if ($(window).scrollTop() < -20 && window.scrolltop == false) {
            window.scrolltop = true;
            getMyModelsjobDescriptions();
        }
        if ($(window).scrollTop() + $(window).height() > $(document).height() + 20 && window.scrollbottom == false) {
            window.scrollbottom = true;
            getMyModelsjobDescriptions();
        }
    });
});
$(document).on("pageshow", "#policies", function() {
    // alert("Welcome " + window.username);
    window.scrolltop = false;
    window.scrollbottom = false;
    getMyModelsPolicies();
    editObject();
    $(window).scroll(function() {
        if ($(window).scrollTop() < -20 && window.scrolltop == false) {
            window.scrolltop = true;
            getMyModelsPolicies();
        }
        if ($(window).scrollTop() + $(window).height() > $(document).height() + 20 && window.scrollbottom == false) {
            window.scrollbottom = true;
            getMyModelsPolicies();
        }
    });
});
$(document).on("pageshow", "#procedures", function() {
    // alert("Welcome " + window.username);
    window.scrolltop = false;
    window.scrollbottom = false;
    getMyModelsProcedures();
    editObject();
    $(window).scroll(function() {
        if ($(window).scrollTop() < -20 && window.scrolltop == false) {
            window.scrolltop = true;
            getMyModelsProcedures();
        }
        if ($(window).scrollTop() + $(window).height() > $(document).height() + 20 && window.scrollbottom == false) {
            window.scrollbottom = true;
            getMyModelsProcedures();
        }
    });
});
$(document).on("pageshow", "#steps", function() {
    // alert("Welcome " + window.username);
    window.scrolltop = false;
    window.scrollbottom = false;
    getMyModelsSteps();
    editObject();
    $(window).scroll(function() {
        if ($(window).scrollTop() < -20 && window.scrolltop == false) {
            window.scrolltop = true;
            getMyModelsSteps();
        }
        if ($(window).scrollTop() + $(window).height() > $(document).height() + 20 && window.scrollbottom == false) {
            window.scrollbottom = true;
            getMyModelsSteps();
        }
    });
});
$(document).on("pageshow", "#tasks", function() {
    // alert("Welcome " + window.username);
    window.scrolltop = false;
    window.scrollbottom = false;
    getMyModelsTasks();
    editObject();
    $(window).scroll(function() {
        if ($(window).scrollTop() < -20 && window.scrolltop == false) {
            window.scrolltop = true;
            getMyModelsTasks();
        }
        if ($(window).scrollTop() + $(window).height() > $(document).height() + 20 && window.scrollbottom == false) {
            window.scrollbottom = true;
            getMyModelsTasks();
        }
    });
});