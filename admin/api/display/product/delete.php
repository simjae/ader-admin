<?php
/*
 +=============================================================================
 | 
 | 상품 진열 페이지 - 페이지 삭제
 | -----------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.07.25
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

include_once("/var/www/admin/api/common/common.php");

$session_id			= sessionCheck();
$page_idx			= $_POST['page_idx'];

$menu_lrg_cnt = $db->count("MENU_LRG","MENU_TYPE = 'PR' AND PAGE_IDX IN(".implode(",",$page_idx).") AND DEL_FLG = FALSE");
$menu_mdl_cnt = $db->count("MENU_MDL","MENU_TYPE = 'PR' AND PAGE_IDX IN(".implode(",",$page_idx).") AND DEL_FLG = FALSE");
$menu_sml_cnt = $db->count("MENU_SML","MENU_TYPE = 'PR' AND PAGE_IDX IN(".implode(",",$page_idx).") AND DEL_FLG = FALSE");

if ($menu_lrg_cnt > 0 || $menu_mdl_cnt > 0 || $menu_sml_cnt > 0) {
	$json_result['code'] = 301;
	$json_result['msg'] = "현재 메뉴에 등록되어있는 상품 진열 페이지는 삭제하실 수 없습니다.";
} else {
	$delete_page_product_sql = "
		UPDATE
			PAGE_PRODUCT
		SET
			DEL_FLG = TRUE,
			UPDATE_DATE = NOW(),
			UPDATER = '".$session_id."'
		WHERE
			IDX IN (".implode(",",$page_idx).")
	";
	
	$db->query($delete_page_product_sql);
}

?>