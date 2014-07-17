<?php
require_once ('globalGetVariables.php');
require_once ('ubms_db_config.php');
require_once ('DBConnect_UBMv1.php');
error_reporting(E_ALL);
ini_set('display_errors', '1');

//Provides the variables used for UBMv1 database connection $conn
$hash = md5(rand(0, 1000));
function rand_string($length) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    return substr(str_shuffle($chars), 0, $length);
}
list($newUsername) = explode('@', $email);

$tempPass = rand_string(8);
$securePassword = md5($tempPass);
$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);

// check connection
if ($conn->connect_error) {
    trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
}

//INSERT
$v2 = "'" . $conn->real_escape_string($activePositionUUID) . "'";
$v3 = "'" . $conn->real_escape_string($positionName) . "'";
$v4 = "'" . $conn->real_escape_string($username) . "'";
$v5 = "'" . $conn->real_escape_string($email) . "'";
$v6 = "'" . $conn->real_escape_string($newUsername) . "'";

$sqlsel = "SELECT * FROM ubm_modelCreationSuite_position_has_members WHERE position_UUID=$activePositionUUID";
$rs1 = $conn->query($sqlsel);
if ($rs1 === false) {
    trigger_error('Wrong SQL: ' . $sqlsel . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
    if (mysqli_num_rows($rs1) < 1) {
        
        $sqlins = "INSERT INTO ubm_modelCreationSuite_position_has_members (position_UUID, name, created_by, email) VALUES ( $v2, $v3, $v4, $v5)";
        if ($conn->query($sqlins) === false) {
            trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn->error, E_USER_ERROR);
        } else {
        }
        $sqlsel = "SELECT position_id FROM ubm_modelcreationsuite_heirarchy_object_antiSolipsism_UUID WHERE UUID=$activePositionUUID";
        $rs1 = $conn->query($sqlsel);
        if ($rs1 === false) {
            trigger_error('Wrong SQL: ' . $sqlsel . ' Error: ' . $conn->error, E_USER_ERROR);
        } else {
            while ($items = $rs1->fetch_assoc()) {
                $returnPositionId = stripslashes($items['position_id']);
            }
            $sqlsel2 = "SELECT title FROM ubm_model_positions WHERE id=$returnPositionId";
            $rs2 = $conn->query($sqlsel2);
            if ($rs2 === false) {
                trigger_error('Wrong SQL: ' . $sqlsel2 . ' Error: ' . $conn->error, E_USER_ERROR);
            } else {
                while ($items = $rs2->fetch_assoc()) {
                    $title = stripslashes($items['title']);
                }
            }
        }
        $sqlsel3 = "SELECT email from members where email=$v5";
        $rs3 = $conn->query($sqlsel3);
        if ($rs3 === false) {
            trigger_error('Wrong SQL: ' . $sqlsel3 . ' Error: ' . $conn->error, E_USER_ERROR);
        } else {
            if (mysqli_num_rows($rs3) < 1) {
                $sqlins2 = "INSERT INTO members (username, password, email, activation_code) VALUES ($v6, '$securePassword', $email, '$hash')";
                if ($conn->query($sqlins2) === false) {
                    trigger_error('Wrong SQL: ' . $sqlins2 . ' Error: ' . $conn->error, E_USER_ERROR);
                } else {
                }
                $to = "$email";
                $subject = "$username has added you to the $title position.";
                $message = 'You have been added to the ' . $title . ' position by ' . $username . '.
        
        
        ------------------- -----
        Username: ' . $v6 . '
        Password: ' . $tempPass . '
        ------------------------
        
        
        Please click this link to activate your account:
        http://api.universalbusinessmodel.com/verify.php?callback=?&email=' . $email . '&activationCode=' . $hash . '';
                
                $from = "notify@universalbusinessmodel.com";
                $headers = "From:" . $from;
                mail($to, $subject, $message, $headers);
            } else {
                $to = "$email";
                $subject = "$username has added you to the $title position.";
                $message = "You have been added to the $title position by $username.";
                $from = "notify@universalbusinessmodel.com";
                $headers = "From:" . $from;
                mail($to, $subject, $message, $headers);
            }
            echo $_GET['callback'] . '(' . "{'message' : '$positionName has been added to position $activePositionUUID successfully!'}" . ')';
        }
    } else {
        echo $_GET['callback'] . '(' . "{'message' : 'There can only be one person per position'}" . ')';
    }
}
    