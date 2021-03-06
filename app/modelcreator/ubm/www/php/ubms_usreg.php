<?php
require_once ('globalGetVariables.php');
require_once ('ubms_db_config.php');
require_once ('DBConnect_UBMv1.php');

//Provides the variables used for UBMv1 database connection $conn
$hash = md5(rand(0, 1000));
$securePassword = md5($usrpasswd);
$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);

// check connection
if ($conn->connect_error) {
    trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
}
$v2 = "'" . $conn->real_escape_string($aname) . "'";
$v3 = "'" . $conn->real_escape_string($RQType) . "'";
$v4 = "'" . $conn->real_escape_string($usremail) . "'";
$v5 = "'" . $conn->real_escape_string(md5($usrpasswd)) . "'";
$v6 = "'" . $conn->real_escape_string($usrname) . "'";
$v7 = "'" . $conn->real_escape_string($licenseAgreement) . "'";
$v8 = "'" . $conn->real_escape_string($termsOfService) . "'";
$v9 = "'" . $conn->real_escape_string($hash) . "'";
$v10 = "'" . $conn->real_escape_string($securePassword) . "'";

$sqlins = "INSERT INTO members (username, email, password, agree_to_license_agreement, agree_to_terms_of_service, activation_code, email_activation_status, password_status)
                VALUES ($v6, $v4, $v10, $v7, $v8, $v9, '0', '1')";
if (!$conn->query($sqlins)) {
    $theError = $conn->error;
    echo $_GET['callback'] . '(' . "{'message' : 'Unable to Process your request: $theError'}" . ')';
} else {
    $last_inserted_id = $conn->insert_id;
    
    //$affected_rows = $conn -> affected_rows;
    
    $sqlins2 = "INSERT INTO agreements (member_id, terms_of_service, license_agreement_sign_in)
                VALUES ($last_inserted_id, '1', '1')";
    if (!$conn->query($sqlins2)) {
        $theError = $conn->error;
        echo $_GET['callback'] . '(' . "{'message' : 'Unable to Process your request: $theError'}" . ')';
    } else {
        $last_inserted_id = $conn->insert_id;
    }
    
    $sqlins3 = "INSERT INTO walkthrough (username)
                VALUES ($v6)";
    if (!$conn->query($sqlins3)) {
        $theError = $conn->error;
        echo $_GET['callback'] . '(' . "{'message' : 'Unable to Process your request: $theError'}" . ')';
    } else {
        
        echo $_GET['callback'] . '(' . "{'message' : 'Registration successful!'}" . ')';
    }
    $to = $usremail;
    
    // Send email to our user
    $subject = 'Please Verify Your Account';
    
    // Give the email a subject
    $message = '
 
Your account has been created, you can login with the following credentials after you have activated your account by clicking on the url below.
 
------------------------
Username: ' . $usrname . '
Password: ' . $usrpasswd . '
------------------------
 
Please click this link to activate your account:
http://api.universalbusinessmodel.com/verify.php?callback=?&email=' . $usremail . '&activationCode=' . $hash . '&key=YDoS20lf7Vrnr22h8Ma6NGUV5DblnVhueTPXS7gPynRvQ6U8optzfnMDs3UD
';
    
    $headers = 'From:notify@universalbusinessmodel.com' . "\r\n";
    
    // Set from headers
    mail($to, $subject, $message, $headers);
    
    // Send our email
    
    
}

