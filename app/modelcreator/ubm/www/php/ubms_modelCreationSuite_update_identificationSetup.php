 <?php
require_once ('globalGetVariables.php');
require_once ('ubms_db_config.php');
require_once ('DBConnect_UBMv1.php');

//Provides the variables used for UBMv1 database connection $conn
$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
error_reporting(E_ALL);
ini_set('display_errors', '1');

// check connection
if ($conn->connect_error) {
    trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
}

//UPDATE
$objectArray['created_by'] = $username;
$objectArray['model_UUID'] = $activeModelUUID;
$escapedValues = array();
foreach ($objectArray as $key => $value) {
    $escapedValues[] = "'" . $conn->real_escape_string($value) . "'";
}

$modelUUID = "SELECT model_UUID FROM ubm_modelcreationsuite_identification_setup WHERE model_UUID=$activeModelUUID";
$rs2 = $conn->query($modelUUID);
if ($rs2 === false) {
    trigger_error('Wrong SQL: ' . $modelUUID . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
    while ($items2 = $rs2->fetch_assoc()) {
        $model = $items2['model_UUID'];
    }
    $rows_returned = $rs2->num_rows;
    if ($rows_returned == 1) {
        foreach ($objectArray as $column => $value) {
            $sql = "UPDATE ubm_modelcreationsuite_identification_setup SET $column='$value' WHERE model_UUID=$activeModelUUID";
            if ($conn->query($sql) === false) {
                trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
            } else {
                
                //$rowsModifedArray[] = $affected_rows = $conn->affected_rows;
                
                
            }
        }
    } elseif ($rows_returned == 0) {
        $sqlins = "INSERT INTO ubm_modelcreationsuite_identification_setup (" . implode(', ', array_keys($objectArray)) . ") VALUES (" . implode(', ', array_values($escapedValues)) . ")";
        if ($conn->query($sqlins) === false) {
            trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn->error, E_USER_ERROR);
        } else {
        }
    } else {
        echo $_GET['callback'] . '(' . "{'message' : 'You can only have one identification setup per model: please email support@universalbusinessmodel.com'}" . ')';
    }
    $delete = "DELETE FROM ubm_model_has_categories WHERE model_UUID=$activeModelUUID";
    if ($conn->query($delete) === false) {
        trigger_error('Wrong SQL: ' . $delete . ' Error: ' . $conn->error, E_USER_ERROR);
    } else {
        foreach ($checkboxArray as $key => $value) {
            $categoryId = "SELECT id FROM ubm_model_categories WHERE category_name='$key'";
            $rs3 = $conn->query($categoryId);
            if ($rs3 === false) {
                trigger_error('Wrong SQL: ' . $categoryId . ' Error: ' . $conn->error, E_USER_ERROR);
            } else {
                while ($items3 = $rs3->fetch_assoc()) {
                    $categoryId = $items3['id'];
                    $sqlins = "INSERT INTO ubm_model_has_categories (model_UUID, category_id) VALUES ($activeModelUUID, $categoryId)";
                    if ($conn->query($sqlins) === false) {
                        trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn->error, E_USER_ERROR);
                    } else {
                    }
                }
            }
        }
    }
    $sqlsel = "SELECT * FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID WHERE UUID=$activeModelUUID";
    
    //Select the category from the database
    $rs = $conn->query($sqlsel);
    if ($rs === false) {
        trigger_error('Wrong SQL: ' . $sqlsel . ' Error: ' . $conn->error, E_USER_ERROR);
    } else {
        while ($items = $rs->fetch_assoc()) {
            $returnedModelId = stripslashes($items['model_id']);
        }
        $rows_returned = $rs->num_rows;
    }
    $legal_entity = $objectArray['legal_entity'];
    $ccode = $objectArray['ccode'];
    $contact_name = $objectArray['contact_name'];
    $phone = $objectArray['phone'];
    $scope = $objectArray['scope'];
    $sql = "UPDATE `ubm_model` SET owner_legal_entity='$legal_entity', 
				owner_ccode='$ccode', 
				model_contact_name='$contact_name', 
				model_contact_phone='$phone',
				scope='$scope'  
				WHERE id='$returnedModelId'";
    if ($conn->query($sql) === false) {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
    } else {
        $affected_rows = $conn->affected_rows;
        echo $_GET['callback'] . '(' . "{'message' : 'The number of affected rows is $affected_rows, the Model Id is: $returnedModelId.'}" . ')';
    }
}
