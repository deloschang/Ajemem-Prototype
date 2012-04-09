<?php
print "jdsjsdj";exit;
if (isset($GLOBALS["HTTP_RAW_POST_DATA"])) {
print "jdsjsdj";exit;
    $imageData=$GLOBALS['HTTP_RAW_POST_DATA'];
    $filteredData=substr($imageData, strpos($imageData, ",")+1);
    $unencodedData=base64_decode($filteredData);
	$filename = "workspace/".$_REQUEST['id_user'].'_img.png';

	//if (is_writable($filename)) {
		if (!$handle = fopen($filename, 'wb')) {
		     echo "Cannot open file ($filename)";
		     exit;
		}
		if (fwrite($handle, $unencodedData) === FALSE) {
		    echo "Cannot write to file ($filename)";
		    exit;
		}
		echo "Success, wrote to file ($filename)";
		fclose($handle);
	//} else {
	//	echo "The file $filename is not writable";
	//}
}
?>
