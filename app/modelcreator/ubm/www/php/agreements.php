<?php
require_once ('globalGetVariables.php');
require_once ('ubms_db_config.php');
require_once ('DBConnect_UBMv1.php');

$conn = new mysqli("localhost", "jessespe", "Xfn73Xm0", "jessespe_FindMyDriver");
$conn2 = new mysqli($DBServer, $DBUser, $DBPass, $DBName);

// check connection
if ($conn->connect_error) {
    trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
}

$query = "SELECT * FROM `members` WHERE username='$username'";
$result = mysqli_query($conn, $query);
if (!$result) {
    echo "error 1";
}
while ($row = $result->fetch_assoc()) {
    $memberId = stripslashes($row['id']);
}

if ($licenseAgreementSetup) {
    $sqlsel = "SELECT * FROM 'agreements' WHERE model_UUID='$activeModelUUID'";
    $rs =$conn2->query($sqlsel);
    if (!$rs) {
        echo "error 2";
    } else {
        $rows_returned = $rs->num_rows;
        if ($rows_returned > 0) {
            $sqlupdate = "UPDATE `agreements` SET license_agreement_setup='$licenseAgreementSetup' WHERE model_UUID='$activeModelUUID'";
            if ($conn2->query($sqlupdate) === false) {
                echo "error";
            } else {
                $affected_rows = $conn2->affected_rows;
                echo $_GET['callback'] . '(' . "{'message' : 'The number of affected rows is $affected_rows. You have agreed to license agreement setup $licenseAgreementSetup.'}" . ')';
            }
        } else {
            $sqlins = "INSERT INTO agreements (member_id, model_UUID, license_agreement_setup) VALUES ($memberId, $activeModelUUID, $licenseAgreementSetup)";
            if ($conn2->query($sqlins) === false) {
                echo "error";
            } else {
                echo $_GET['callback'] . '(' . "{'message' : 'You have agreed to license agreement setup $licenseAgreementSetup'}" . ')';
            }
        }
    }
}

if ($termsOfService) {
    $sqlsel = "SELECT * FROM 'agreements' WHERE member_id='$memberId'";
    $rs = mysqli_query($conn2, $sqlsel);
    if (!$rs) {
        echo "error 3";
    } else {
        $rows_returned = $rs->num_rows;
        if ($rows_returned > 0) {
            $sqlupdate = "UPDATE `agreements` SET terms_of_service='$termsOfService' WHERE member_id='$memberId'";
            if ($conn2->query($sqlupdate) === false) {
                echo "error 4";
            } else {
                $affected_rows = $conn2->affected_rows;
                echo $_GET['callback'] . '(' . "{'message' : 'The number of affected rows is $affected_rows. You have agreed to license agreement setup $termsOfService.'}" . ')';
            }
        } else {
            $sqlins = "INSERT INTO agreements (member_id, model_UUID, license_agreement_setup) VALUES ($memberId, $activeModelUUID, $termsOfService)";
            if ($conn2->query($sqlins) === false) {
                echo "error 5";
            } else {
                echo $_GET['callback'] . '(' . "{'message' : 'You have agreed to license agreement setup $termsOfService'}" . ')';
            }
        }
    }
}

if ($licenseAgreementSignIn) {
    $sqlsel = "SELECT * FROM 'agreements' WHERE member_id='$memberid'";
    $rs = mysqli_query($conn2, $sqlsel);
    if (!$rs) {
        echo "error 6";
    } else {
        $rows_returned = $rs->num_rows;
        if ($rows_returned > 0) {
            $sqlupdate = "UPDATE `agreements` SET license_agreement_sign_in='$licenseAgreementSignIn' WHERE member_id='$memberid'";
            if ($conn2->query($sqlupdate) === false) {
                echo "error 7";
            } else {
                $affected_rows = $conn2->affected_rows;
                echo $_GET['callback'] . '(' . "{'message' : 'The number of affected rows is $affected_rows. You have agreed to license agreement sign In $licenseAgreementSignIn.'}" . ')';
            }
        } else {
            $sqlins = "INSERT INTO agreements (member_id, model_UUID, license_agreement_setup) VALUES ($memberId, $activeModelUUID, $licenseAgreementSignIn)";
            if ($conn2->query($sqlins) === false) {
                echo "error 8";
            } else {
                echo $_GET['callback'] . '(' . "{'message' : 'You have agreed to license agreement sign In $licenseAgreementSignIn'}" . ')';
            }
        }
    }
}

