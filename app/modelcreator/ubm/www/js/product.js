function setActiveProductId(activeProductId) {
    window.activeProductId = activeProductId;
}

function getMyModelsProducts() { //Populates Customer  Listview on Model Settings Page
    //alert("Customers was called");
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_getCurrentModel_Products.php?callback=?', { //JSONP Request
        username: window.username,
        key: window.key,
        activeModelUUID: window.activeModelUUID
    }, function(res, status) {
        //						alert(status);
        $('#ubmsuite_mcs_model_visual_content_products_ul').empty();
        $('#ubmsuite_modelSettings_myProducts_ul').empty();
        $('#ubmsuite_modelSettings_myProducts_ul').append("<li><a data-rel='popup' data-transition='slideup' href='#ubmsuite_modelSettings_products_popup' class='ui-btn ui-shadow'>UBM Products. </a></li>");
        $('#ubmsuite_modelSettings_myProducts_ul').append("<li><a data-rel='popup' data-transition='slideup' href='#ubmsuite_modelSettings_createProduct_popup' class='ui-btn ui-shadow'>Create new!</a></li>");
        $.each(res, function(i, item) {
            $('#ubmsuite_mcs_model_visual_content_products_ul').append("<li><a>" + item.title + "</a></li>");
            //$('#ubmsuite_mcs_model_visual_content_products_ul').listview("refresh");
            $('#ubmsuite_modelSettings_myProducts_ul').append("<li><a href='#'> <h2 style='white-space:normal;'>" + item.title + "</h2><p>" + item.id + "</p></a><a href='#ubmsuite_modelSettings_confirm_remove_Product_popup' data-rel='popup' data-position-to='window' data-transition='pop' onclick='setActiveProductId(" + item.id + ")'>Remove Product</a></li>");
            $('#ubmsuite_modelSettings_myProducts_ul').listview("refresh");

        })
        $('#ubmsuite_mcs_model_visual_content_products_ul').listview("refresh");
        $('#ubmsuite_modelSettings_myProducts_ul').listview("refresh");
    });

    setTimeout(function() {
        $('#tiles').trigger('refreshWookmark'); //Layout items in Wookmark Grid
    }, 1000);
}

function getListofPossibleProducts() { //Populates Customer Listview on Possible Customers Popup
    $.getJSON('http://api.universalbusinessmodel.com/ubm_modelcreationsuite_model_getAll_Products.php?callback=?', { //JSONP Request
        key: window.key,

    }, function(res, status) {
        //						alert(status);
        $('#ubmsuite_modelSettings_products_popup_listview').empty();
        $.each(res, function(i, item) {
            $('#ubmsuite_modelSettings_products_popup_listview').append("<li><a href='#'><pstyle='white-space:normal;'>" + item.title + "</p></a><a href='#' onclick='addProductToMyModel(" + item.id + ")'>Add Product</a></li>");
            $('#ubmsuite_modelSettings_products_popup_listview').listview("refresh");
        })
    });
}

function addProductToMyModel(productId) { //Called when the user selects an item from the Customer Listview in the Possible Customer Popup
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_add_Product.php?callback=?', { //JSONP Request
        key: window.key,
        username: window.username,
        activeModelUUID: window.activeModelUUID,
        activeProductId: productId
    }, function(res, status) {
        $().toastmessage('showSuccessToast', "A Product was added to your model");
        //alert(status);
    });
    getMyModelsProducts();
}

function createNewProductAddtoMyModel() { //Called when the user submits the create new Customer Form
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_create_Product.php?callback=?', { //JSONP Request
        key: window.key,
        activeModelUUID: window.activeModelUUID,
        productTitle: document.getElementById("ubmsuite_modelSettings_createProduct_popup_Product_title").value
    }, function(res, status) {
        if (status == "success") {
            $('#ubmsuite_modelSettings_createProduct_popup_form').each(function() {
                this.reset();
                $("#ubmsuite_modelSettings_createProduct_popup").popup('close');

                getMyModelsProducts();
            });
        }
    });
}

function removeProductFromMyModel() { //Called when the user selects the side button for each item in the My Models Has Core Values Listview
    $.getJSON('http://api.universalbusinessmodel.com/ubms_modelcreationsuite_model_remove_Product.php?callback=?', { //JSONP Request
        key: window.key,
        username: window.username,
        activeProductId: window.activeProductId,
        activeModelUUID: window.activeModelUUID
    }, function(res, status) {
        //alert(status);
    });
    setTimeout(function() {
        getMyModelsProducts();
    }, 300);


}