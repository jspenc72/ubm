<?php
	$file_result = "";
	if($_FILES["file"]["error"]>0){ //if $_FILES["file"]["error"]==0 file uploaded correctly, if > 0 theres an error.
		$file_result .= "No File Uploaded or Invalid File";
		echo "No File Uploaded or Invalid File";
		$file_result .= "Error Code: " . $_FILES["file"]["error"] . "<br>";
		echo "Error Code: " . $_FILES["file"]["error"] . "<br>";
	} else{
		echo $_FILES["file"]["name"];
		echo "<br>";
		echo $_FILES["file"]["type"];
		echo "<br>";
		echo $_FILES["file"]["size"];
		echo "<br>";
		echo $_FILES["file"]["tmp_name"];
		echo "<br>";
		$file_result .=
		"Upload: " . $_FILES["file"]["name"] . "<br>" .
		"Type: " . $_FILES["file"]["type"] . "<br>" .
		"Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br>" .
		"Temp file: " . $_FILES["file"]["tmp_name"] . "<br>" .
		move_uploaded_file($_FILES["file"]["name"], "~/");		
		$file_result .= "File Upload Successful!";
		
	}
?>