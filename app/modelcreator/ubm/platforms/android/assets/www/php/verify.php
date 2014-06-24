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

//UPDATE
$sql = "UPDATE members SET email_activation_status='1' WHERE activation_code='$hash'";
if ($conn->query($sql) === false) {
    trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
} else if ($affected_rows = $conn->affected_rows > 0) {
    
    echo "Your account has been successfully activated!";
?>
		<p>Please click <a href="http://www.universalbusinessmodel.com/dev">here</a> to log in!</p>
		<?php
} else {
    echo "Verification Failed.";
}

