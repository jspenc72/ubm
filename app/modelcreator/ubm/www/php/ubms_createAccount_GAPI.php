<?php
require_once ('globalGetVariables.php');
require_once ('ubms_db_config.php');
require_once ('DBConnect_UBMv1.php');
 //Provides the variables used for UBMv1 database connection $conn
$displayNameGAPI = $_GET['displayNameGAPI'];
$emailGAPI = $_GET['emailGAPI'];
$hash = md5(rand(0, 1000));
function getRandomString($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string = '';
    for ($i = 0; $i < $length; $i++) {
        $string.= $characters[mt_rand(0, strlen($characters) - 1) ];
    }
    return $string;
}
$password = getRandomString();
$securePassword = md5($password);
$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);

// check connection
if ($conn->connect_error) {
    trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
}

//1. Parse email to generate the username.

$emailParts = explode('@', $emailGAPI);
$username = $emailParts[0];
$domain = "@" . $emailParts[1];
 // Stick the @ back onto the domain since it was chopped off.
//2. Parse Display name to get users first and last name.
$displayNameGAPIParts = explode(' ', $displayNameGAPI);
$firstName = $displayNameGAPIParts[0];
$lastName = $displayNameGAPIParts[1];

//3. Check to see if the an account already exists with that email.

$v5 = "'" . $conn->real_escape_string($displayNameGAPI) . "'";
$v6 = "'" . $conn->real_escape_string($emailGAPI) . "'";
 //email from Google API
$v7 = "'" . $conn->real_escape_string($username) . "'";
 //Username parsed from Google API
$v8 = "'" . $conn->real_escape_string($domain) . "'";
 //User signed up with
$v9 = "'" . $conn->real_escape_string($firstName) . "'";
 //First Name from Google API
$v10 = "'" . $conn->real_escape_string($lastName) . "'";
 //Last Name from Google API

$sqlsel = "SELECT * FROM members WHERE email=$v6";
 //Check to see if the risk has already been added to the existing alternative.
$rs = $conn->query($sqlsel);
if ($rs === false) {
    trigger_error('Wrong SQL: ' . $sqlsel . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
    $rows_returned = $rs->num_rows;
    if ($rows_returned > 0) {
        
        //4.a If user already exists - user with this email already exists, respond accordingly.
        echo $_GET['callback'] . '(' . "{
				'message' : 'There is already an account with this email. you have been logged in.',
				'activeUserEmail' : $v5,
				'activeUserName' : $v7
			}" . ')';
    } else {
        
        //4.b If user exists - user with this email doesnt exist yet, respond accoundingly..
        $sqlins = "INSERT INTO members (display_name, email, username, password, first_name, last_name, activation_code, email_activation_status)
						VALUES ('$displayNameGAPI', '$emailGAPI', '$username', '$securePassword', $v9, $v10, '$hash', '0')";
        if (!$conn->query($sqlins)) {
            $theError = $conn->error;
            echo $_GET['callback'] . '(' . "{'message' : 'Unable to Process your request: $theError'}" . ')';
        } else {
            $last_inserted_id = $conn->insert_id;
            
            //$affected_rows = $conn -> affected_rows;
            echo $_GET['callback'] . '(' . "{'message' : 'The userID was: $last_inserted_id, the received display name and email $displayNameGAPI and $emailGAPI'}" . ')';
            
            $to = $emailGAPI;
             // Send email to our user
            $subject = 'Please Verify Your Account';
             // Give the email a subject
            $message = '
			 
			Your account has been created, you can login with the following credentials after you have activated your account by clicking on the url below.
			 
			------------------------
			Username: ' . $v7 . '
			Password: ' . $password . '
			------------------------
			 
			Please click this link to activate your account:
			http://api.universalbusinessmodel.com/verify.php?callback=?&email=' . $emailGAPI . '&activationCode=' . $hash . '

			';
            
            $headers = 'From:notify@universalbusinessmodel.com' . "\r\n";
             // Set from headers
            mail($to, $subject, $message, $headers);
             // Send our email
            
            
        }
    }
}

