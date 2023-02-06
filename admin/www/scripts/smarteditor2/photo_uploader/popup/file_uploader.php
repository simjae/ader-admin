<?php
include '/var/www/_static/autoload.php';

// default redirection
$url = $_REQUEST["callback"].'?callback_func='.$_REQUEST["callback_func"];
$bSuccessUpload = is_uploaded_file($_FILES['Filedata']['tmp_name']);

// SUCCESSFUL
if($bSuccessUpload) {
	$tmp_name = $_FILES['Filedata']['tmp_name'];
	$name = $_FILES['Filedata']['name'];
	
	$filename_ext = strtolower(array_pop(explode('.',$name)));
	//고정값
	$allow_file = array("jpg", "png", "bmp", "gif");
	
	$new_file_name = "img_smart_" . time() . "." . $filename_ext;

	if(!in_array($filename_ext, $allow_file)) {
		$url .= '&errstr='.$new_file_name;
	} else {		
		$newPath = '/var/www/admin/www/scripts/smarteditor2/upload/'.urlencode($new_file_name);
		
		@move_uploaded_file($tmp_name, $newPath);
		
		$url .= "&bNewLine=true";
		$url .= "&sFileName=".urlencode(urlencode($new_file_name));
		//$url .= "&sFileURL=".$_CONFIG['URL_UPLOAD_BOARD'].urlencode(urlencode($name));
		$url .= "&sFileURL=/scripts/smarteditor2/upload/".urlencode(urlencode($new_file_name));
	}
}
// FAILED
else {
	$url .= '&errstr=error';
}
	
header('Location: '. $url);
?>