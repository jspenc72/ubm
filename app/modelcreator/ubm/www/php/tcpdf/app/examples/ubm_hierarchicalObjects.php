<?php
require_once ('../config/tcpdf_config.php');
require_once ('../tcpdf.php');
include ('../../../DBConnect_UBMv1.php');
require_once ('../../../ubms_db_config.php');

//Provides the variables used for UBMv1 database connection $conn
require_once ('../../../globalGetVariables.php');
$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
date_default_timezone_set('America/Denver');
$round_numerator = 60 * 5;

// 60 seconds per minute * 5 minutes equals 300 seconds
//Calculate time to previous 5 minute increment.
$rounded_time = (floor(time() / $round_numerator) * $round_numerator);
$ubm_date_time = date('m-d-Y h:i:s A', $rounded_time);
$bm_date_time = date('m-d-Y h:i:s A', time());

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator('Adam Gustafson');
$pdf->SetAuthor('Adam Gustafson');
$pdf->SetTitle('Position Objects');
$pdf->SetSubject('');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set auto page breaks
$pdf->SetMargins(PDF_MARGIN_LEFT, 15, PDF_MARGIN_RIGHT);
$pdf->SetAutoPageBreak(TRUE, 0);
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);

// set font
$pdf->SetFont('times', '', 10);
$psCounter = null;
$all_UUID = array();
$all_items = array();
$tableRow = array();

if ($conn->connect_error) {
    trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
}
$v2 = "'" . $conn->real_escape_string($activeObjectUUID) . "'";
error_reporting(E_ALL);
ini_set('display_errors', '1');

$sqlsel1 = "SELECT * FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID
                JOIN ubm_model
                ON (ubm_model.id=ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.model_id)
                WHERE ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.UUID=$activeModelUUID";
$rs1 = $conn->query($sqlsel1);

//2. Set rs1 equal to the list of objects that is returned in the result set.
if ($rs1 === false) {
    trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
    while ($items1 = $rs1->fetch_assoc()) {
        $modelTitle = stripslashes($items1['title']);
        $legalEntity = stripslashes($items1['owner_legal_entity']);
    }
}

// $all_UUID array is a list of all the UUID's that were attatched to the given activeObjectUUID.
//4. Go through each UUID
$psCounter = 1;

//SELECT

//5.Get the id of the JD, PL, PR, ST, TA and return it
$psCounter = 1;
$sqlsel1 = "SELECT * FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID WHERE UUID=$activeObjectUUID";
$rs1 = $conn->query($sqlsel1);
if ($rs1 === false) {
    trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
    if (mysqli_num_rows($rs1) > 0) {
        
        //6. Select all of the information from the appropriate job description
        while ($items = $rs1->fetch_assoc()) {
            $positionId = $items['position_id'];
            if ($positionId >= 1) {
                
                $sqlsel6 = "SELECT * FROM ubm_model_positions WHERE id = $positionId";
                $rs6 = $conn->query($sqlsel6);
                if ($rs6 === false) {
                    trigger_error('Wrong SQL: ' . $sqlsel2 . ' Error: ' . $conn->error, E_USER_ERROR);
                } else {
                    while ($items6 = $rs6->fetch_assoc()) {
                        $psTitle = $items6['title'];
                        $psDescription = $items6['description'];
                        $psFullOrPartTime = $items6['full_or_part_time'];
                        $psPayType = $items6['pay_type'];
                        $psPayRangeLow = $items6['pay_range_low'];
                        $psPayRangeHigh = $items6['pay_range_high'];
                        $psSummary = $items6['summary'];
                        require ('ubms_create_position_report.php');
                        $jdCounter = 1;
                        $psCounter+= 1;
                        
                        $sqlsel7 = "SELECT * FROM ubm_modelcreationsuite_heirarchy_object_closureTable
                                    JOIN ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID
                                    ON ubm_modelcreationsuite_heirarchy_object_closureTable.descendant_id=ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.UUID
                                    JOIN ubm_model_jobDescriptions
                                    ON ubm_model_jobDescriptions.id=ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.jobDescription_id
                                    WHERE ancestor_id=$activeObjectUUID AND path_length=1";
                        $rs7 = $conn->query($sqlsel7);
                        if ($rs7 === false) {
                            trigger_error('Wrong SQL: ' . $sqlsel3 . ' Error: ' . $conn->error, E_USER_ERROR);
                        } else {
                            while ($items7 = $rs7->fetch_assoc()) {
                                $jobDescriptionUUID = $items7['UUID'];
                                $jdTitle = $items7['title'];
                                $jdObjective = $items7['objective'];
                                $jdEssentialDutiesAndResponsibilities = $items7['essential_duties_and_responsibilities'];
                                $jdAgeRequirement = $items7['age_requirement'];
                                $jdEducationRequirements = $items7['education_requirements'];
                                $jdQualifications = $items7['qualifications'];
                                $jdPhysicalDemand = $items7['physical_demand'];
                                $jdWorkEnvironment = $items7['work_environment'];
                                require('ubms_create_jobDescription_report.php');
                                $plCounter = 1;
                                $jdCounter += 1;  
                                
                                $sqlsel8 = "SELECT * FROM ubm_modelcreationsuite_heirarchy_object_closureTable 
                                            JOIN ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID
                                            ON ubm_modelcreationsuite_heirarchy_object_closureTable.descendant_id=ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.UUID
                                            JOIN ubm_model_policies
                                            ON ubm_model_policies.id=ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.policy_id
                                            WHERE ubm_modelcreationsuite_heirarchy_object_closureTable.ancestor_id=$jobDescriptionUUID AND ubm_modelcreationsuite_heirarchy_object_closureTable.path_length=1";
                                $rs8 = $conn->query($sqlsel8);
                                if ($rs8 === false) {
                                    trigger_error('Wrong SQL: ' . $sqlsel8 . ' Error: ' . $conn->error, E_USER_ERROR);
                                } else {
                                    while ($items8 = $rs8->fetch_assoc()) {
                                        $policyUUID = $items8['UUID'];
                                        $plTitle = $items8['title'];
                                        $plDescription = $items8['description'];
                                        $plPurpose = $items8['purpose'];
                                        $plScope = $items8['scope'];
                                        $plPolicyType = $items8['policy_type'];
                                        require('ubms_create_policy_report.php');
                                        $prCounter = 1;
                                        $plCounter += 1;
                                        
                                        $sqlsel9 = "SELECT * FROM ubm_modelcreationsuite_heirarchy_object_closureTable 
                                                    JOIN ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID
                                                    ON ubm_modelcreationsuite_heirarchy_object_closureTable.descendant_id=ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.UUID
                                                    JOIN ubm_model_procedures
                                                    ON ubm_model_procedures.id=ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.procedure_id
                                                    WHERE ubm_modelcreationsuite_heirarchy_object_closureTable.ancestor_id=$policyUUID AND ubm_modelcreationsuite_heirarchy_object_closureTable.path_length=1";
                                        $rs9 = $conn->query($sqlsel9);
                                        if ($rs9 === false) {
                                            trigger_error('Wrong SQL: ' . $sqlsel9 . ' Error: ' . $conn->error, E_USER_ERROR);
                                        } else {
                                            while ($items9 = $rs9->fetch_assoc()) {
                                                $procedureId = $items9['UUID'];
                                                $prTitle = $items9['title'];
                                                $prPurpose = $items9['purpose'];
                                                $prScope = $items9['scope'];
                                                
                                                $sqlsel3 = "SELECT * FROM ubm_modelcreationsuite_heirarchy_object_closureTable
                                                            JOIN ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID
                                                            ON ubm_modelcreationsuite_heirarchy_object_closureTable.descendant_id=ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.UUID
                                                            JOIN ubm_model_stepUUID_has_stepnumber
                                                            ON ubm_model_stepUUID_has_stepnumber.step_UUID=ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.UUID
                                                            JOIN ubm_model_steps
                                                            ON ubm_model_steps.id=ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.step_id
                                                            WHERE ancestor_id=$procedureId AND path_length=1
                                                            ORDER BY ubm_model_stepUUID_has_stepnumber.step_number";
                                                $rs3 = $conn->query($sqlsel3);
                                                
                                                if ($rs3 === false) {
                                                    trigger_error('Wrong SQL: ' . $sqlsel3 . ' Error: ' . $conn->error, E_USER_ERROR);
                                                } else {
                                                    while ($items3 = $rs3->fetch_assoc()) {
                                                        $stepUUID = $items3['UUID'];
                                                        $stepNumber = $items3['step_number'];
                                                        $stInstruction = $items3['instruction'];
                                                        $tableRow[] = '<tr><td width="35" align="center">' . $stepNumber . '</td><td width="350">' . $stInstruction . '</td></tr>';
                                                        
                                                        $sqlsel5 = "SELECT * FROM ubm_modelcreationsuite_heirarchy_object_closureTable 
                                                                    JOIN ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID
                                                                    ON ubm_modelcreationsuite_heirarchy_object_closureTable.descendant_id=ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.UUID
                                                                    JOIN ubm_model_taskUUID_has_tasknumber
                                                                    ON ubm_model_taskUUID_has_tasknumber.task_UUID=ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.UUID
                                                                    JOIN ubm_model_tasks
                                                                    ON ubm_model_tasks.id=ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.task_id
                                                                    WHERE ubm_modelcreationsuite_heirarchy_object_closureTable.ancestor_id=$stepUUID AND ubm_modelcreationsuite_heirarchy_object_closureTable.path_length=1
                                                                    ORDER BY ubm_model_taskUUID_has_tasknumber.task_number";
                                                        $rs5 = $conn->query($sqlsel5);
                                                        if ($rs5 === false) {
                                                            trigger_error('Wrong SQL: ' . $sqlsel3 . ' Error: ' . $conn->error, E_USER_ERROR);
                                                        } else {
                                                            if ($rs5->num_rows > 0) {
                                                                while ($items5 = $rs5->fetch_assoc()) {
                                                                    $taskNubmer = $items5['task_number'];
                                                                    $tkInstruction = $items5['instruction'];
                                                                    $tableRow[] = '<tr><td width="50"></td><td width="20">' . $taskNubmer . '.</td><td>' . $tkInstruction . '</td></tr>';
                                                                }
                                                            } else {
                                                                $tableRow[] = '<tr><td width="50"></td><td width="20"></td><td>No Task</td></tr>';
                                                            }
                                                        }
                                                    }
                                                    require ('ubms_create_procedure_report.php');
                                                    $tableRow = array();
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    } else {
    }
}
$pdf->addTOCPage();

// write the TOC title
//$pdf->SetFont('times', 'B', 16);
$pdf->MultiCell(0, 0, 'Legal Entity: ' . $modelTitle, 0, 'C', 0, 1, '', '', true, 0);
$pdf->MultiCell(0, 0, 'Model Title: ' . $modelTitle, 0, 'C', 0, 1, '', '', true, 0);
$pdf->Ln();
$pdf->MultiCell(0, 0, 'Table Of Contents', 0, 'C', 0, 1, '', '', true, 0);
$pdf->Ln();

// add a simple Table Of Content at first page
// (check the example n. 59 for the HTML version)
$pdf->addTOC(1, 'courier', '.', 'INDEX', 'B', array(128, 0, 0));

// end of TOC page
$pdf->endTOCPage();
$pdf->Output('PositionHierarchy.pdf', 'I');
