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
        <p class="body">Objective: <span>'.$jdObjective.'</span></p>
        <p class="body">Essential Duties and Responsibilities: <span>'.$jdEssentialDutiesAndResponsibilities.'</span></p>
        <p class="body">Age Requirements: <span>'.$jdAgeRequirement.'</span></p>
        <p class="body">Education Requirements: <span>'.$jdEducationRequirements.'</span></p>
        <p class="body">Qualifications: <span>'.$jdQualifications.'</span></p>
        <p class="body">Physical Demands: <span>'.$jdPhysicalDemand.'</span></p>
        <p class="body">Work Environment: <span>'.$jdWorkEnvironment.'</span></p>
        
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
<p class="header" >JD Title: '.$jdTitle.'</p>
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
<a href="#*2" style="color:blue;">TOC</a>
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
$pdf->Bookmark("JD-$jdCounter - $jdTitle", 1, 0, '', 'B', array(128,64,0));
// output the HTML content
$pdf->writeHTMLCELL(0, 0, 100, 6, $headerRight, 0, 1, 0, true, 'R');
$pdf->writeHTMLCELL(0, 0, 15, 6, $headerCenter, 0, 1, 0, true, 'C');
$pdf->writeHTML($html, true, false, true, true, '');
$pdf->writeHTMLCELL(0, 0, 15, 230, $footerLeft, 0, 1, 0, true, 'L');
$pdf->writeHTMLCELL(0, 0, 150, 246, $footerRight, 0, 1, 0, true, 'L');


