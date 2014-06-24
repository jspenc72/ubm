 <?php
 $aname = $_GET['appname'];
 $RQType = $_GET['RQType'];
 $usremail = $_GET['email'];
 $usrpasswd = $_GET['password']; 
 $usrname = $_GET['username']; 
 $licenseAgreement = $_GET['licenseAgreement']; 
 $termsOfService = $_GET['termsOfService']; 
      if($aname=='FindMyDriver')
      {
			$con=mysqli_connect("localhost","jessespe","Xfn73Xm0","jessespe_FindMyDriver"); 	//Define db Connection
			if (mysqli_connect_errno($con)) 									// Check connection
			  {
			  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
			  }
				mysqli_query($con,"INSERT INTO members (username, email, password, agree_to_license_agreement, agree_to_terms_of_service)
				VALUES ('$usrname', '$usremail', '$usrpasswd', '$licenseAgreement', '$termsOfService' )");
				mysqli_close($con);
	         	echo $_GET['callback'] . '(' . "{'message' : 'Registration successful!'}" . ')';
	  }   	

      if($aname!=='FindMyDriver')
      {
         echo $_GET['callback'] . '(' . "{'message' : 'You are using an invalid key, or the Server connection is not working!'}" . ')';
      }
