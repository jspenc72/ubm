<?php
require_once ('../config/tcpdf_config.php');
require_once ('../tcpdf.php');
include ('../../../DBConnect_UBMv1.php');
require_once ('../../../globalGetVariables.php');
$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);

// check connection
if ($conn->connect_error) {
    trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
}
$v2 = "'" . $conn->real_escape_string($activeObjectUUID) . "'";

//SELECT
$all_items = array();

//1. Select all records for checklist items stored in model_creation_suite, Count the number of items in the checklist.
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
                $returnUUID = stripslashes($items2['UUID']);
                
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
                            } elseif ($jobDescriptionId >= 1) {
                                $objectType = "JD";
                                $sqlsel4 = "SELECT * FROM ubm_model_jobDescriptions WHERE id=$jobDescriptionId";
                                $rs4 = $conn->query($sqlsel4);
                            } elseif ($policyId >= 1) {
                                $objectType = "PL";
                                $sqlsel4 = "SELECT * FROM ubm_model_policies WHERE id=$policyId";
                                $rs4 = $conn->query($sqlsel4);
                            } elseif ($procedureId >= 1) {
                                $objectType = "PR";
                                $sqlsel4 = "SELECT * FROM ubm_model_procedures WHERE id=$procedureId";
                                $rs4 = $conn->query($sqlsel4);
                            } elseif ($stepId >= 1) {
                                $objectType = "ST";
                                $sqlsel4 = "SELECT * FROM ubm_model_steps WHERE id=$stepId";
                                $rs4 = $conn->query($sqlsel4);
                            } elseif ($taskId >= 1) {
                                $objectType = "TK";
                                $sqlsel4 = "SELECT * FROM ubm_model_tasks WHERE id=$taskId";
                                $rs4 = $conn->query($sqlsel4);
                            } else {
                                echo "ERROR";
                            }
                            if ($rs4 === false) {
                                trigger_error('Wrong SQL: ' . $sqlsel4 . ' Error: ' . $conn->error, E_USER_ERROR);
                            } else {
                                while ($items2 = $rs4->fetch_assoc()) {
                                    $items2['object_type'] = $objectType;
                                    $all_items[] = $items2;
                                }
                            }
                        }
                        
                        //6. JSONP packaged $all_items array
                        echo $_GET['callback'] . '(' . json_encode($all_items) . ')';
                        
                        //Output $all_items array in json encoded format.
                        
                        
                    } else {
                    }
                }
            }
        }
    }
}

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF
{
    
    //Page header
    public function Header() {
        
        // Logo
        $image_file = K_PATH_IMAGES . 'logo_example.jpg';
        $this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        
        // Title
        $this->SetXY(15, 5);
        $this->Cell(0, 10, 'Legal Entity :', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetXY(15, 15);
        $this->Cell(0, 10, 'System Title :', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetXY(15, 25);
        $this->Cell(0, 10, 'App Title :', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetXY(15, 35);
        $this->Cell(0, 10, 'Position Title :', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }
    
    // Page footer
    public function Footer() {
        
        // Position at 15 mm from bottom
        $this->SetY(-15);
        
        // Set font
        $this->SetFont('dejavusans', 'I', 10);
        
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF('p', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Adam Gustafson');
$pdf->SetTitle('Hierarchical Objects');
$pdf->SetSubject('Subject');
$pdf->SetKeywords('PS, Position, UBM, Hierarchical, Objects');

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
<table id="gallerytab" width="100fixed merge conflict%" cellspacing="0" cellpadding="2" border="0">
    <tr>
      <th colspan="2">Position Attributes</th>
    </tr>';
$tbl_footer = '</table>';
$tableVar = '';
$myDocWidth = $pdf->getPageWidth(1);
if ($rs1 === false) {
    trigger_error('Wrong SQL: ' . $sqlsel . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
    if (mysqli_num_rows($rs1) > 0) {
        $numberOfPositions = mysqli_num_rows($rs1);
        $tableCounter = 0;
        while ($row = $rs1->fetch_assoc()) {
            $tableCounter+= 1;
            
            // add a page
            $tableVar = '    
         <tr>
             <td><font face="Arial, Helvetica, sans-serif">PS-ID: </font></td>
             <td>' . $row['id'] . '</td> 
         </tr>
         <tr>
             <td><font face="Arial, Helvetica, sans-serif">Title: </font></td>
             <td>' . $row['title'] . '</td>
         </tr>
         <tr>
             <td><font face="Arial, Helvetica, sans-serif">Org Chart Level: </font></td>
             <td>' . $row['position_has_org_chart_level'] . '</td>
         </tr>
         <tr>
             <td><font face="Arial, Helvetica, sans-serif">Full or Part Time: </font></td>
             <td>' . $row['full_or_part_time'] . '</td>
         </tr>
         <tr>
             <td><font face="Arial, Helvetica, sans-serif">Pay Type: </font></td>
             <td>' . $row['pay_type'] . '</td>
         </tr>         
         <tr>
             <td><font face="Arial, Helvetica, sans-serif">Pay Range (Low-High): </font></td>
             <td>' . $row['pay_range_low'] . '-' . $row['pay_range_high'] . '</td>
         </tr>
         <tr>
             <td><font face="Arial, Helvetica, sans-serif">Object Type: </font></td>
             <td>' . $row['object_type_reference'] . '</td>
         </tr>
         <tr>
             <td><font face="Arial, Helvetica, sans-serif">Age Requirements: </font></td>
             <td>' . $row['age_requirements'] . '</td>
         </tr>
         <tr>
             <td><font face="Arial, Helvetica, sans-serif">Education Requirements: </font></td>
             <td>' . $row['education_requirements'] . '</td>
         </tr>
         <tr>
             <td><font face="Arial, Helvetica, sans-serif">Qualifications: </font></td>
             <td>' . $row['qualifications'] . '</td>
         </tr>
         <tr>
             <td><font face="Arial, Helvetica, sans-serif">Creator Username: </font></td>
             <td>' . $row['creator_username'] . '</td>
         </tr>
         <tr>
             <td><font face="Arial, Helvetica, sans-serif">Creation Date: </font></td>
             <td>' . $row['creation_date'] . '</td>
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
           }</style><p class='one'>[Physical Demands] " . $row['physical_demands'] . "</p>", 1, 0, '', '', true);
            $pdf->Ln('', true);
            $pdf->SetX(105);
            $pdf->writeHTMLCell(0.33 * $myDocWidth, 5, '', '', "<style>p{   
             font-size: 12px;
             color: #66CCFF;
             padding: 3px 7px 2px;
             text-align: left;
           }</style><p class='two'>[Work Environment] " . $row['work_environment'] . "</p>", 1, 0, '', '', true);
            $pdf->Ln('', true);
            $pdf->SetX(105);
            $pdf->writeHTMLCell(0.33 * $myDocWidth, 5, '', '', "<style>p{   
             font-size: 12px;
             color: #9999FF;
             padding: 3px 7px 2px;
             text-align: left;
           }</style><p class='three'>[Conclusion] " . $row['conclusion'] . "</p>", 1, 0, '', '', true);
        }
        
        //        echo $_GET['callback'] . '(' . json_encode($all_items) . ')';       //Output $all_items array in json encoded format.
        
        
    } else {
        $tbl.= '
       <tr>
           <td>Query Returned no results</td>
       </tr>
    ';
    }
}

// output the HTML content
//$pdf->writeHTML($tbl , true, false, false, false, '');
//$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('ubm_hierarchicalObjects.pdf', 'I');
?>