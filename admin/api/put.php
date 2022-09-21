<?php
/*
 +=============================================================================
 | 
 | 회원 목록
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.07.17
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$path = "/var/www/admin/www/images/product/";
$img_url = $_POST['img_url'];

$url_array = array();
if ($img_url != null) {
	$url_array = explode("\n",$img_url);
}

if (count($url_array) > 0) {
	for ($i=0; $i<count($url_array); $i++) {
		$file_url = $url_array[$i];
		print_r($file_url);
		$ext = strtolower(pathinfo($file_url, PATHINFO_EXTENSION));
		$file_name = "img_product_TEST_".$i.".".$ext;
		print_r($file_name);
		$upload_file = file_up_url($file_url,$file_name,$path);
	}
}
?>