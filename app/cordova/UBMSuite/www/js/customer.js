function setActiveCustomerId(activeCustomerId) {
    window.activeCustomerId = activeCustomerId;
}

function getMyModelsCustomers() { //Populates Customer  Listview on Model Settings Page
    //alert("Customers was called");
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_getCurrentModel_Customers.php?callback=?', { //JSONP Request
        username: window.username,
        key: window.key,
        activeModelUUID: window.activeModelUUID
    }, function(res, status) {
        //						alert(status);
        $('#ubmsuite_modelSettings_myCustomers_ul').empty();
        $('#ubmsuite_mcs_model_visual_content_customers_ul').empty();
        $('#ubmsuite_modelSettings_myCustomers_ul').append("<li><a data-rel='popup' data-transition='slideup' href='#ubmsuite_modelSettings_customers_popup' class='ui-btn ui-shadow'>UBM Customers. </a></li>");
        $('#ubmsuite_modelSettings_myCustomers_ul').append("<li><a data-rel='popup' data-transition='slideup' href='#ubmsuite_modelSettings_createCustomer_popup' class='ui-btn ui-shadow'>Create new!</a></li>");
        $.each(res, function(i, item) {
            $('#ubmsuite_mcs_model_visual_content_customers_ul').append("<li><a>" + item.name + "</a></li>");
            //$('#ubmsuite_mcs_model_visual_content_customers_ul').listview().listview("refresh");
            $('#ubmsuite_modelSettings_myCustomers_ul').append("<li><a href='#'> <h2 style='white-space:normal;'>" + item.name + "</h2><p>" + item.id + "</p></a><a href='#ubmsuite_modelSettings_confirm_remove_Customer_popup' data-rel='popup' data-position-to='window' data-transition='pop' onclick='setActiveCustomerId(" + item.id + ")'>Remove Customer</a></li>");
            $('#ubmsuite_modelSettings_myCustomers_ul').listview().listview().listview("refresh");
        })
        $('#ubmsuite_mcs_model_visual_content_customers_ul').listview().listview().listview("refresh");
        $('#ubmsuite_modelSettings_myCustomers_ul').listview().listview().listview("refresh");
    });

    setTimeout(function() {
        $('#tiles').trigger('refreshWookmark'); //Layout items in Wookmark Grid
    }, 1000);
}

function getListofPossibleCustomers() { //Populates Customer Listview on Possible Customers Popup
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_getAll_Customers.php?callback=?', { //JSONP Request
        key: window.key,

    }, function(res, status) {
        //						alert(status);
        $('#ubmsuite_modelSettings_customers_popup_listview').empty();
        $.each(res, function(i, item) {
            $('#ubmsuite_modelSettings_customers_popup_listview').append("<li><a href='#'><p>" + item.name + "</p></a><a href='#' onclick='addCustomerToMyModel(" + item.id + ")'>Add Customer</a></li>");
            $('#ubmsuite_modelSettings_customers_popup_listview').listview().listview().listview("refresh");
        })
    });
}

function addCustomerToMyModel(customerId) { //Called when the user selects an item from the Customer Listview in the Possible Customer Popup
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_add_Customer.php?callback=?', { //JSONP Request
        key: window.key,
        username: window.username,
        activeModelUUID: window.activeModelUUID,
        activeCustomerId: customerId
    }, function(res, status) {
        $().toastmessage('showSuccessToast', "A Customer was added to your model");
        //alert(status);
    });
    getMyModelsCustomers();
}

function createNewCustomerAddtoMyModel() { //Called when the user submits the create new Customer Form
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_create_Customer.php?callback=?', { //JSONP Request
        key: window.key,
        activeModelUUID: window.activeModelUUID,
        customerName: document.getElementById("ubmsuite_modelSettings_createCustomer_popup_createCustomer_name").value
    }, function(res, status) {
        if (status == "success") {
            $('#ubmsuite_modelSettings_createCustomer_popup_form').each(function() {
                this.reset();
                $("#ubmsuite_modelSettings_createCustomer_popup").popup('close');
                getMyModelsCustomers();
            });
        }
    });
}

function removeCustomerFromMyModel() { //Called when the user selects the side button for each item in the My Models Has Core Values Listview
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_remove_Customer.php?callback=?', { //JSONP Request
        key: window.key,
        username: window.username,
        activeCustomerId: window.activeCustomerId,
        activeModelUUID: window.activeModelUUID
    }, function(res, status) {
        //alert(status);
    });
    setTimeout(function() {
        getMyModelsCustomers();
    }, 300);


}