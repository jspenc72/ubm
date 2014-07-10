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
        <p class="body">Purpose: <span>'.$prPurpose.'</span></p>
        <p class="body">Scope: <span>'.$prScope.'</span></p>
        <p class="body">Minimum Security Requirements Type: <span></span></p>
    </body>
</html>';
$headerRight = "
<h5>$myDocPage of $myDocPages</h5>
";
$headerCenter = '
<style>
.header {
    font-size:1em;
    color:#595959;
}
</style>
<p class="header" >Legal Entity: '.$legalEntity.'</p>
<p class="header" >Model Title: '.$modelTitle.'</p>
<p class="header" >PR Title: '.$prTitle.'</p>
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
<a href="#*2" style="color:blue;">TOC</a>
';
$rows = null;
foreach ($tableRow as $key => $row) {
    $rows = $rows.$row;
}
$stepTable = <<<EOD
<table cellpadding="0" cellspacing="0">
    <thead>
    <tr>
        <td width="35" align="center"><b>Step #</b></td>
        <td width="350" align="center"><b>Instruction</b></td>
        <td></td>
    </tr>
    </thead>
    $rows
</table>
EOD;
//$url ='';
//$pdf->write2DBarcode($url, 'QRCODE,H', 20, 210, 50, 50, '', 'N');
$pdf->AddPage();
$pdf->Bookmark("PR: $prTitle", 3, 0, '', 'B', array(128,0,64));
// output the HTML content
$pdf->writeHTMLCELL(0, 0, 100, 6, $headerRight, 0, 1, 0, true, 'R');
$pdf->writeHTMLCELL(0, 0, 15, 6, $headerCenter, 0, 1, 0, true, 'C');
$pdf->writeHTML($html, true, false, true, true, '');
$pdf->writeHTML($stepTable, true, false, true, true, '');
$pdf->writeHTMLCELL(0, 0, 15, 230, $footerLeft, 0, 1, 0, true, 'L');
$pdf->writeHTMLCELL(0, 0, 150, 246, $footerRight, 0, 1, 0, true, 'L');

