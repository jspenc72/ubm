<?php
require_once('globalGetVariables.php');
require_once('ubms_db_config.php');
require_once('DBConnect_UBMv1.php');	//Provides the variables used for UBMv1 database connection $conn

function createHierarchicalRelationship($ParentUUID, $ChildUUID, $DBServer, $DBUser, $DBPass, $DBName) {
	$toReturn = [
		"status" => FALSE,
	    "ParentUUID" => $ParentUUID,
	    "ChildId" => $ChildId,
	    "ChildObejctType" => $ChildObejctType,
	    "username" => $username,
	];	
	$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
// check connection
	if ($conn->connect_error) {
		trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
	}
	$sqlins =  "INSERT INTO ubm_modelcreationsuite_heirarchy_object_closureTable(ancestor_id, descendant_id, path_length)
				 SELECT a.ancestor_id, d.descendant_id, a.path_length+d.path_length+1
				   FROM ubm_modelcreationsuite_heirarchy_object_closureTable a, ubm_modelcreationsuite_heirarchy_object_closureTable d
				  WHERE a.descendant_id=$ParentUUID 
				  	AND d.ancestor_id=$ChildUUID";
	if ($conn -> query($sqlins) === false) {
		trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn -> error, E_USER_ERROR);
		echo "there was a problem: INSERT the links to all the ancestors of the ParentUUID into the Closure table so has a tie to all ojects above it";
	} else {
		$toReturn["status"] = TRUE;
		return $toReturn;
	}
}
function createChildUUIDwithHierarchicalRelationship($ParentUUID, $ChildId, $ChildObejctType, $username, $DBServer, $DBUser, $DBPass, $DBName){
	$toReturn = [
		"status" => FALSE,
	    "ParentUUID" => $ParentUUID,
	    "ChildId" => $ChildId,
	    "ChildObejctType" => $ChildObejctType,
	    "username" => $username,
	    "NewChildUUID" => "",
	];


	$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
//1. check connection
	if ($conn->connect_error) {
		trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
	}
	switch ($ChildObejctType) {
		case "LE":
		$sqlins2 = "INSERT INTO ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID (legal_entity_id, created_by) 
					VALUES ( $ChildId,$username )";
		break;
		case "MD":
		$sqlins2 = "INSERT INTO ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID (model_id, created_by) 
					VALUES ( $ChildId,$username )";	    
		break;
		case "PS":
		$sqlins2 = "INSERT INTO ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID (position_id, created_by) 
					VALUES ( $ChildId,$username )";		    
		break;
		case "JD":
		$sqlins2 = "INSERT INTO ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID (jobDescription_id, created_by) 
					VALUES ( $ChildId,$username )";		    
		break;
		case "PL":
		$sqlins2 = "INSERT INTO ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID (policy_id, created_by) 
					VALUES ( $ChildId,$username )";		    
		break;
		case "CLI":
		$sqlins2 = "INSERT INTO ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID (checklistItem_id, created_by) 
					VALUES ( $ChildId,$username )";		    
		break;
		case "PR":
		$sqlins2 = "INSERT INTO ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID (procedure_id, created_by) 
					VALUES ( $ChildId,$username )";		    
		break;
		case "ST":
		// echo "ST";
		$sqlins2 = "INSERT INTO ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID (step_id, created_by) 
					VALUES ( $ChildId,$username )";		    
		break;
		case "TK":
		$sqlins2 = "INSERT INTO ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID (task_id, created_by) 
					VALUES ( $ChildId,$username )";		    
		break;
		default:
			echo "Invalid Object Type was given.";
	}
//2. Create a UUID for the Object that was created.
	if ($conn -> query($sqlins2) === false) {
		trigger_error('Wrong SQL: ' . $sqlins2 . ' Error: ' . $conn -> error, E_USER_ERROR);
	} else {		
//3. Now INSERT the UUID into the Closure table so it reports to itself.
		$last_inserted_UUID = $conn -> insert_id;

		$toReturn["NewChildUUID"] = $last_inserted_UUID;
		$sqlins3 =  "INSERT INTO ubm_modelcreationsuite_heirarchy_object_closureTable(ancestor_id, descendant_id, path_length, created_by)
					 VALUES ( $last_inserted_UUID,$last_inserted_UUID,'0', $username )";
		if ($conn -> query($sqlins3) === false) {
			trigger_error('Wrong SQL: ' . $sqlins3 . ' Error: ' . $conn -> error, E_USER_ERROR);
			echo "there was a problem: INSERT the UUID into the Closure table so it reports to itself.";
		} else {
			$closure_self_link_id = $conn -> insert_id;
//4. Now INSERT the links to all the ancestors of the ParentUUID into the Closure table so has a tie to all ojects above it.			
			$sqlins3 =  "INSERT INTO ubm_modelcreationsuite_heirarchy_object_closureTable(ancestor_id, descendant_id, path_length)
						 SELECT a.ancestor_id, d.descendant_id, a.path_length+d.path_length+1
						   FROM ubm_modelcreationsuite_heirarchy_object_closureTable a, ubm_modelcreationsuite_heirarchy_object_closureTable d
						  WHERE a.descendant_id=$ParentUUID 
						  	AND d.ancestor_id=$last_inserted_UUID";
			if ($conn -> query($sqlins3) === false) {
				trigger_error('Wrong SQL: ' . $sqlins3 . ' Error: ' . $conn -> error, E_USER_ERROR);
				echo "there was a problem: INSERT the links to all the ancestors of the ParentUUID into the Closure table so has a tie to all ojects above it";
			} else {
				$toReturn["status"] = TRUE;
				return $toReturn;
			}			
		}
	}
}