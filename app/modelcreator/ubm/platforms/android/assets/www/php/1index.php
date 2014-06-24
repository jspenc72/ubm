 <?php
 $aname = $_GET['appname'];
 $RQType = $_GET['RQType'];
 $usrname = $_GET['username'];
 $usrpasswd = $_GET['password']; 
      if($aname!=='FindMyDriver')
      {
    		echo $_GET['callback'] . '(' . "{'message' : 'Initializing...'}" . ')';      		
	  }   	
	      	else{
		      	if($RQType=='testConnection'){ 									//Check the form submit type
					$con=mysqli_connect("localhost","root","Xfn73Xm0","FindMyDriver"); 	//Define db Connection
					if (mysqli_connect_errno($con)) 									// Check connection
					  {
					  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
					  }
						mysqli_query($con,"INSERT INTO members (username, password)
						VALUES ('$usrname', '$usrpasswd')");
					mysqli_close($con);
			         echo $_GET['callback'] . '(' . "{'message' : 'DB query successful, Connection is Working'}" . ')';
		      	}	
	      	}	
      if($aname!=='FindMyDriver')
      {
         echo $_GET['callback'] . '(' . "{'message' : 'You are using an invalid key, or the Server connection is not working!'}" . ')';
      }
?>
