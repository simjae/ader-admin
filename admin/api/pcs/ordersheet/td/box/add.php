<?php
/*
 +=============================================================================
 | 
 | 박스 추가
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.10.12
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$box_type       	= $_POST['box_type'];
$box_name       	= $_POST['box_name'];
$box_width      	= $_POST['box_width'];
$box_length     	= $_POST['box_length'];
$box_height     	= $_POST['box_height'];
$box_volume     	= $_POST['box_volume'];

$box_cnt = $db->count("BOX_INFO BI","BI.BOX_NAME = '".$box_name."'");

$insert_box_info_sql = "
	INSERT INTO
		BOX_INFO
	(
		BOX_TYPE,
		BOX_NAME,
		BOX_WIDTH,
		BOX_LENGTH,
		BOX_HEIGHT,
		BOX_VOLUME
	) VALUE (
		'".$box_type."',
		'".$box_name."',
		".$box_width.",
		".$box_length.",
		".$box_height.", 
		".$box_volume."
	)
";

$db->query($insert_box_info_sql);

?>