<?php
require_once ('globalGetVariables.php');
require_once ('ubms_db_config.php');
require_once ('DBConnect_UBMv1.php');
 //Provides the variables used for UBMv1 database connection $conn
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);

// check connection
if ($conn->connect_error) {
    trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
}
//INSERT
$v2 = "'" . $conn->real_escape_string($activeModelUUID) . "'";
$v3 = "'" . $conn->real_escape_string($objective) . "'";
$v4 = "'" . $conn->real_escape_string($title) . "'";
$v5 = "'" . $conn->real_escape_string($username) . "'";
$v6 = "'" . $conn->real_escape_string($dutiesAndResponsibilities) . "'";
$v7 = "'" . $conn->real_escape_string($positionId) . "'";
$v8 = "'" . $conn->real_escape_string($qualifications) . "'";
$v9 = "'" . $conn->real_escape_string($ageRequirement) . "'";
$v10 = "'" . $conn->real_escape_string($educationRequirement) . "'";
$v11 = "'" . $conn->real_escape_string($physicalDemand) . "'";
$v12 = "'" . $conn->real_escape_string($workEnvironment) . "'";

//1. Insert the jobDescription into the jobDescriptions table.
$sqlins = "INSERT INTO ubm_model_jobDescriptions (objective, title, created_by, essential_duties_and_responsibilities, qualifications, age_requirement, education_requirements, physical_demand, work_environment ) 
VALUES ( $v3, $v4, $v5, $v6, $v8, $v9, $v10, $v11, $v12)";
 //Creates a New Job Description record.
if ($conn->query($sqlins) === false) {
    trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn->error, E_USER_ERROR);
} else {    
    //2. Create a UUID for the jobDescription that was created.
    $last_inserted_JD_id = $conn->insert_id;
    //$affected_rows = $conn -> affected_rows;
    $sqlins2 = "INSERT INTO ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID (legal_entity_id, model_id, position_id, jobDescription_id, policy_id, procedure_id, step_id	, task_id, created_by) 
				VALUES ( '0','0','0',$last_inserted_JD_id,'0','0','0','0',$v5 )";
    if ($conn->query($sqlins2) === false) {
        trigger_error('Wrong SQL: ' . $sqlins2 . ' Error: ' . $conn->error, E_USER_ERROR);
    } else {
        //3. Now INSERT the JD_UUID into the Closure table so it reports to itself.
        $last_inserted_JD_UUID = $conn->insert_id;
        $sqlins3 = "INSERT INTO ubm_modelcreationsuite_heirarchy_object_closureTable(ancestor_id, descendant_id, path_length, created_by)
					 VALUES ( $last_inserted_JD_UUID, $last_inserted_JD_UUID,'0', $v5)";
        if ($conn->query($sqlins3) === false) {
            trigger_error('Wrong SQL: ' . $sqlins3 . ' Error: ' . $conn->error, E_USER_ERROR);
            echo "there was a problem";
        } else {
            //4. Now INSERT the links to all the ancestors of the JD_UUID into the Closure table so has a tie to all ojects above it.
            $sqlins3 = "INSERT INTO ubm_modelcreationsuite_heirarchy_object_closureTable(ancestor_id, descendant_id, path_length)
						 SELECT a.ancestor_id, d.descendant_id, a.path_length+d.path_length+1
						  FROM ubm_modelcreationsuite_heirarchy_object_closureTable a, ubm_modelcreationsuite_heirarchy_object_closureTable d
						  WHERE a.descendant_id=$v7 
						  AND d.ancestor_id=$last_inserted_JD_UUID";
            if ($conn->query($sqlins3) === false) {
                trigger_error('Wrong SQL: ' . $sqlins3 . ' Error: ' . $conn->error, E_USER_ERROR);
                echo "there was a problem";
            } else {
                echo $_GET['callback'] . '(' . "{'message' : 'Requested Job Description $title was created successfully and added to model id: $activeModelUUID !'}" . ')';
            }
        }
    }
}
