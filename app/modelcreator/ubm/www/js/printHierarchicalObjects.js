function openPositionHierarchicalPdf() {
    var link = "http://api.universalbusinessmodel.com/tcpdf/app/examples/ubm_hierarchicalObjects.php?callback=?&activeObjectUUID=" + window.activePositionUUID + "";
    window.open(link, '_blank');
}