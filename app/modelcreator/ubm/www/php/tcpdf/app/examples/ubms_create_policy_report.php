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
        <p class="body">Description: <span>'.$plDescription.'</span></p>
        <p class="body">Purpose: <span>'.$plPurpose.'</span></p>
        <p class="body">Scope: <span>'.$plScope.'</span></p>
        <p class="body">Policy Type: <span>'.$plPolicyType.'</span></p>
        
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
<p class="header" >Policy</p>
<p class="header" >App Title</p>
<p class="header" >'.$plTitle.'</p>
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


