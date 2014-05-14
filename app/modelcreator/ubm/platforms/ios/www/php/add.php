 <?php 
 
 //This is the directory where images will be saved 
 $target = "images/"; 
 $target = $target . basename( $_FILES['photo']['name']); 
 
 //This gets all the other information from the form 
 $name=$_POST['name']; 
 $email=$_POST['email']; 
 $phone=$_POST['phone']; 
 $pic=($_FILES['photo']['name']); 
 
 // Connects to your Database 
 mysql_connect("localhost","jessespe","Xfn73Xm0") or die(mysql_error()) ; 
 mysql_select_db("jessespe_FindMyDriver") or die(mysql_error()) ; 
 
 //Writes the information to the database 
 mysql_query("INSERT INTO `employees` (name, email, phone, photo) VALUES ('$name', '$email', '$phone', '$pic')") ; 
 
 //Writes the photo to the server 
 if(move_uploaded_file($_FILES['photo']['tmp_name'], $target)) 
 { 
 
 //Tells you if its all ok 
 echo "The file ". basename( $_FILES['uploadedfile']['name']). " has been uploaded, and your information has been added to the directory"; 
 } 
 else { 
 
 //Gives an error if its not 
 echo "Sorry, there was a problem uploading your file."; 
 } 
 ?> 