function showLoader() {
    //Show Loader Message
    var $this = $(this),
        theme = $this.jqmData("theme") || $.mobile.loader.prototype.options.theme,
        msgText = '' || $.mobile.loader.prototype.options.text,
        textVisible = false || $.mobile.loader.prototype.options.textVisible,
        textonly = false;
    html = $this.jqmData("html") || "";
    $.mobile.loading("show", {
        text: '',
        textVisible: false,
        theme: theme,
        textonly: false,
        html: html
    });
    //End Show Loader Message				
}

function hideLoader() {
    $.mobile.loading("hide");
}