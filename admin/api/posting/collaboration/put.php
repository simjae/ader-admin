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
$updater			= $_POST['updater'];

$column_name		= $_POST['column_name'];
$column_value		= $_POST['column_value'];

$sql = "UPDATE
			dev.DISPLAY_COLLABORATION
		SET
			POSTING_STATUS = ".$posting_status.",
			DISPLAY_NUM = ".$display_num.",
			BOOKMARK_FLG = ".$bookmark_flg.",
			PRODUCT_LIST_FLG = ".$product_list_flg.",
			PRODUCT_LINK_FLG = ".$product_link_flg.",
			UPDATE_DATE = NOW(),
			UPDATER = 'Admin'
		WHERE
			PAGE_IDX = ".$page_idx." AND 
			COLLABORATION_IDX = ".$collaboration_idx;

$db->query($sql);

$result = $db->affectedRows();
	
if (!empty($result) > 0 && $column_name != null && $column_value != null && count($column_name) == count($column_value)) {
	$db->query("DELETE FROM dev.COLLABORATION_COLUMN WHERE COLLABORATION_IDX = ".$collaboration_idx);
	
	for ($i=0; $i<count(column_name); $i++) {
		$column_sql = "INSERT INTO
							dev.COLUMN_NAME
						(
							DISPLAY_NUM,
							COLUMN_NAME,
							COLUMN_VALUE
						) VALUES (
							".$display_num.",
							'".$column_name[$i]."',
							'".$column_value[$i]."'
						)";
		
		$db->query($column_sql);
		$display_num++;
	}	
}
?>