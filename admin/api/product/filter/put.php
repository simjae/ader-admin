<?php

/*
 +=============================================================================
 | 
 |  필터 관리 - 필터 개별 수정
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

$filter_idx			= $_POST['filter_idx'];
$filter_name_kr		= $_POST['filter_name_kr'];
$filter_name_en		= $_POST['filter_name_en'];
$filter_name_cn		= $_POST['filter_name_cn'];
$rgb_color			= $_POST['rgb_color'];
$size_type			= $_POST['size_type'];
$memo				= $_POST['memo'];

if ($filter_idx != null) {
	$rgb_color_sql = "";
	if ($rgb_color != null) {
		$rgb_color_sql = " RGB_COLOR = '".$rgb_color."', ";
	}
	
	$size_type_sql = "";
	if ($size_type != null) {
		$size_type_sql = " SIZE_TYPE = '".$size_type."', ";
	}
	
	$update_filter_sql = "
		UPDATE
			PRODUCT_FILTER
		SET
			FILTER_NAME_KR = '".$filter_name_kr."',
			FILTER_NAME_EN = '".$filter_name_en."',
			FILTER_NAME_CN = '".$filter_name_cn."',
			".$rgb_color_sql."
			".$size_type_sql."
			MEMO = '".$memo."',
			UPDATE_DATE = NOW(),
			UPDATER = 'Admin'
		WHERE
			IDX = ".$filter_idx."
	";
	
	$db->query($update_filter_sql);
}

?>
