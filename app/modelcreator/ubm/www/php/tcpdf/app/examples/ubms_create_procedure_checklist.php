<?php
$myDocPage = $pdf->getAliasNumPage();
$myDocPages = $pdf->getAliasNbPages();
$headerRight = '
<h5>'.$myDocPage.' of '.$myDocPages.'</h5>
<a href="#*2" style="color:blue;">Table of Contents</a>
';
$headerCenter = '
<style>
.header {
    font-size:1em;
    color:#595959;
}
</style>
<p class="header" >Legal Entity: '.$legalEntity.'</p>
<p class="header" >Model Title: '.$modelTitle.'</p>
<p class="header" >CK Title: '.$prTitle.'</p>
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
<p class="footer">BM V #1.7: </p>
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
foreach ($cktableRow as $key => $row) {
    $rows = $rows.$row;
}

$stepTable = <<<EOD
<style>
.box_rotate {
    
}

</style>
<table cellspacing="0" cellpadding="1" border="1">
    <thead>
    <tr>
        <td width="35" align="center" style="writing-mode: tb-rl;"><b>Final Review</b></td>
        <td width="35" align="center"><b>Date</b></td>
        <td width="45" align="center"><b>Reviewed By</b></td>
        <td width="35" align="center"><b>Date</b></td>   
        <td width="45" align="center"><b>Prepared By</b></td>
        <td width="45" align="center"><b>Date</b></td>  
        <td width="30" align="center"><b>Ln#</b></td>  
        <td width="350" align="center"><b>Instruction Detail</b></td>  
        <td width="35" align="center"><b>Budgeted Hours</b></td>  
        <td width="35" align="center"><b>Actual Hours</b></td>  
        <td width="35" align="center"><b>Review Time</b></td>  
        <td width="47" align="center"><b>Difference</b></td>  
    </tr>
    </thead>
    $rows
</table>
EOD;
//$url ='';
//$pdf->write2DBarcode($url, 'QRCODE,H', 20, 210, 50, 50, '', 'N');
$pdf->AddPage('L', 'A4');
$pdf->Bookmark("CK-$prCounter: $prTitle", 3, 0, '', 'B', array(128,0,64));
// output the HTML content
$pdf->writeHTMLCELL(0, 0, 100, 6, $headerRight, 0, 1, 0, true, 'R');
$pdf->writeHTMLCELL(0, 0, 15, 6, $headerCenter, 0, 1, 0, true, 'C');
$pdf->writeHTML($stepTable, true, false, true, true, '');
$pdf->AddPage('P', 'A4');



