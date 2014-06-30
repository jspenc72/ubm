<?php
require_once ('globalGetVariables.php');
require_once ('ubms_db_config.php');
require_once ('DBConnect_UBMv1.php');
 //Provides the variables used for UBMv1 database connection $conn

$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);

// check connection
if ($conn->connect_error) {
    trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
}

//INSERT
$v2 = "'" . $conn->real_escape_string($date) . "'";
$v3 = "'" . $conn->real_escape_string($approvedBy) . "'";
$v4 = "'" . $conn->real_escape_string($entityId) . "'";
$v5 = "'" . $conn->real_escape_string($companyCode) . "'";
$v6 = "'" . $conn->real_escape_string($businessName) . "'";
$v7 = "'" . $conn->real_escape_string($primaryAddress) . "'";
$v8 = "'" . $conn->real_escape_string($secondaryAddress) . "'";
$v9 = "'" . $conn->real_escape_string($city) . "'";
$v10 = "'" . $conn->real_escape_string($state) . "'";
$v11 = "'" . $conn->real_escape_string($zip) . "'";
$v12 = "'" . $conn->real_escape_string($phoneNumber) . "'";
$v13 = "'" . $conn->real_escape_string($companyType) . "'";
$v14 = "'" . $conn->real_escape_string($federalIdNumber) . "'";
$v15 = "'" . $conn->real_escape_string($requestedBy) . "'";
$v16 = "'" . $conn->real_escape_string($setUpBy) . "'";
$v17 = "'" . $conn->real_escape_string($ccodeMaster) . "'";
$v18 = "'" . $conn->real_escape_string($stewardOfRecord) . "'";
$v19 = "'" . $conn->real_escape_string($responsibleParty) . "'";
$v20 = "'" . $conn->real_escape_string($databaseName) . "'";
$v21 = "'" . $conn->real_escape_string($gender) . "'";
$v22 = "'" . $conn->real_escape_string($taxCompany) . "'";
$v23 = "'" . $conn->real_escape_string($commitmentGroup) . "'";
$v24 = "'" . $conn->real_escape_string($spendingLimit) . "'";
$v25 = "'" . $conn->real_escape_string($taxGroup) . "'";
$v26 = "'" . $conn->real_escape_string($apServiceCenter) . "'";
$v27 = "'" . $conn->real_escape_string($arServiceCenter) . "'";
$v28 = "'" . $conn->real_escape_string($frServiceCenter) . "'";
$v29 = "'" . $conn->real_escape_string($prServiceCenter) . "'";
$v30 = "'" . $conn->real_escape_string($description) . "'";
$v31 = "'" . $conn->real_escape_string($activeModelUUID) . "'";
$v32 = "'" . $conn->real_escape_string($username) . "'";

$sqlins = "INSERT INTO new_business_account_form (date, approved_by, entity_id, company_code, business_name, primary_address, secondary_address, city, state, zip, phone_number, company_type, federal_id_number, requested_by, set_up_by, ccdoe_master, steward_of_record, responsible_party, database_name, gender, tax_company, 145_commitment_group, spending_limit, tax_group, ap_service_center, ar_service_center, fr_servic_center, pr_service_center, description, model_UUID, created_by ) VALUES ( $v2, $v3, $v4, $v5, $v6, $v7, $v8, $v9, $v10, $v11, $v12, $v13, $v14, $v15, $v16, $v17, $v18, $v19, $v20, $v21, $v22, $v23, $v24, $v25, $v26, $v27, $v28, $v29, $v30, $v31, $v32)";
if ($conn->query($sqlins) === false) {
    trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
    echo $_GET['callback'] . '(' . "{'message' : 'Form submitted successfully. Attached to model UUID : $activeModelUUID'}" . ')';
}

