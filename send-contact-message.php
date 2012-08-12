<?php

$to = 'feedback@memeja.com';
<<<<<<< HEAD
//$email = $_POST['email'];
//$subject = $_POST['subject'];
$body = $_POST['message'];
$name=$_POST['name'];
$headers=' <' . $email . '>';
?>

	<script type="text/javascript">
	parent.document.getElementById("message").innerHTML = "<font color='#ff0000'>Hooray! We appreciate your thoughts at Memeja! Thanks for submitting </font>";
=======
$email = $_POST['email'];
$subject = $_POST['subject'];
$body = $_POST['message'];
$name=$_POST['name'];
$headers=$name . ' <' . $email . '>';
?>

	<script type="text/javascript">
	parent.document.getElementById("message").innerHTML = "<font color='#ff0000'>Thank you for submitting your suggestions! Memeja management will take them into consideration. </font>";
>>>>>>> ac274dfccb2fd612d94c0615c9eaaac8ba750f6d
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