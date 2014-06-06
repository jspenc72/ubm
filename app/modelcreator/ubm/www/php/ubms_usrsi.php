 <?php
require_once ('globalGetVariables.php');

//require_once ('ubms_db_config.php');
require_once ('DBConnect_UBMv1.php');

//Provides the variables used for UBMv1 database connection $conn
$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);

// check connection
if ($conn->connect_error) {
    trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
}
$v2 = "'" . $conn->real_escape_string($username) . "'";

//Input Validation
$all_items = array();
if (!$username) {
    echo $_GET['callback'] . '(' . "{'message' : 'You must enter a username.', 'validation' : '0'}" . ')';
} else {
    if (!$usrpasswd) {
        echo $_GET['callback'] . '(' . "{'message' : 'You must enter a password.', 'validation' : '0'}" . ')';
    } else {
        
        //SELECT
        $sqlsel = "SELECT * FROM members WHERE username=$v2";
        $rs = $conn->query($sqlsel);
        if ($rs === false) {
            trigger_error('Wrong SQL: ' . $sqlsel . ' Error: ' . $conn->error, E_USER_ERROR);
        } else {
            if (mysqli_num_rows($rs) > 0) {
                while ($items = $rs->fetch_assoc()) {
                    $password = stripslashes($items['password']);
                    $passwordStatus = stripslashes($items['password_status']);
                    $activationStatus = stripslashes($items['email_activation_status']);
                    $accounttype = stripslashes($items['account_type']);
                    $termsOfService = stripslashes($items['agree_to_terms_of_service']);
                    $licenseAgreement = stripslashes($items['agree_to_license_agreement']);
                }
                if ($password != md5($usrpasswd)) {
                    echo $_GET['callback'] . '(' . "{'message' : 'No account exists with that username or password. Click Register to create your free account.', 'validation' : '0', 'Account Type' : '$accounttype'}" . ')';
                } else {
                    if ($passwordStatus != 1) {
                        echo $_GET['callback'] . '(' . "{'message' : 'You must change your password.', 'validation' : 3, 'Account Type' : '$accounttype'}" . ')';
                    } else {
                        if ($activationStatus != 1) {
                            echo $_GET['callback'] . '(' . "{'message' : 'You must verify your account.', 'validation' : 4, 'Account Type' : '$accounttype'}" . ')';
                        } else {
                            if ($termsOfService != 1) {
                                echo $_GET['callback'] . '(' . "{'message' : 'You must agree to the Terms of Service.', 'validation' : 2, 'Account Type' : '$accounttype'}" . ')';
                            } else {
                                if ($licenseAgreement != 1) {
                                    echo $_GET['callback'] . '(' . "{'message' : 'You must agree to the License Agreement.', 'validation' : 2, 'Account Type' : '$accounttype'}" . ')';
                                } else {
                                    echo $_GET['callback'] . '(' . "{'validation' : 1, 'Account Type' : '$accounttype'}" . ')';
                                }
                            }
                        }
                    }
                }
            } else {
                echo $_GET['callback'] . '(' . "{'message' : 'No account exists with that username or password. Click Register to create your free account.', 'validation' : '0'}" . ')';
            }
        }
    }
}

