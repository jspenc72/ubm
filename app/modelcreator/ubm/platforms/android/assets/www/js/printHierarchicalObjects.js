function openPositionHierarchicalPdf() {
    var link = "http://api.universalbusinessmodel.com/tcpdf/app/examples/test.php?callback=?&activeObjectUUID=" + window.activePositionUUID + "";
    window.open(link, '_blank');
}