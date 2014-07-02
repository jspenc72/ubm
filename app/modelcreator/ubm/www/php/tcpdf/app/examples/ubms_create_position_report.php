<?php
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

$header = '
<style>
.header {
    font-size:1em;
    color:#595959;
}
</style>
<p class="header" >Legal Entity</p>
<p class="header" >Position</p>
<p class="header" >App Title</p>
<p class="header" >'.$psTitle.'</p>
';

$footerRight = '
<style>
    .footer {
        font-size:1em;
        color:#595959;
    }
</style>

<p class="footer">App ID  App User License #: </p>
<p class="footer">CC: </p>
<p class="footer">BM V #: </p>
';

$footerLeft = '
<style>
    .footer {
        font-size:1em;
        color:#595959;
    }
</style>

<p class="footer">UBM Revision Date: </p>
<p class="footer">UBM Ref Manual #: </p>
<p class="footer">BM Revision Date: </p>
<p class="footer">BM Ref Manual #: </p>
<p class="footer">Destination Model Source Object String Ref # :</p>
';
$pdf->AddPage();
// output the HTML content
$pdf->writeHTMLCELL(0, 0, 96, 6, $header, 0, 1, 0, true, 'L');
$pdf->writeHTML($html, true, false, true, true, '');
$pdf->writeHTMLCELL(0, 0, 15, 230, $footerLeft, 0, 1, 0, true, 'L');
$pdf->writeHTMLCELL(0, 0, 150, 246, $footerRight, 0, 1, 0, true, 'L');

