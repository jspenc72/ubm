<?php
require_once('../config/tcpdf_config.php');
require_once('../tcpdf.php');
include('../../../DBConnect_UBMv1.php');
$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
// check connection
	if ($conn->connect_error) {
	  trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
	}
$sqlsel = "SELECT * FROM ubm_model_positions ORDER BY title ASC";
//Select all 
$rs1=$conn->query($sqlsel);

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {
    //Page header
    public function Header() {
        // Logo
//        $image_file = 'images/tcpdf_logo1.jpg';
        // $this->Image($image_file, 15, 5, 30, '', 'jpg', '', 'T', false, 300, '', false, false, 0, false, false, false);
    }
    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('dejavusans', 'I', 10);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF('l', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Assuni');
$pdf->SetTitle('Lista djelatnika na terenu');
$pdf->SetSubject('Subject');
$pdf->SetKeywords('TCPDF, PDF, tablica, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetMargins(PDF_MARGIN_LEFT, 40, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}
// ---------------------------------------------------------

// set font
$pdf->SetFont('times', 'B', 20);

$tbl_header = '<style>
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
   border: 1px solid #F5820F;
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
   border: 2px solid #F5820F;
   font-size: 12px;
   color: #5511FF;
   padding: 3px 7px 2px;
}
</style>
<table id="gallerytab" width="950" cellspacing="0" cellpadding="7" border="0">
<tr>
       <th><font face="Arial, Helvetica, sans-serif">ID</font></th>
       <th><font face="Arial, Helvetica, sans-serif">Title</font></th>
       <th><font face="Arial, Helvetica, sans-serif">Description</font></th>
       <th><font face="Arial, Helvetica, sans-serif">Creator Username</font></th>
       <th><font face="Arial, Helvetica, sans-serif">Creation Date</font></th>
       <th><font face="Arial, Helvetica, sans-serif">Summary</font></th>
       <th><font face="Arial, Helvetica, sans-serif">Object Type</font></th>
     </tr>';
$tbl_footer = '</table>';
$tableVar = ''; 
if($rs1 === false) {
  trigger_error('Wrong SQL: ' . $sqlsel . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
	if(mysqli_num_rows($rs1)>0){
		$numberOfPositions = mysqli_num_rows($rs1);
		$tableCounter = 0;
		while ($row = $rs1->fetch_assoc()) {
			$tableCounter +=1;
			// add a page
			 $tableVar .= '	   
				<tr>
			       <td>'.$row['id'].'</td> 
			       <td>'.$row['title'].'</td>
			       <td>'.$row['description'].'</td>
			       <td>'.$row['creator_username'].'</td>
			       <td>'.$row['creation_date'].'</td>
			       <td>'.$row['summary'].'</td>
			       <td>'.$row['object_type_reference'].'</td>
			   </tr>';
					$pdf->AddPage();
				   if($tableCounter==$numberOfPositions){
						$pdf->writeHTML($tbl_header.$tableVar.$tbl_footer);			   	
				   }
			   }
//				echo $_GET['callback'] . '(' . json_encode($all_items) . ')';				//Output $all_items array in json encoded format.			
	}else{
		$tbl .= '
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
$pdf->Output('ubm_PS_report.pdf', 'I');
?>