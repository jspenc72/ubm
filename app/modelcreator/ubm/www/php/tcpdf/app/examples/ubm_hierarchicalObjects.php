<?php
require_once ('../config/tcpdf_config.php');
require_once ('../tcpdf.php');
include ('../../../DBConnect_UBMv1.php');
//Provides the variables used for UBMv1 database connection $conn
require_once ('../../../globalGetVariables.php');
$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator('Adam Gustafson');
$pdf->SetAuthor('Adam Gustafson');
$pdf->SetTitle('Position Objects');
$pdf->SetSubject('');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
// set auto page breaks
$pdf->SetMargins(PDF_MARGIN_LEFT, 15, PDF_MARGIN_RIGHT);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);
// set font
$pdf->SetFont('times', '', 10);
foreach ($positionUUID as $key => $UUID) {
    # code...
}
    if ($conn->connect_error) {
        trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
    }
    $v2 = "'" . $conn->real_escape_string($activeObjectUUID) . "'";
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    //SELECT
    //1. Select all records with ancestor equal to the activeObjectUUID
    $sqlsel1 = "SELECT c.descendant_id, c.ancestor_id, c.path_length FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID u
                    JOIN ubm_modelcreationsuite_heirarchy_object_closureTable c
                    ON (u.UUID=c.descendant_id)
                    WHERE c.ancestor_id=$v2
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
            if ($rs1 === false) {
                trigger_error('Wrong SQL: ' . $sqlsel2 . ' Error: ' . $conn->error, E_USER_ERROR);
            } else {
                
                //3. Get all the UUID's from the returned array
                while ($items2 = $rs2->fetch_assoc()) {
                    $all_UUID[] = stripslashes($items2['UUID']);
                }
            }
        }
    }

// $all_UUID array is a list of all the UUID's that were attatched to the given activeObjectUUID.
//4. Go through each UUID
foreach ($all_UUID as $object => $value) {
    //SELECT
    $all_items = array();
    
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

                            $sqlsel3 = "SELECT * FROM ubm_modelcreationsuite_heirarchy_object_closureTable WHERE ancestor_id=$value AND path_length=1";
                            $rs3 = $conn->query($sqlsel3);

                            if ($rs3 === false) {
                                trigger_error('Wrong SQL: ' . $sqlsel3 . ' Error: ' . $conn->error, E_USER_ERROR);
                            } else {
                                while ($items3 = $rs3->fetch_assoc()) {
                                    $returnedDescendantId = stripslashes($items3['descendant_id']);

                                    $sqlsel4 = "SELECT * FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID
                                    JOIN ubm_model_steps
                                    ON ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.step_id=ubm_model_steps.id
                                    WHERE ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.UUID=$returnedDescendantId";
                                    $rs4 = $conn->query($sqlsel4);
                                    if ($rs4 === false) {
                                        trigger_error('Wrong SQL: ' . $sqlsel4 . ' Error: ' . $conn->error, E_USER_ERROR);
                                    } else {
                                        //3. Get all the UUID's from the returned array
                                        while ($items4 = $rs4->fetch_assoc()) {
                                            $stTitle = $items4['title'];
                                            $stInstruction = $items4['instruction'];

                                            $sqlsel5 = "SELECT * FROM ubm_modelcreationsuite_heirarchy_object_closureTable WHERE ancestor_id=$value AND path_length=2";
                                            $rs5 = $conn->query($sqlsel5);

                                            if ($rs5 === false) {
                                                trigger_error('Wrong SQL: ' . $sqlsel3 . ' Error: ' . $conn->error, E_USER_ERROR);
                                            } else {
                                                while ($items5 = $rs5->fetch_assoc()) {
                                                    $returnedDescendantId = stripslashes($items5['descendant_id']);

                                                    $sqlsel6 = "SELECT * FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID
                                                    JOIN ubm_model_tasks
                                                    ON ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.task_id=ubm_model_tasks.id
                                                    WHERE ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.UUID=$returnedDescendantId";
                                                    $rs6 = $conn->query($sqlsel6);
                                                    if ($rs6 === false) {
                                                        trigger_error('Wrong SQL: ' . $sqlsel6 . ' Error: ' . $conn->error, E_USER_ERROR);
                                                    } else {
                                                        
                                                        while ($items6 = $rs6->fetch_assoc()) {
                                                            $tkTitle = $items6['title'];
                                                            $tkInstruction = $items6['instruction'];
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                            require('ubms_create_procedure_report.php');
                        }
                    }
                }
                
            }
                    
        } else {

        }
    }
}
$pdf->Output('PositionHierarchy.pdf', 'I');
