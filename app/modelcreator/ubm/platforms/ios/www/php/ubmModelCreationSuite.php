 <?php
 $step_type = $_GET['step_type'];
 $instruction_detail = $_GET['instruction_detail'];
 $phase = $GET['phase'];
 $source_model_mfi_ref = $GET['source_model_mfi_ref'];
 $mfi_template_proccess_ref = $GET['mfi_template_proccess_ref'];
 $mfi_explanation_ref = $GET['mfi_explanation_ref'];
 $budgeted_hours = $GET['budgeted_hours'];
 $line_number = $GET['line_number'];
 
			$con=mysqli_connect("localhost","jessespe","Xfn73Xm0","jessespe_UBMv1"); 	//Define db Connection
			if (mysqli_connect_errno($con)) 									// Check connection
			  {
			  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
			  }
				mysqli_query($con,"INSERT INTO review_history (step_type, phase, instruction_detail, budgeted_hours, mfi_explanation_ref, mfi_template_proccess_ref, source_model_mfi_ref, line_number)
				VALUES ('$step_type', '$instruction_detail','$phase','$budgeted_hours', '$mfi_explanation_ref', '$mfi_template_proccess_ref', '$source_model_mfi_ref', '$line_number')");
				mysqli_close($con);
	         	echo $_GET['callback'] . '(' . "{'message' : 'Line submitted!'}" . ')';  	
         echo $_GET['callback'] . '(' . "{'message' : 'You are using an invalid key, or the Server connection is not working!'}" . ')';
