<?php

$to = 'feedback@memeja.com';
$email = $_POST['email'];
$subject = $_POST['subject'];
$body = $_POST['message'];
$name=$_POST['name'];
$headers=$name . ' <' . $email . '>';
?>

	<script type="text/javascript">
	parent.document.getElementById("message").innerHTML = "<font color='#ff0000'>Thank you for submitting your suggestions! Memeja management will take them into consideration. </font>";
	</script>

<?php
//if (mail($to, $subject, $body, $headers)) {
	logToFile("to:".$to."; from:".$headers."; subject:".$subject."; body:".$body);

//	} else {
//	echo 'There was an error sending this email.';
//}

	
   header("Location: http://localhost/");
   
function logToFile($msg)
{
    $myFile = "c:\\xampp\\htdocs\\zanzibar.txt";
    $fh = fopen($myFile, 'a+');
    fwrite($fh, $msg."\r\n");
    fclose($fh);
}

?>