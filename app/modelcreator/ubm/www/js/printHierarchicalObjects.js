function openPositionHierarchicalPdf() {
    var link = "http://api.universalbusinessmodel.com/tcpdf/app/examples/ubm_hierarchicalObjects.php?callback=?&activeObjectUUID=" + window.activePositionUUID + "&activeModelUUID=" + window.activeModelUUID + "&key=" + window.key + "";
    window.open(link, '_blank');
}

function printModel() {
    var link = "http://api.universalbusinessmodel.com/tcpdf/app/examples/all_ubm_hierarchicalObjects.php?callback=?&activeModelOwnersUUID=" + window.activeModelOwnersUUID + "&activeModelUUID=" + window.activeModelUUID + "&key=" + window.key + "";
    window.open(link, '_blank');
}