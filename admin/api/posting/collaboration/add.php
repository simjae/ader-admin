<?php
/*
 +=============================================================================
 | 
 | 전시정보 등록 - 콜라보레이션 전시정보 등록
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.12.05
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$page_idx			= $_POST['page_idx'];
$posting_status		= $_POST['posting_status'];
$display_num		= $_POST['display_num'];
$bookmark_flg		= $_POST['bookmark_flg'];
$product_list_flg	= $_POST['product_list_flg'];
$product_link_flg	= $_POST['product_link_flg'];
$creater			= $_POST['creater'];
$updater			= $_POST['updater'];

$column_name		= $_POST['column_name'];
$column_value		= $_POST['column_value'];

$sql = "INSERT INTO
			dev.DISPLAY_COLLABORATION
		(
			PAGE_IDX,
			POSTING_STATUS,
			DISPLAY_NUM,
			BOOKMARK_FLG,
			PRODUCT_LIST_FLG,
			PRODUCT_LINK_FLG,
			CREATER,
			UPDATER
		) VALUES (
			".$page_idx.",
			'".$posting_status."',
			".$display_num.",
			".$bookmark_flg.",
			".$product_list_flg.",
			".$product_link_flg.",
			'".$creater."',
			'".$updater."',
		);";

$db->query($sql);

$collaboration_idx = $db->last_id();
	
if (!empty($collaboration_idx) && $column_name != null && $column_value != null && count($column_name) == count($column_value)) {
	$tmp_num = 1;
	for ($i=0; $i<count($column_name); $i++) {
		$column_sql = "INSERT INTO
							dev.COLUMN_NAME
						(
							COLLABORATION_IDX,
							DISPLAY_NUM,
							COLUMN_NAME,
							COLUMN_VALUE
						) VALUES (
							".$collaboration_idx.",
							".$tmp_num.",
							'".$column_name[$i]."',
							'".$column_value[$i]."'
						)";
		
		$db->query($column_sql);
		
		$tmp_num++;
	}	
}
?>