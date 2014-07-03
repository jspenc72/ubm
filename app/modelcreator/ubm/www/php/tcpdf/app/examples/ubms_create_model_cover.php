<?php
$html = '<html>
    <head>
    <style>
    h1 {
        font-size:25px;
    }
    </style>
    </head>
    <body>
        <h1 class="header">Universal Business Model</h1>
        
    </body>
</html>';
$image = '
    <img src="http://upload.wikimedia.org/wikipedia/en/2/25/C_Eldon_Kingston.JPG"/>
';
$footer = '
    <p>The Universal Business Model Application was developed for the purpose of creating a repeatable structure within a business that will account for every idea, process, procedure, and system. <br><br>The Universal Business Model helps a business to create an organizational structure that will assist that company in developing a high level of organization, short-term and long-term goal setting, risk analysis, control, functionality, information, business-model updating, and record retention throughout an organization. In addition, a functioning Business Model will facilitate information needed to strategically make positive decisions at every level in the organization. <br><br>It will also allow any business using this application to share policies, procedures, documents, applications, processes, etc., to assist others in creating their own business structure. Also to help the stewards tie all of their operations together, to other stewardships, and back to the office</p>
';
$pdf->AddPage();
// output the HTML content
$pdf->writeHTMLCELL(0, 0, 54, 6, $html, 0, 1, 0, true, 'L');
$pdf->writeHTMLCELL(0, 0, 70, 55, $image, 0, 1, 0, true, 'L');
$pdf->writeHTMLCELL(0, 0, 10, 220, $footer, 0, 1, 0, true, 'L');
