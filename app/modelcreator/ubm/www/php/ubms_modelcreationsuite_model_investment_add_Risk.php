 <?php
require_once('globalGetVariables.php');
require_once('ubms_db_config.php');
require_once('DBConnect_UBMv1.php');		//Provides the variables used for UBMv1 database connection $conn			
	$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
	// check connection
	if ($conn->connect_error) {
	  trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
	}
//INSERT
$v3 = "'" . $conn -> real_escape_string($activeInvestment) . "'";
$v4 = "'" . $conn -> real_escape_string($activeInvestmentRisk) . "'";
$v5 = "'" . $conn -> real_escape_string($username) . "'";

 $sqlsel="SELECT * FROM ubm_model_investment_has_risks WHERE investment_id=$v3 AND risk_id=$v4";	//Check to see if the risk has already been added to the existing investment.
 $rs=$conn->query($sqlsel);
 if($rs === false) {
 trigger_error('Wrong SQL: ' . $sqlsel . ' Error: ' . $conn->error, E_USER_ERROR);
 } else {
 	$rows_returned = $rs->num_rows;
	if($rows_returned>0){																			//If risk - investment relationship already exists, respond accordingly.
			echo $_GET['callback'] . '(' . "{'message' : 'This risk has already been added to this investment. Select another risk to continue.'}" . ')';
	}else{																							//If risk - investment relationship does not already exist, create the relationship and respond accordingly.
		$sqlins = "INSERT INTO ubm_model_investment_has_risks (investment_id, risk_id, created_by) VALUES ( $v3, $v4, $v5 )";
		if ($conn -> query($sqlins) === false) {
			trigger_error('Wrong SQL: ' . $sqlins . ' Error: ' . $conn -> error, E_USER_ERROR);
		} else {
			$affected_rows = $conn -> affected_rows;
			echo $_GET['callback'] . '(' . "{'message' : 'The number of affected rows is $affected_rows. the Investment modified was $activeInvestment.'}" . ')';
		
		}
	}
 }

