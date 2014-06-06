 <?php 
 // Connects to the Database 
 mysql_connect("localhost","jessespe","Xfn73Xm0") or die(mysql_error()) ; 
 mysql_select_db("jessespe_FindMyDriver") or die(mysql_error()) ; 
 //Retrieves data from MySQL 
 $data = mysql_query("SELECT * FROM employees") or die(mysql_error()); 
 //Puts it into an array 
 while($info = mysql_fetch_array( $data )) 
 { 
 //Outputs the image and other data
 Echo "<img src=http://www.findmydriver.com/images/".$info['photo'] ."> <br>"; 
 Echo "<b>Name:</b> ".$info['name'] . "<br> "; 
 Echo "<b>Email:</b> ".$info['email'] . " <br>"; 
 Echo "<b>Phone:</b> ".$info['phone'] . " <hr>"; 
 }
 ?> 