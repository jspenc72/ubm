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
$query = "SELECT * FROM members WHERE username='$username'";
$result = mysqli_query($conn, $query);
if (!$result) {
     //there is a problem with the table
    echo "error1";
}
while ($row = $result->fetch_assoc()) {
    $role = stripslashes($row['account_type']);
    $firstName = stripslashes($row['first_name']);
    $lastName = stripslashes($row['last_name']);
}
$name = "$firstName" . " $lastName";

if ($role == 'admin') $query2 = "SELECT * FROM ubm_mcs_app_openitems` WHERE status='open' AND assigned_to='$name'";
$result2 = mysqli_query($conn, $query2);
if (!$result2) {
     //there is a problem with the table
    echo "error2";
}
$all_items = array();
while ($items = $result2->fetch_assoc()) {
    $all_items[] = $items;
}
echo $_GET['callback'] . '(' . json_encode($all_items) . ')';
} else {
    $query2 = "SELECT * FROM ubm_mcs_app_openitems WHERE status='open' AND opened_by='$username'";
    $result2 = mysqli_query($conn, $query2);
    if (!$result2) {
         //there is a problem with the table
        echo "error3";
    }
    $all_items = array();
    while ($items = $result2->fetch_assoc()) {
        $all_items[] = $items;
    }
    echo $_GET['callback'] . '(' . json_encode($all_items) . ')';
}
