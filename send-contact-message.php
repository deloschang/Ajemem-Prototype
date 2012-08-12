<?php

$to = 'feedback@memeja.com';
//$email = $_POST['email'];
//$subject = $_POST['subject'];
$body = $_POST['message'];
$name=$_POST['name'];
$headers=' <' . $email . '>';
?>

	<script type="text/javascript">
	parent.document.getElementById("message").innerHTML = "<font color='#ff0000'>Hooray! We appreciate your thoughts at Memeja! Thanks for submitting </font>";
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