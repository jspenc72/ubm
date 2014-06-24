<?php

//Send Email Message
$to = "jspenc72@gmail.com";
$subject = "Test mail";
$message = "Hello! This is a simple email message.";
$from = "someonelse@gmail.com";
$headers = "From:" . $from;
mail($to,$subject,$message,$headers);
echo "Mail Sent.";
?>