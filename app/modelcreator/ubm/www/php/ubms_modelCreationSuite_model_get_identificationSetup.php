<?php
require_once ('globalGetVariables.php');

//require_once('ubms_db_config.php');
require_once ('DBConnect_UBMv1.php');
error_reporting(E_ALL);
ini_set('display_errors', '1');
//Provides the variables used for UBMv1 database connection $conn
$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);

// check connection
if ($conn->connect_error) {
    trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
}
$v2 = "'" . $conn->real_escape_string($activeModelUUID) . "'";

//SELECT
$all_items = array();
$checked = array();
$categories = array();

$sqlsel3 = "SELECT category_name FROM ubm_model_has_categories 
                JOIN ubm_model_categories
                ON ubm_model_has_categories.category_id=ubm_model_categories.id
                WHERE ubm_model_has_categories.model_UUID = $activeModelUUID";
    $rs3 = $conn->query($sqlsel3);
    if ($rs3 === false) {
        trigger_error('Wrong SQL: ' . $sqlsel3 . ' Error: ' . $conn->error, E_USER_ERROR);
    } else {
        while ($items3 = $rs3->fetch_assoc()) {
            $checked[] = $items3;
        }
        foreach ($checked as $key => $value) {
            $checked[$key] ['checked'] = $checked[$key] ['category_name'];
            unset($checked[$key]['category_name']);
        }
        
    }

//1. Select all records for checklist items stored in model_creation_suite, Count the number of items in the checklist.
$sqlsel1 = "SELECT * FROM ubm_modelcreationsuite_identification_setup WHERE model_UUID=$v2";
$rs1 = $conn->query($sqlsel1);
if ($rs1 === false) {
    trigger_error('Wrong SQL: ' . $sqlsel1 . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
    if (mysqli_num_rows($rs1) > 0) {
        
        //2. Add the result set to the $all_items [] array
        while ($items = $rs1->fetch_assoc()) {
            $all_items[] = $items;
        }
        
        //6. JSONP packaged $all_items array
        
        //Output $all_items array in json encoded format.
        
        
    } else {
        $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='jessespe_UBMv1' AND TABLE_NAME='ubm_modelcreationsuite_identification_setup'";
        $rs1 = $conn->query($sql);
        while ($items = $rs1->fetch_assoc()) {
            $keys[] = $items['COLUMN_NAME'];
        }
        foreach ($keys as $key => $value) {
                $items[$value] = "";
            }
            $all_items[] = $items;
        
    }

    $sqlsel2 = "SELECT category_name FROM ubm_model_categories";
    $rs2 = $conn->query($sqlsel2);
    if ($rs2 === false) {
        trigger_error('Wrong SQL: ' . $sqlsel2 . ' Error: ' . $conn->error, E_USER_ERROR);
    } else {
        while ($items2 = $rs2->fetch_assoc()) {
            $categories[] = $items2;
        }
        
        foreach ($categories as $key => $value) {
            foreach ($checked as $key2 => $value2) {
                if($value['category_name'] == $value2['checked']) {
                    $categories[$key]['checked'] = $categories[$key]['category_name'];
                    unset($categories[$key]['category_name']);
                }
            }
        }
        foreach ($categories as $key => $value) {
            $all_items[] = $value;
        }
        echo $_GET['callback'] . '(' . json_encode($all_items) . ')';
    }
}


