<?php
require_once ('../config/tcpdf_config.php');
require_once ('../tcpdf.php');
include ('../../../DBConnect_UBMv1.php');
//Provides the variables used for UBMv1 database connection $conn
require_once ('../../../globalGetVariables.php');

$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);

error_reporting(E_ALL);
ini_set('display_errors', '1');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator('Adam Gustafson');
$pdf->SetAuthor('Adam Gustafson');
$pdf->SetTitle('Job Description Template');
$pdf->SetSubject('JD');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
// set auto page breaks
$pdf->SetMargins(PDF_MARGIN_LEFT, 15, 15);
$pdf->SetAutoPageBreak(TRUE, 0);
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);
// set font
$pdf->SetFont('times', '', 10);


if ($conn->connect_error) {
    trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
}

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
require_once('ubms_create_model_cover.php');
//SELECT
$positionUUID = array();
$all_UUID = array();

//1. Get the longest path_length for the activeModelOwnersUUID position

//2. Begin a for loop to gather each of the positions that
$sqlsel1 = "SELECT * 
                FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID
                JOIN ubm_model_position_closure
                ON (ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.UUID=ubm_model_position_closure.descendant_UUID)
                JOIN ubm_model_positions
                ON ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.position_id=ubm_model_positions.id  
                LEFT JOIN ubm_modelCreationSuite_position_has_members
                ON ubm_modelCreationSuite_position_has_members.position_UUID=ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.UUID                   
                WHERE ubm_model_position_closure.ancestor_UUID=$activeModelOwnersUUID
                GROUP BY ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.UUID";

//NEED to add if statment that retrieves the record where the current
//descendant has a relationship with path length of 1 if the returned
//path_length is greater than 1.
//Select all
$positionUUID[] = $activeModelOwnersUUID;
$rs1 = $conn->query($sqlsel1);
if ($rs1 === false) {
    trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
    if (mysqli_num_rows($rs1) > 0) {
        
        //2. Add the result set to the $all_items [] array
        while ($items = $rs1->fetch_assoc()) {
            $path_length = stripslashes($items['path_length']);
            $descendant_UUID = stripslashes($items['descendant_UUID']);
            if ($path_length < 2 && $path_length > 0) {
                $positionUUID[] = stripslashes($items['UUID']);
            } else {
                //Selects all information from the specified descendant_idZ
                $sqlsel2 = "SELECT * FROM ubm_model_position_closure
                                JOIN ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID
                                ON (ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.UUID=ubm_model_position_closure.descendant_UUID)
                                JOIN ubm_model_positions
                                ON ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.position_id=ubm_model_positions.id
                                LEFT JOIN ubm_modelCreationSuite_position_has_members
                                ON ubm_modelCreationSuite_position_has_members.position_UUID=ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.UUID
                                WHERE ubm_model_position_closure.descendant_UUID=$descendant_UUID
                                AND ubm_model_position_closure.path_length=1
                                GROUP BY ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.UUID";
                $rs2 = $conn->query($sqlsel2);
                if ($rs2 === false) {
                    trigger_error('Wrong SQL: ' . $sqlsel2 . ' Error: ' . $conn->error, E_USER_ERROR);
                } else {
                    if (mysqli_num_rows($rs2) > 0) {
                        
                        //2. Add the result set to the $all_items [] array
                        while ($items2 = $rs2->fetch_assoc()) {
                           $positionUUID[] = stripslashes($items2['UUID']);


                        }
                    } else {
                    }
                }
            }
        }
    } else {
    }
}

foreach ($positionUUID as $key => $position) {

    //SELECT
    //1. Select all records with ancestor equal to the activeObjectUUID
    $sqlsel1 = "SELECT c.descendant_id, c.ancestor_id, c.path_length FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID u
                    JOIN ubm_modelcreationsuite_heirarchy_object_closureTable c
                    ON (u.UUID=c.descendant_id)
                    WHERE c.ancestor_id=$position
                    ORDER BY u.UUID";
    $rs1 = $conn->query($sqlsel1);

    //2. Set rs1 equal to the list of objects that is returned in the result set.
    if ($rs1 === false) {
        trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
    } else {
        while ($items1 = $rs1->fetch_assoc()) {
            
            //3. Loop through the result set and get the descendant_id and the ancestor_id
            $returnedDescendant = stripslashes($items1['descendant_id']);
            $returnedAncestor = stripslashes($items1['ancestor_id']);
            
            //4. select the record with path_length=1 so that you get the immediate parent.
            
            $sqlsel2 = "SELECT c.*, u.* FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID u
                            JOIN ubm_modelcreationsuite_heirarchy_object_closureTable c
                            ON (u.UUID=c.descendant_id)
                            WHERE c.descendant_id=$returnedDescendant
                            AND c.path_length=1";
            $rs2 = $conn->query($sqlsel2);
            if ($rs2 === false) {
                trigger_error('Wrong SQL: ' . $sqlsel2 . ' Error: ' . $conn->error, E_USER_ERROR);
            } else {
                
                //3. Get all the UUID's from the returned array
                while ($items2 = $rs2->fetch_assoc()) {
                    $all_UUID[] = stripslashes($items2['UUID']);
                }
            }
        }
    }
}
//echo $_GET['callback'] . '(' . json_encode($positionUUID) . ')';
//echo $_GET['callback'] . '(' . json_encode($all_UUID) . ')';
// $all_UUID array is a list of all the UUID's that were attatched to the given activeObjectUUID.
//4. Go through each UUID
foreach ($all_UUID as $object => $value) {
    //SELECT
    
    //5.Get the id of the JD, PL, PR, ST, TA and return it
    $sqlsel1 = "SELECT * FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID WHERE UUID=$value";
    $rs1 = $conn->query($sqlsel1);
    if ($rs1 === false) {
        trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
    } else {
        if (mysqli_num_rows($rs1) > 0) {
            
            //6. Select all of the information from the appropriate job description
            while ($items = $rs1->fetch_assoc()) {
                $positionId = stripslashes($items['position_id']);
                $jobDescriptionId = stripslashes($items['jobDescription_id']);
                $policyId = stripslashes($items['policy_id']);
                $procedureId = stripslashes($items['procedure_id']);
                $stepId = stripslashes($items['step_id']);
                $taskId = stripslashes($items['task_id']);
                
                if ($positionId >= 1) {
                    $sqlsel2 = "SELECT * FROM ubm_model_positions WHERE id=$positionId";
                    $rs2 = $conn->query($sqlsel2);
                    if ($rs2 === false) {
                        trigger_error('Wrong SQL: ' . $sqlsel2 . ' Error: ' . $conn->error, E_USER_ERROR);
                    } else {
                        while ($items2 = $rs2->fetch_assoc()) {
                             $psTitle = $items2['title'];
                             $psDescription = $items2['description'];
                             $psFullOrPartTime = $items2['full_or_part_time'];
                             $psPayType = $items2['pay_type'];
                             $psPayRangeLow = $items2['pay_range_low'];
                             $psPayRangeHigh = $items2['pay_range_high'];
                             $psSummary = $items2['summary'];
                             require('ubms_create_position_report.php');
                       }
                    }
                }
                $jdCounter = 1;
                if ($jobDescriptionId >= 1) {
                    $sqlsel2 = "SELECT * FROM ubm_model_jobDescriptions WHERE id=$jobDescriptionId";
                    $rs2 = $conn->query($sqlsel2);
                    if ($rs2 === false) {
                        trigger_error('Wrong SQL: ' . $sqlsel2 . ' Error: ' . $conn->error, E_USER_ERROR);
                    } else {
                        while ($items2 = $rs2->fetch_assoc()) {
                             $jdTitle = $items2['title'];
                             $jdObjective = $items2['objective'];
                             $jdEssentialDutiesAndResponsibilities = $items2['essential_duties_and_responsibilities'];
                             $jdAgeRequirement = $items2['age_requirement'];
                             $jdEducationRequirements = $items2['education_requirements'];
                             $jdQualifications = $items2['qualifications'];
                             $jdPhysicalDemand = $items2['physical_demand'];
                             $jdWorkEnvironment = $items2['work_environment'];
                             require('ubms_create_jobDescription_report.php');
                        $jdCounter = $jdCounter + 1;                             
                       }
                    }
                }
                
                if ($policyId >= 1) {
                    $sqlsel2 = "SELECT * FROM ubm_model_policies WHERE id=$policyId";
                    $rs2 = $conn->query($sqlsel2);
                    if ($rs2 === false) {
                        trigger_error('Wrong SQL: ' . $sqlsel2 . ' Error: ' . $conn->error, E_USER_ERROR);
                    } else {
                        while ($items2 = $rs2->fetch_assoc()) {
                             $plTitle = $items2['title'];
                             $plDescription = $items2['description'];
                             $plPurpose = $items2['purpose'];
                             $plScope = $items2['scope'];
                             $plPolicyType = $items2['policy_type'];
                             require('ubms_create_policy_report.php');
                        }
                    }
                }
                
                if ($procedureId >= 1) {
                    $sqlsel2 = "SELECT * FROM ubm_model_procedures WHERE id=$procedureId";
                    $rs2 = $conn->query($sqlsel2);
                    if ($rs2 === false) {
                        trigger_error('Wrong SQL: ' . $sqlsel2 . ' Error: ' . $conn->error, E_USER_ERROR);
                    } else {
                        while ($items2 = $rs2->fetch_assoc()) {
                             $prTitle = $items2['title'];
                             $prPurpose = $items2['purpose'];
                             $prScope = $items2['scope'];
                             //$prMinimumSecurityRequirements = $items2['minimum_security_requiements'];
                             require('ubms_create_procedure_report.php');
                        }
                    }
                }
                
                if ($stepId >= 1) {
                    $sqlsel2 = "SELECT * FROM ubm_model_procedures WHERE id=$stepId";
                    $rs2 = $conn->query($sqlsel2);
                    if ($rs2 === false) {
                        trigger_error('Wrong SQL: ' . $sqlsel2 . ' Error: ' . $conn->error, E_USER_ERROR);
                    } else {
                        while ($items2 = $rs2->fetch_assoc()) {
                             // $title = $items2['title'];
                             // $objective = $items2['objective'];
                             // $essentialDutiesAndResponsibilities = $items2['essential_duties_and_responsibilities'];
                             // $ageRequirement = $items2['age_requirement'];
                             // $educationRequirements = $items2['education_requirements'];
                             // $qualifications = $items2['qualifications'];
                             // $physicalDemand = $items2['physical_demand'];
                             // $workEnvironment = $items2['work_environment'];
                             // require('ubms_create_jobDescription_report.php');
                        }
                    }
                }
                
                if ($taskId >= 1) {
                    $sqlsel2 = "SELECT * FROM ubm_model_procedures WHERE id=$taskId";
                    $rs2 = $conn->query($sqlsel2);
                    if ($rs2 === false) {
                        trigger_error('Wrong SQL: ' . $sqlsel2 . ' Error: ' . $conn->error, E_USER_ERROR);
                    } else {
                        while ($items2 = $rs2->fetch_assoc()) {
                             // $title = $items2['title'];
                             // $objective = $items2['objective'];
                             // $essentialDutiesAndResponsibilities = $items2['essential_duties_and_responsibilities'];
                             // $ageRequirement = $items2['age_requirement'];
                             // $educationRequirements = $items2['education_requirements'];
                             // $qualifications = $items2['qualifications'];
                             // $physicalDemand = $items2['physical_demand'];
                             // $workEnvironment = $items2['work_environment'];
                             // require('ubms_create_jobDescription_report.php');
                        }
                    }
                }
            }
                    
        } else {
        }
    }
}

// add a new page for TOC
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
$pdf->addTOC(2, 'courier', '.', 'INDEX', 'B', array(128,0,0));

// end of TOC page
$pdf->endTOCPage();


$pdf->Output('businessModel.pdf', 'I');
