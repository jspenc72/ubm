<?php
require_once ('globalGetVariables.php');
require_once ('ubms_db_config.php');
require_once ('DBConnect_UBMv1.php');
error_reporting(E_ALL);
ini_set('display_errors', '1');
 //Provides the variables used for UBMv1 database connection $conn
$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);

// check connection
if ($conn->connect_error) {
    trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
}
$query = "SELECT email_activation_status FROM members WHERE username='$username'";
$result = mysqli_query($conn, $query);
if (!$result) {
     //there is a problem with the table
    
}
$all_items = array();
while ($items = $result->fetch_assoc()) {
    $all_items = $items;
}

//echo $_GET['callback'] . '(' . "{'message' : ''}" . ')';
echo $_GET['callback'] . '(' . json_encode($all_items) . ')';
