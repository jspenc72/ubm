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
        <p class="body">Essential Duties and Responsibilities: <span>'.$jdEssentialDutiesAndResponsibilities.'</span></p>
        <p class="body">Age Requirements: <span>'.$jdAgeRequirement.'</span></p>
        <p class="body">Education Requirements: <span>'.$jdEducationRequirements.'</span></p>
        <p class="body">Qualifications: <span>'.$jdQualifications.'</span></p>
        <p class="body">Physical Demands: <span>'.$jdPhysicalDemand.'</span></p>
        <p class="body">Work Environment: <span>'.$jdWorkEnvironment.'</span></p>
        
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
<p class="header" >Job Description</p>
<p class="header" >App Title</p>
<p class="header" >'.$jdTitle.'</p>
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
$pdf->AddPage();
$pdf->Bookmark("JD: $jdTitle", 1, 0, '', 'B', array(128,64,0));
// output the HTML content
$pdf->writeHTMLCELL(0, 0, 96, 6, $header, 0, 1, 0, true, 'L');
$pdf->writeHTML($html, true, false, true, true, '');
$pdf->writeHTMLCELL(0, 0, 15, 220, $footerLeft, 0, 1, 0, true, 'L');
$pdf->writeHTMLCELL(0, 0, 150, 246, $footerRight, 0, 1, 0, true, 'L');


