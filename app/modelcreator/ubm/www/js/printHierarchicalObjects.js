function openPositionHierarchicalPdf() {
    var link = "http://api.universalbusinessmodel.com/tcpdf/app/examples/ubm_hierarchicalObjects.php?callback=?&activeObjectUUID=" + window.activePositionUUID + "";
    window.open(link, '_blank');
}

function printModel() {
    var link = "http://api.universalbusinessmodel.com/tcpdf/app/examples/all_ubm_hierarchicalObjects.php?callback=?&activeModelOwnersUUID=" + window.activeModelOwnersUUID + "&activeModelUUID=" + window.activeModelUUID + "";
    window.open(link, '_blank');
}