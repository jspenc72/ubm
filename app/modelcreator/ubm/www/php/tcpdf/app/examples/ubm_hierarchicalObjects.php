<?php
require_once ('../config/tcpdf_config.php');
require_once ('../tcpdf.php');
include ('../../../DBConnect_UBMv1.php');
require_once ('../../../globalGetVariables.php');
// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF
{
    
    //Page header
    
    public function Header() {
        $myDocWidth = $this->getPageWidth(1);
        
        // Logo
        $image_file = K_PATH_IMAGES . 'logo_example.jpg';
        $this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        
        // Title
        $this->SetXY(15, 5);
        
        //$this->Cell(0, 10, 'Legal Entity :', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        //$this->SetXY(15, 15);
        //$this->Cell(0, 10, 'System Title :', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        //$this->SetXY(15, 25);
        //$this->Cell(0, 10, 'App Title :', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        //$this->SetXY(15, 35);
        //$this->Cell(0, 10, 'Position Title :', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->writeHTMLCell(40, 5, 85, '', "<style>p{   
             font-size: 12px;
             color: #000000;
             padding: 3px 7px 2px;
             text-align: center;
           }</style><p>Legal Entity: </p></br><p>System Title: </p></br><p>App Title: </p><p>Title: </p>", 0, 0, false, false, C, true);
        $this->SetFontSize(12, false);
        $myDocPage = $this->getAliasNumPage();
        $myDocPages = $this->getAliasNbPages();
        $this->writeHTMLCell(40, 5, 155, '', "<style>
           p{    
             font-size: 12px;
             color: #000000;
             padding: 3px 7px 2px;
             text-align: right;
           }
           h5{
             color: #FF0000;
             text-align: right;
           }
           </style>
           <p>Packet Ref #: </p></br><p>MFI #: </p></br><h5>$myDocPage of $myDocPages</h5>", 1, 0, false, false, R, true);
    }
    
    // Page footer
    public function Footer() {
        
        // Position at 15 mm from bottom
        $this->SetXY(15, -50);
        
        // Set font
        $this->SetFont('dejavusans', 'B', 10);
        
        $this->SetXY(15, -15);
        $this->Cell(0, 10, 'Destination Model Object String Ref #:_____', 0, false, 'L', 0, '', 0, false, 'M', 'M');
        $this->SetXY(15, -20);
        $this->Cell(0, 10, 'BM Ref Manual #_____', 0, false, 'L', 0, '', 0, false, 'M', 'M');
        $this->SetXY(15, -25);
        $this->Cell(0, 10, 'BM Revision Date:_____', 0, false, 'L', 0, '', 0, false, 'M', 'M');
        $this->SetXY(15, -30);
        $this->Cell(0, 10, 'UBM Ref Manual # ', 0, false, 'L', 0, '', 0, false, 'M', 'M');
        $this->SetXY(55, -30);
        $this->Cell(0, 10, '01.02.01.05', 0, false, 'L', 0, '', 0, false, 'M', 'M');
        $this->SetXY(15, -35);
        $this->Cell(0, 10, 'UBM Revision Date: 4/25/2014', 0, false, 'L', 0, '', 0, false, 'M', 'M');
        $this->SetXY(15, -10);
        $this->SetFont('times', 'I', 10);
        $this->Cell(0, 10, 'Business Model Consulting LLC © 2014', 0, false, 'L', 0, '', 0, false, 'M', 'M');
        $this->SetFont('dejavusans', 'B', 10);
        $this->SetXY(155, -25);
        $this->Cell(0, 10, 'App ID____ App User License #____', 0, false, 'R', 0, '', 0, false, 'M', 'M');
        $this->SetXY(155, -20);
        $this->Cell(0, 10, 'CC:____', 0, false, 'R', 0, '', 0, false, 'M', 'M');
        $this->SetXY(155, -15);
        $this->Cell(0, 10, 'UBM V # 1.6', 0, false, 'R', 0, '', 0, false, 'M', 'M');
        $this->SetXY(155, -10);
        $this->Cell(0, 10, 'BM V #____', 0, false, 'R', 0, '', 0, false, 'M', 'M');
        
        // Page number
        //$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        
        
    }
}

//////////////////////////////////
// create new PDF document
// 1.  Create an instance of the MYPDF CLASS

$pdf = new MYPDF('p', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Jesse Spencer');
$pdf->SetTitle('Position Product Template');
$pdf->SetSubject('Subject');
$pdf->SetKeywords('PS, Position, UBM');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, 100, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once (dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);

// check connection
if ($conn->connect_error) {
    trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
}
$v2 = "'" . $conn->real_escape_string($activeObjectUUID) . "'";

//SELECT
$all_items = array();

//2. Select all records for checklist items stored in model_creation_suite, Count the number of items in the checklist.
$sqlsel1 = "SELECT c.* FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID u
                        JOIN ubm_modelcreationsuite_heirarchy_object_closureTable c
                        ON (u.UUID=c.descendant_id)
                        WHERE c.ancestor_id=$v2
                        ORDER BY u.UUID";

//$sqlsel1="SELECT * FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID WHERE UUID=1";     //Select all
$rs1 = $conn->query($sqlsel1);
if ($rs1 === false) {
    trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
    while ($items1 = $rs1->fetch_assoc()) {
        $returnedDescendant = stripslashes($items1['descendant_id']);
        $returnedAncestor = stripslashes($items1['ancestor_id']);
        $returnUUID = stripslashes($items1['UUID']);
        $d = stripslashes($items1['descendant_id']);
        $a = stripslashes($items1['ancestor_id']);
        echo 'UUID:'. $returnUUID . ' d:' . $d . ' a:' . $a . '<br>';
        
        //2. select the record with path_length=1 so that you get the immediate parent.
        $sqlsel2 = "SELECT * FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID u
                                JOIN ubm_modelcreationsuite_heirarchy_object_closureTable c
                                ON (u.UUID=c.descendant_id)
                                WHERE c.descendant_id=$returnedDescendant
                                AND c.path_length=1";
        $rs2 = $conn->query($sqlsel2);
        if ($rs2 === false) {
            trigger_error('Wrong SQL: ' . $sqlsel2 . ' Error: ' . $conn->error, E_USER_ERROR);
        } else {
            while ($items2 = $rs2->fetch_assoc()) {
                



















                
                //1. Select all records for checklist items stored in model_creation_suite, Count the number of items in the checklist.
                $sqlsel3 = "SELECT * FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID WHERE UUID='$returnUUID'";
                $rs3 = $conn->query($sqlsel3);
                if ($rs3 === false) {
                    trigger_error('Wrong SQL: ' . $sqlsel3 . ' Error: ' . $conn->error, E_USER_ERROR);
                } else {
                    if (mysqli_num_rows($rs3) > 0) {
                        
                        //2. Add the result set to the $all_items [] array
                        while ($items = $rs3->fetch_assoc()) {
                            $positionId = stripslashes($items['position_id']);
                            $jobDescriptionId = stripslashes($items['jobDescription_id']);
                            $policyId = stripslashes($items['policy_id']);
                            $procedureId = stripslashes($items['procedure_id']);
                            $stepId = stripslashes($items['step_id']);
                            $taskId = stripslashes($items['task_id']);
                            
                            if ($positionId >= 1) {
                                $objectType = "PS";
                                $sqlsel4 = "SELECT * FROM ubm_model_positions WHERE id=$positionId";
                                $rs4 = $conn->query($sqlsel4);
                                if ($rs4 === false) {
                                    trigger_error('Wrong SQL: ' . $sqlsel4 . ' Error: ' . $conn->error, E_USER_ERROR);
                                } else {
                                    while ($items2 = $rs4->fetch_assoc()) {
                                        $id = stripslashes($items2['id']);
                                        $title = stripslashes($items2['title']);
                                        $description = stripslashes($items2['description']);
                                        $creatorUsername = stripslashes($items2['creator_username']);
                                        $creationDate = stripslashes($items2['creation_date']);
                                        $fullOrPartTime = stripslashes($items2['full_or_part_time']);
                                        $payType = stripslashes($items2['pay_type']);
                                        $payRangeLow = stripslashes($items2['pay_range_low']);
                                        $payRangeHigh = stripslashes($items2['pay_range_high']);
                                        $summary = stripslashes($items2['summary']);
                                        $securityLevel = stripslashes($items2['security_level']);
                                        $ageRequirements = stripslashes($items2['age_requirements']);
                                        $qualifications = stripslashes($items2['qualifications']);
                                        $educationRequirements = stripslashes($items2['education_requirements']);
                                        $physicalDemands = stripslashes($items2['physical_demands']);
                                        $workEnvironment = stripslashes($items2['work_environment']);
                                        $conclusion = stripslashes($items2['conclusion']);
                                    //$all_items[] = $items2;
                                        // set font
                                        $pdf->SetFont('times', 'B', 20);
                                        $tbl_style = '<style>
                                        table {
                                           border-collapse: collapse;
                                           border-spacing: 0;
                                           margin: 0 10px;
                                        }
                                        tr {
                                           padding: 3px 0;
                                        }
                                        
                                        th {
                                           background-color: #CCCCCC;
                                           border: 1px solid #0066CC;
                                           color: #333333;
                                           font-family: trebuchet MS;
                                           font-size: 10px;
                                           padding-bottom: 4px;
                                           padding-left: 6px;
                                           padding-top: 5px;
                                           text-align: left;
                                        }
                                        td {
                                           background-color: #EEEEEE;
                                           border: 2px solid #996633;
                                           font-size: 12px;
                                           color: #5511FF;
                                           padding: 3px 7px 2px;
                                           text-align: left;
                                        
                                        }
                                        </style>';
                                        $tbl_header = '
                                        <table id="gallerytab" width="100%" cellspacing="0" cellpadding="2" border="0">
                                            <tr>
                                              <th colspan="2">Position Attributes</th>
                                            </tr>';
                                        $tbl_footer = '</table>';
                                        $tableVar = '';
                                        $myDocWidth = $pdf->getPageWidth(1);
                                        $tableVar = '      
                                             <tr>
                                                 <td><font face="Arial, Helvetica, sans-serif">PS-ID: </font></td>
                                                       <td>' . $id . '</td> 
                                             </tr>
                                             <tr>
                                                 <td><font face="Arial, Helvetica, sans-serif">Title: </font></td>
                                                       <td>' . $title . '</td>
                                             </tr>
                                             <tr>
                                                 <td><font face="Arial, Helvetica, sans-serif">Full or Part Time: </font></td>
                                                 <td>' . $fullOrPartTime . '</td>
                                             </tr>
                                             <tr>
                                                 <td><font face="Arial, Helvetica, sans-serif">Pay Type: </font></td>
                                                 <td>' . $payType . '</td>
                                             </tr>         
                                             <tr>
                                                 <td><font face="Arial, Helvetica, sans-serif">Pay Range (Low-High): </font></td>
                                                 <td>' . $payRangeLow . '-' . $payRangeHigh . '</td>
                                             </tr>
                                             <tr>
                                                 <td><font face="Arial, Helvetica, sans-serif">Age Requirements: </font></td>
                                                 <td>' . $ageRequirements . '</td>
                                             </tr>
                                             <tr>
                                                 <td><font face="Arial, Helvetica, sans-serif">Education Requirements: </font></td>
                                                 <td>' . $educationRequirements . '</td>
                                             </tr>
                                             <tr>
                                                 <td><font face="Arial, Helvetica, sans-serif">Qualifications: </font></td>
                                                 <td>' . $qualifications . '</td>
                                             </tr>
                                             <tr>
                                                 <td><font face="Arial, Helvetica, sans-serif">Creator Username: </font></td>
                                                 <td>' . $creatorUsername . '</td>
                                             </tr>
                                             <tr>
                                                 <td><font face="Arial, Helvetica, sans-serif">Creation Date: </font></td>
                                                 <td>' . $creationDate . '</td>
                                             </tr>';
                                        $pdf->AddPage();
                                        
                                        // set cell padding
                                        $pdf->setCellPaddings(1, 1, 1, 1);
                                        
                                        // set cell margins
                                        $pdf->setCellMargins(1, 1, 1, 1);
                                        
                                        // set color for background
                                        $pdf->SetFillColor(220, 255, 220);
                                        
                                        // Multicell test
                                        // writeHTMLCell ($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=false, $reseth=true, $align='', $autopadding=true)
                                        $pdf->writeHTMLCell(90, 5, 15, 45, $tbl_style . $tbl_header . $tableVar . $tbl_footer, 1, 0, '', '', true);
                                        
                                        // $pdf->Ln('',true);
                                        // print a blox of text using multicell()
                                        $pdf->SetXY(105, 45);
                                        $pdf->writeHTMLCell(0.33 * $myDocWidth, 5, '', '', "<style>p{   
                                         font-size: 12px;
                                         color: #5511FF;
                                         padding: 3px 7px 2px;
                                         text-align: left;
                                       }</style><p class='one'>[Physical Demands] " . $physicalDemands . "</p>", 1, 0, '', '', true);
                                        $pdf->Ln('', true);
                                        $pdf->SetX(105);
                                        $pdf->writeHTMLCell(0.33 * $myDocWidth, 5, '', '', "<style>p{   
                                         font-size: 12px;
                                         color: #66CCFF;
                                         padding: 3px 7px 2px;
                                         text-align: left;
                                       }</style><p class='two'>[Work Environment] " . $workEnvironment . "</p>", 1, 0, '', '', true);
                                        $pdf->Ln('', true);
                                        $pdf->SetX(105);
                                        $pdf->writeHTMLCell(0.33 * $myDocWidth, 5, '', '', "<style>p{   
                                         font-size: 12px;
                                         color: #9999FF;
                                         padding: 3px 7px 2px;
                                         text-align: left;
                                       }</style><p class='three'>[Conclusion] " . $conclusion . "</p>", 1, 0, '', '', true);
                                    }
                                }
                            } elseif ($jobDescriptionId >= 1) {
                                $objectType = "JD";
                                $sqlsel4 = "SELECT * FROM ubm_model_jobDescriptions WHERE id=$jobDescriptionId";
                                $rs4 = $conn->query($sqlsel4);
                                if ($rs4 === false) {
                                    trigger_error('Wrong SQL: ' . $sqlsel4 . ' Error: ' . $conn->error, E_USER_ERROR);
                                } else {
                                    while ($items2 = $rs4->fetch_assoc()) {
                                        $id = stripslashes($items['id']);
                                        $title = stripslashes($items['title']);
                                        $objective = stripslashes($items['objective']);
                                        $mfiReference = stripslashes($items['mfi_reference']);
                                        $essentialDutiesAndResponsibilities = stripslashes($items['essential_duties_and_responsibilities']);
                                        $ageRequirements = stripslashes($items['age_requirements']);
                                        $educationRequirements = stripslashes($items['education_requirements']);
                                        $qualifications = stripslashes($items['qualifications']);
                                        $physicalDemand = stripslashes($items['physical_demand']);
                                        $workEnvironment = stripslashes($items['work_environment']);
                                        $createdBy = stripslashes($items['created_by']);
                                        $createdDate = stripslashes($items['created_date']);
                                    //$all_items[] = $items2;
                                        $pdf->AddPage();
                                        // set font
                                        $pdf->SetFont('times', 'B', 20);
                                        $tbl_style = '<style>
                                        table {
                                           border-collapse: collapse;
                                           border-spacing: 0;
                                           margin: 0 10px;
                                        }
                                        tr {
                                           padding: 3px 0;
                                        }
                                        
                                        th {
                                           background-color: #CCCCCC;
                                           border: 1px solid #0066CC;
                                           color: #333333;
                                           font-family: trebuchet MS;
                                           font-size: 10px;
                                           padding-bottom: 4px;
                                           padding-left: 6px;
                                           padding-top: 5px;
                                           text-align: left;
                                        }
                                        td {
                                           background-color: #EEEEEE;
                                           border: 2px solid #996633;
                                           font-size: 12px;
                                           color: #5511FF;
                                           padding: 3px 7px 2px;
                                           text-align: left;
                                        
                                        }
                                        </style>';
                                        $tbl_header = '
                                        <table id="gallerytab" width="100%" cellspacing="0" cellpadding="2" border="0">
                                            <tr>
                                              <th colspan="2">Position Attributes</th>
                                            </tr>';
                                        $tbl_footer = '</table>';
                                        $tableVar = '';
                                        $myDocWidth = $pdf->getPageWidth(1);
                                        $tableVar = '      
                                             <tr>
                                                 <td><font face="Arial, Helvetica, sans-serif">JD-ID: </font></td>
                                                       <td>' . $jobDescriptionId . '</td> 
                                             </tr>
                                             <tr>
                                                 <td><font face="Arial, Helvetica, sans-serif">Title: </font></td>
                                                       <td>' . $title . '</td>
                                             </tr>
                                             <tr>
                                                 <td><font face="Arial, Helvetica, sans-serif">Objective: </font></td>
                                                 <td>' . $objective . '</td>
                                             </tr>
                                             <tr>
                                                 <td><font face="Arial, Helvetica, sans-serif">MFI Ref: </font></td>
                                                 <td>' . $mfiReference . '</td>
                                             </tr>         
                                             <tr>
                                                 <td><font face="Arial, Helvetica, sans-serif">Age Requirements: </font></td>
                                                 <td>' . $ageRequirements . '</td>
                                             </tr>
                                             <tr>
                                                 <td><font face="Arial, Helvetica, sans-serif">Essential Duties and Responsibilities: </font></td>
                                                 <td>' . $essentialDutiesAndResponsibilities . '</td>
                                             </tr>
                                             <tr>
                                                 <td><font face="Arial, Helvetica, sans-serif">Education Requirements: </font></td>
                                                 <td>' . $educationRequirements . '</td>
                                             </tr>
                                             <tr>
                                                 <td><font face="Arial, Helvetica, sans-serif">Work Environment: </font></td>
                                                 <td>' . $workEnvironment . '</td>
                                             </tr>
                                             <tr>
                                                 <td><font face="Arial, Helvetica, sans-serif">Creator Username: </font></td>
                                                 <td>' . $createdBy . '</td>
                                             </tr>
                                             <tr>
                                                 <td><font face="Arial, Helvetica, sans-serif">Creation Date: </font></td>
                                                 <td>' . $creationDate . '</td>
                                             </tr>';
                                        // writeHTMLCell ($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=false, $reseth=true, $align='', $autopadding=true)
                                        $pdf->writeHTMLCell(90, 5, 15, 45, $tbl_style . $tbl_header . $tableVar . $tbl_footer, 1, 0, '', '', true);
                                        
                                    }
                                }
                            } elseif ($policyId >= 1) {
                                $objectType = "PL";
                                $sqlsel4 = "SELECT * FROM ubm_model_policies WHERE id=$policyId";
                                $rs4 = $conn->query($sqlsel4);
                                if ($rs4 === false) {
                                    trigger_error('Wrong SQL: ' . $sqlsel4 . ' Error: ' . $conn->error, E_USER_ERROR);
                                } else {
                                    while ($items2 = $rs4->fetch_assoc()) {
                                        $id = stripslashes($items['id']);
                                        $title = stripslashes($items['title']);
                                        $description = stripslashes($items['description']);
                                        $mfiReference = stripslashes($items['mfi_reference']);
                                        $purpose = stripslashes($items['purpose']);
                                        $scope = stripslashes($items['scope']);
                                        $policyType = stripslashes($items['policy_type']);
                                        $createdBy = stripslashes($items['created_by']);
                                        $createdDate = stripslashes($items['created_date']);
                                    //$all_items[] = $items2;

								    }
                                }
                            } elseif ($procedureId >= 1) {
                                $objectType = "PR";
                                $sqlsel4 = "SELECT * FROM ubm_model_procedures WHERE id=$procedureId";
                                $rs4 = $conn->query($sqlsel4);
                                if ($rs4 === false) {
                                    trigger_error('Wrong SQL: ' . $sqlsel4 . ' Error: ' . $conn->error, E_USER_ERROR);
                                } else {
                                    while ($items2 = $rs4->fetch_assoc()) {
                                        $id = stripslashes($items['id']);
                                        $title = stripslashes($items['title']);
                                        $description = stripslashes($items['description']);
                                        $mfiReference = stripslashes($items['mfi_reference']);
                                        $purpose = stripslashes($items['purpsoe']);
                                        $effectiveDate = stripslashes($items['effective_date']);
                                        $scope = stripslashes($items['scope']);
                                        $policyType = stripslashes($items['policy_type']);
                                        $createdBy = stripslashes($items['created_by']);
                                        $createdDate = stripslashes($items['created_date']);
                                    //$all_items[] = $items2;                                 
								    }
                                }
                            } elseif ($stepId >= 1) {
                                $objectType = "ST";
                                $sqlsel4 = "SELECT * FROM ubm_model_steps WHERE id=$stepId";
                                $rs4 = $conn->query($sqlsel4);
                                if ($rs4 === false) {
                                    trigger_error('Wrong SQL: ' . $sqlsel4 . ' Error: ' . $conn->error, E_USER_ERROR);
                                } else {
                                    while ($items2 = $rs4->fetch_assoc()) {
                                        $id = stripslashes($items['id']);
                                        $title = stripslashes($items['title']);
                                        $description = stripslashes($items['description']);
                                        $reference = stripslashes($items['reference']);
                                        $instruction = stripslashes($items['instruction']);
                                        $stepNumber = stripslashes($items['step_number']);
                                        $createdBy = stripslashes($items['created_by']);
                                        $creationDate = stripslashes($items['creation_date']);
                                    //$all_items[] = $items2;
										
                                    }
                                }
                            } elseif ($taskId >= 1) {
                                $objectType = "TK";
                                $sqlsel4 = "SELECT * FROM ubm_model_tasks WHERE id=$taskId";
                                $rs4 = $conn->query($sqlsel4);
                                if ($rs4 === false) {
                                    trigger_error('Wrong SQL: ' . $sqlsel4 . ' Error: ' . $conn->error, E_USER_ERROR);
                                } else {
                                    while ($items2 = $rs4->fetch_assoc()) {
                                        $id = stripslashes($items['id']);
                                        $title = stripslashes($items['title']);
                                        $taskNumber = stripslashes($items['task_number']);
                                        $reference = stripslashes($items['reference']);
                                        $instruction = stripslashes($items['instruction']);
                                        $createdBy = stripslashes($items['created_by']);
                                        $creationDate = stripslashes($items['creation_date']);
                                    //$all_items[] = $items2;
                                                                                
                                    }
                                }
                            } else {
                                echo "ERROR";
                            }
                            if ($rs4 === false) {
                                trigger_error('Wrong SQL: ' . $sqlsel4 . ' Error: ' . $conn->error, E_USER_ERROR);
                            } else {
                                while ($items2 = $rs4->fetch_assoc()) {
                                    $items2['object_type'] = $objectType;
                                    //$all_items[] = $items2;
                                }
                            }
                        }
                        
                        //6. JSONP packaged $all_items array
                         
                        
                        //Output $all_items array in json encoded format.
                        
                        
                    } else {
                    }
                }
            }
        }
    }
}
//$pdf->Output('ubm_PS_report.pdf', 'I');
?>