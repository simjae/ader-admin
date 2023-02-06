<?php

/*
 +=============================================================================
 | 
 |  필터 관리 - 필터 추가
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.01.24
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$filter_type		= $_POST['filter_type'];
$filter_name_kr		= $_POST['filter_name_kr'];
$filter_name_en		= $_POST['filter_name_en'];
$filter_name_cn		= $_POST['filter_name_cn'];
$rgb_color			= $_POST['rgb_color'];
$size_type			= $_POST['size_type'];
$memo				= $_POST['memo'];

if ($filter_type != null) {
	$rgb_color_sql = array();
	if ($rgb_color != null) {
		$rgb_color_sql[0] = " RGB_COLOR, ";
		$rgb_color_sql[1] = " '".$rgb_color."', ";
	}
	
	$size_type_sql = array();
	if ($size_type != null) {
		$size_type_sql[0] = " SIZE_TYPE, ";
		$size_type_sql[1] = " '".$size_type."', ";
	}
	
	$insert_filter_sql = "
		INSERT INTO
			dev.PRODUCT_FILTER
		(
			FILTER_TYPE,
			FILTER_NAME_KR,
			FILTER_NAME_EN,
			FILTER_NAME_CN,
			".$rgb_color_sql[0]."
			".$size_type_sql[0]."
			MEMO,
			CREATER,
			UPDATER
		) VALUES (
			'".$filter_type."',
			'".$filter_name_kr."',
			'".$filter_name_en."',
			'".$filter_name_cn."',
			".$rgb_color_sql[1]."
			".$size_type_sql[1]."
			'".$memo."',
			'Admin',
			'Admin'
		)
	";
	
	$db->query($insert_filter_sql);
}

?>
