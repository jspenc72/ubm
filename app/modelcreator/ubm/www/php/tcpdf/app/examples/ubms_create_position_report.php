<?php
$myDocPage = $pdf->getAliasNumPage();
$myDocPages = $pdf->getAliasNbPages();
$html = '<html>
    <head>
    <style>
        .body {
            font-size:1.2em;
            font-weight: bold;
            color:#365F91;
        }
        span {
            color:#000;
            font-weight:normal;
        }
    </style>
    </head>
    <body>
        <p class="body">Grade Level: </p>
        <p class="body">Organizational Chart Level: <span></span></p>
        <p class="body">Branch: <span></span></p>
        <p class="body">Shift: <span></span></p>
        <p class="body">Full or Part Time: <span>'.$psFullOrPartTime.'</span></p>
        <p class="body">Pay Range Low: <span>'.$psPayRangeLow.'</span></p>
        <p class="body">Pay Range High: <span>'.$psPayRangeHigh.'</span></p>
        <p class="body">HR Contact: <span></span></p>
        <p class="body">HR Phone Number: <span></span></p>
        <p class="body">Position Summary: <span>'.$psSummary.'</span></p>
        
    </body>
</html>';

$headerCenter = "
<style>
.header {
    font-size:1em;
    color:#595959;
}
</style>
<p class='header' >Model Title: $modelTitle</p>
<p class='header' >Position Title: $psTitle</p>
";
$headerRight = "
<h5>$myDocPage of $myDocPages</h5>
";
$footerRight = '
<style>
    .footer {
        font-size:1em;
        color:#595959;
    }
</style>

<p class="footer">App ID  App User License #: </p>
<p class="footer">CC: </p>
<p class="footer">BM V #1.7: </p>
<a href="#*2" style="color:blue;">Table of Contents</a>
';
$footerLeft = "
<style>
    .footer {
        font-size:1em;
        color:#595959;
    }
</style>

<p class='footer'>UBM Revision Date: $ubm_date_time</p>
<p class='footer'>UBM Ref Manual #: </p>
<p class='footer'>BM Revision Date: $bm_date_time</p>
<p class='footer'>BM Ref Manual #: </p>
<p class='footer'>Destination Model Source Object String Ref # :</p>
";
$pdf->AddPage();

$pdf->Bookmark("PS-$psCounter: $psTitle", 0, 0, '', 'B', array(0,64,128));
// output the HTML content
$pdf->writeHTMLCELL(0, 0, 100, 6, $headerRight, 0, 1, 0, true, 'R');
$pdf->writeHTMLCELL(0, 0, 15, 6, $headerCenter, 0, 1, 0, true, 'C');
$pdf->writeHTML($html, true, false, true, true, '');
$pdf->writeHTMLCELL(0, 0, 15, 230, $footerLeft, 0, 1, 0, true, 'L');
$pdf->writeHTMLCELL(0, 0, 150, 246, $footerRight, 0, 1, 0, true, 'L');



$actual_link = "http://api.universalbusinessmodel.com/tcpdf/app/examples/ubm_hierarchicalObjects.php?callback=?&activeObjectUUID=$activeObjectUUID&activeModelUUID=$activeModelUUID&key=YDoS20lf7Vrnr22h8Ma6NGUV5DblnVhueTPXS7gPynRvQ6U8optzfnMDs3UD";
//set style for barcode
$style = array(
    'border' => 2,
    'vpadding' => 'auto',
    'hpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255)
    'module_width' => 1, // width of a single module in points
    'module_height' => 1 // height of a single module in points
);
$pdf->write2DBarcode($actual_link, 'QRCODE,H', 85, 245, 35, 35, $style, 'N');

