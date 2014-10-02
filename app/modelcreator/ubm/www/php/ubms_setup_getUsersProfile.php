<?
require_once ('globalGetVariables.php');
require_once ('ubms_db_config.php');
require_once ('DBConnect_UBMv1.php');
function getUsersProfile($username, $DBServer, $DBUser, $DBPass, $DBName){
	$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
	// check connection
	if ($conn->connect_error) {
	    trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
	}
	$profile_items = array();
	//1. SELECT the current users information from the members table.
	$sqlsel0 = "SELECT username, first_name, last_name, email, phone_number, wireless_carrier, bio, employer, user_email_preference, user_sms_preference FROM members WHERE username='$username'";
	$rs0 = $conn->query($sqlsel0);
	if ($rs0 === false) {
	    trigger_error('Wrong SQL: ' . $sqlsel0 . ' Error: ' . $conn->error, E_USER_ERROR);
	} else {
	    while ($items = $rs0->fetch_assoc()) {
	        $profile_items[] = $items;
	    }
	}
	//2. Select all records in the ubm_model_positions table that have an instance created in the ubm_model_has_positions table.
	$sqlsel1 = "SELECT * FROM ubm_model 
							JOIN ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID
								ON ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID.model_id=ubm_model.id
							WHERE creator_id='$username' AND Soft_DELETE!='TRUE'";
	$rs1 = $conn->query($sqlsel1);
	if ($rs1 === false) {
	    trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
	} else {
	    $profile_items[0]['num_models_created'] = mysqli_num_rows($rs1);
	}
	//3. Select all records in the ubm_model_positions table that have an instance created in the ubm_model_has_positions table.
	$sqlsel2 = "SELECT mhm.model_UUID, u.UUID, u.model_id, m.* FROM ubm_model_has_members mhm
	                        JOIN ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID u
	                            ON u.UUID=mhm.model_UUID
	                        JOIN ubm_model m
	                            ON u.model_id=m.id
	                        WHERE m.Soft_DELETE!='TRUE' AND mhm.member_id='$username'";
	$rs2 = $conn->query($sqlsel2);
	if ($rs2 === false) {
	    trigger_error('Wrong SQL: ' . $sqlsel2 . ' Error: ' . $conn->error, E_USER_ERROR);
	} else {
	    $profile_items[0]['num_shared_models'] = mysqli_num_rows($rs2);
	}
	//4. Select all objects created by the current user
	$sqlsel3 = "SELECT ps.id
	            FROM ubm_model_positions ps
	            WHERE ps.created_by='$username'
	            ";
	$rs3 = $conn->query($sqlsel3);
	if ($rs3 === false) {
	    trigger_error('Wrong SQL: ' . $sqlsel3 . ' Error: ' . $conn->error, E_USER_ERROR);
	} else {
	    $numCreatedPositions = mysqli_num_rows($rs3);
	    $sqlsel4 = "SELECT jd.id
	                FROM ubm_model_jobDescriptions jd
	                WHERE jd.created_by='$username'
	                ";
	    $rs4 = $conn->query($sqlsel4);
	    if ($rs4 === false) {
	        trigger_error('Wrong SQL: ' . $sqlsel3 . ' Error: ' . $conn->error, E_USER_ERROR);
	    } else {
	        $numCreatedJobDescriptions = mysqli_num_rows($rs4);
	        $sqlsel5 = "SELECT pl.id
	                    FROM ubm_model_policies pl
	                    WHERE pl.created_by='$username'
	                    ";
	        $rs5 = $conn->query($sqlsel5);
	        if ($rs5 === false) {
	            trigger_error('Wrong SQL: ' . $sqlsel5 . ' Error: ' . $conn->error, E_USER_ERROR);
	        } else {
	            $numCreatedPolicies = mysqli_num_rows($rs5);
	            $sqlsel6 = "SELECT pr.id
	                        FROM ubm_model_procedures pr
	                        WHERE pr.created_by='$username'
	                        ";
	            $rs6 = $conn->query($sqlsel6);
	            if ($rs6 === false) {
	                trigger_error('Wrong SQL: ' . $sqlsel6 . ' Error: ' . $conn->error, E_USER_ERROR);
	            } else {
	                $numCreatedProcedures = mysqli_num_rows($rs6);
	                $sqlsel7 = "SELECT st.id
	                            FROM ubm_model_steps st
	                            WHERE st.created_by='$username'
	                            ";
	                $rs7 = $conn->query($sqlsel7);
	                if ($rs7 === false) {
	                    trigger_error('Wrong SQL: ' . $sqlsel7 . ' Error: ' . $conn->error, E_USER_ERROR);
	                } else {
	                    $numCreatedSteps = mysqli_num_rows($rs7);
	                    $sqlsel8 = "SELECT tk.id
	                                FROM ubm_model_tasks tk
	                                WHERE tk.created_by='$username'
	                                ";
	                    $rs8 = $conn->query($sqlsel8);
	                    if ($rs8 === false) {
	                        trigger_error('Wrong SQL: ' . $sqlsel8 . ' Error: ' . $conn->error, E_USER_ERROR);
	                    } else {
	                        $numCreatedTasks = mysqli_num_rows($rs8);
	                    }
	                }
	            }  
	        }  
	    }    
	    $profile_items[0]['num_created_model_hierarchical_objects'] = $numCreatedPositions + $numCreatedJobDescriptions + $numCreatedPolicies + $numCreatedProcedures + $numCreatedSteps + $numCreatedTasks;
	    $profile_items[0]['num_created_positions'] = $numCreatedPositions;
	    $profile_items[0]['num_created_jobdescriptions'] = $numCreatedJobDescriptions;
	    $profile_items[0]['num_created_policies'] = $numCreatedPolicies;
	    $profile_items[0]['num_created_procedures'] = $numCreatedProcedures;
	    $profile_items[0]['num_created_steps'] = $numCreatedSteps;
	    $profile_items[0]['num_created_tasks'] = $numCreatedTasks;
	}	
	return $profile_items;
}